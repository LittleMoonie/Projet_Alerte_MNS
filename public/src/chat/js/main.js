document.addEventListener('DOMContentLoaded', () => {
    initMainJS();

    // Initialize additional functionalities
    document.querySelector("#toggleUsersButton").addEventListener("click", () => {
        document.querySelector("#rightSidebar").classList.toggle("hidden");
    });

    document.querySelector("#closeProfileButton").addEventListener("click", () => {
        document.querySelector("#userProfilePopup").classList.add("hidden");
    });
});

function initMainJS() {
    let lastId = 0;

    document.querySelector("#sendButton").addEventListener("click", ajoutMessage);
    document.querySelector("#uploadButton").addEventListener("click", () => document.querySelector("#fileInput").click());
    document.querySelector("#gifButton").addEventListener("click", toggleGifContainer);
    document.querySelector("#gifSearch").addEventListener("input", searchGifs);
    document.querySelectorAll('.right-sidebar').forEach(element => {
        element.addEventListener('click', function() {
            showUserProfile(this.dataset.userId);
        });
    });

    setInterval(chargeMessages, 1000);

    function chargeMessages() {
        let xmlhttp = new XMLHttpRequest();
        let userId = document.querySelector("#userInput").value;
        let channelId = document.querySelector("#channelInput").value;

        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && (this.status == 200 || this.status == 201)) {
                let messages = JSON.parse(this.response).reverse();
                let discussion = document.querySelector("#messagesArea");
                messages.forEach(message => {
                    let dateMessage = message.message_timestamp.replace(/T/, ' ').replace(/\..+/, '');
                    if (message.message_sender_id == userId) {
                        discussion.innerHTML += `
                        <div class="flex items-end space-x-2 justify-end">
                            <div class="text-right">
                                <div class="text-light_surface_text font-medium">${message.user_firstname} ${message.user_lastname}</div>
                                <p class="bg-subtle_highlight text-light_surface_text text-lg font-medium rounded-message_button break-all p-2 max-w-md">${message.message_content}</p>
                                <p class="text-light_surface_text font-normal text-xs">${dateMessage}</p>
                            </div>
                            <img src="${'../../../upload/sm_' + message.user_picture}" alt="Avatar" class="h-10 w-10 rounded-full mb-4">
                        </div>`;
                    } else {
                        discussion.innerHTML += `
                        <div class="flex items-start space-x-2">
                            <img src="${'../../../upload/sm_' + message.user_picture}" alt="Avatar" class="h-10 w-10 rounded-full mb-4">
                            <div class="text-left">
                                <div class="text-light_surface_text font-medium">${message.user_firstname} ${message.user_lastname}</div>
                                <p class="bg-subtle_highlight text-light_surface_text text-lg font-medium rounded-message_button break-all p-2 max-w-md">${message.message_content}</p>
                                <p class="text-light_surface_text font-normal text-xs">${dateMessage}</p>
                            </div>
                        </div>`;
                    }
                    lastId = message.message_id;
                    discussion.scrollTop = discussion.scrollHeight;
                });
            }
        };

        xmlhttp.open("GET", `ajax/chargeMessages.php?lastId=${lastId}&channelId=${channelId}`);
        xmlhttp.send();
    }

    function ajoutMessage() {
        let message = document.querySelector("#messageInput").value;
        let channel = document.querySelector("#channelInput").value;
        let user = document.querySelector("#userInput").value;

        if (message.trim()) {
            const date = new Date();
            let donnees = JSON.stringify({
                'message': message,
                'channel': channel,
                'user': user,
                'timestamp': `${date.getFullYear()}-${date.getMonth() + 1}-${date.getDate()} ${date.getHours()}:${date.getMinutes()}:${date.getSeconds()}`,
                'file_type': 'text'
            });

            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4) {
                    if (xmlhttp.status == 201) {
                        document.querySelector("#messageInput").value = "";
                    } else {
                        alert(JSON.parse(xmlhttp.responseText).message);
                    }
                }
            };

            xmlhttp.open("POST", "ajax/ajoutMessage.php");
            xmlhttp.send(donnees);
        }
    }

    function toggleGifContainer() {
        document.querySelector("#gifContainer").classList.toggle("hidden");
    }

    function searchGifs(event) {
        let query = event.target.value.trim();
        if (query) {
            fetch(`https://api.tenor.com/v1/search?q=${query}&key=YOUR_TENOR_API_KEY&limit=10`)
                .then(response => response.json())
                .then(data => {
                    let gifResults = document.querySelector("#gifResults");
                    gifResults.innerHTML = "";
                    data.results.forEach(gif => {
                        let img = document.createElement("img");
                        img.src = gif.media[0].tinygif.url;
                        img.classList.add("w-32", "h-32", "cursor-pointer");
                        img.addEventListener("click", () => {
                            let donnees = JSON.stringify({
                                'message': gif.media[0].tinygif.url,
                                'channel': document.querySelector("#channelInput").value,
                                'user': document.querySelector("#userInput").value,
                                'timestamp': new Date().toISOString(),
                                'file_type': 'gif'
                            });

                            let xmlhttp = new XMLHttpRequest();
                            xmlhttp.onreadystatechange = function () {
                                if (xmlhttp.readyState == 4) {
                                    if (xmlhttp.status == 201) {
                                        document.querySelector("#messageInput").value = "";
                                        document.querySelector("#gifContainer").classList.add("hidden");
                                    } else {
                                        alert(JSON.parse(xmlhttp.responseText).message);
                                    }
                                }
                            };

                            xmlhttp.open("POST", "ajax/ajoutMessage.php");
                            xmlhttp.send(donnees);
                        });

                        gifResults.appendChild(img);
                    });
                });
        }
    }

    function showUserProfile(userId) {
        fetch(`ajax/getUserProfile.php?userId=${userId}`)
            .then(response => response.json())
            .then(data => {
                if (data) {
                    document.querySelector("#profileName").innerText = `${data.user_firstname} ${data.user_lastname}`;
                    document.querySelector("#profileEmail").innerText = data.user_mail;
                    document.querySelector("#profilePicture").src = `${'../../../upload/sm_' + data.user_picture}`;
                    document.querySelector("#userProfilePopup").classList.remove("hidden");
                } else {
                    alert('User not found');
                }
            });
    }
}
