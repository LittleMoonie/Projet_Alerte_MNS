let lastId = 0;

window.onload = () => {
    let texte = document.querySelector("#messageInput");
    texte.addEventListener("keyup", verifEntree);

    let valid = document.querySelector("#sendButton");
    valid.addEventListener("click", ajoutMessage);

    let uploadButton = document.querySelector("#uploadButton");
    uploadButton.addEventListener("click", () => {
        document.querySelector("#fileInput").click();
    });

    document.querySelector("#fileInput").addEventListener("change", handleFileUpload);

    let gifButton = document.querySelector("#gifButton");
    gifButton.addEventListener("click", toggleGifContainer);

    document.querySelector("#gifSearch").addEventListener("input", searchGifs);

    let toggleUsersButton = document.querySelector("#toggleUsersButton");
    toggleUsersButton.addEventListener("click", () => {
        document.querySelector("#rightSidebar").classList.toggle("hidden");
    });

    document.querySelectorAll(".right-sidebar").forEach(user => {
        user.addEventListener("click", (event) => {
            const userId = event.currentTarget.dataset.userId;
            fetchUserProfile(userId);
        });
    });

    setInterval(chargeMessages, 1000);
}

function verifEntree(e) {
    if (e.key == "Enter") {
        ajoutMessage();
    }
}

function chargeMessages() {
    let xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
        let userId = document.querySelector("#userInput").value;

        if (this.readyState == 4) {
            if (this.status == 200 || this.status == 201) {
                let messages = JSON.parse(this.response);
                messages.reverse();

                let discussion = document.querySelector("#messagesArea");

                for (let message of messages) {
                    let dateMessage = message.message_timestamp;

                    const year = dateMessage.substring(0, 4);
                    const month = dateMessage.substring(5, 7);
                    const day = dateMessage.substring(8, 10);
                    const hours = dateMessage.substring(11, 13);
                    const minutes = dateMessage.substring(14, 16);

                    dateMessage = `${day}/${month}/${year} ${hours}:${minutes}`;

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

                    const messagesArea = document.querySelector("#messagesArea");
                    messagesArea.scrollTop = messagesArea.scrollHeight;
                }
            } else {
                let erreur = JSON.parse(this.response);
                alert(erreur.message);
            }
        }
    }

    xmlhttp.open("GET", `ajax/chargeMessage.php?lastId=${lastId}&channelId=${document.querySelector("#channelInput").value}`);
    xmlhttp.send();
}

function ajoutMessage() {
    let message = document.querySelector("#messageInput").value;
    let channel = document.querySelector("#channelInput").value;
    let user = document.querySelector("#userInput").value;

    if (message.trim() != "") {
        const date = new Date();

        let donnees = {
            'message': message,
            'channel': channel,
            'user': user,
            'timestamp': `${date.getFullYear()}-${date.getMonth() + 1}-${date.getDate()} ${date.getHours()}:${date.getMinutes()}:${date.getSeconds()}`,
            'file_type': 'text'
        };

        let donneesJson = JSON.stringify(donnees);

        let xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4) {
                if (xmlhttp.status == 201) {
                    document.querySelector("#messageInput").value = "";
                } else {
                    let reponse = JSON.parse(xmlhttp.responseText);
                    alert(reponse.message);
                }
            }
        }

        xmlhttp.open("POST", "ajax/ajoutMessage.php");
        xmlhttp.send(donneesJson);
    } else {
        document.querySelector("#messageInput").value = "";
    }
}

function handleFileUpload(event) {
    let file = event.target.files[0];

    if (file) {
        let formData = new FormData();
        formData.append("file", file);

        let xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4) {
                if (xmlhttp.status == 201) {
                    let response = JSON.parse(xmlhttp.responseText);
                    let message = document.querySelector("#messageInput").value;

                    let donnees = {
                        'message': response.file_url,
                        'channel': document.querySelector("#channelInput").value,
                        'user': document.querySelector("#userInput").value,
                        'timestamp': new Date().toISOString(),
                        'file_type': 'file'
                    };

                    let donneesJson = JSON.stringify(donnees);

                    let xmlhttp2 = new XMLHttpRequest();

                    xmlhttp2.onreadystatechange = function () {
                        if (xmlhttp2.readyState == 4) {
                            if (xmlhttp2.status == 201) {
                                document.querySelector("#messageInput").value = "";
                            } else {
                                let reponse = JSON.parse(xmlhttp2.responseText);
                                alert(reponse.message);
                            }
                        }
                    }

                    xmlhttp2.open("POST", "ajax/ajoutMessage.php");
                    xmlhttp2.send(donneesJson);
                } else {
                    let reponse = JSON.parse(xmlhttp.responseText);
                    alert(reponse.message);
                }
            }
        }

        xmlhttp.open("POST", "uploadFile.php");
        xmlhttp.send(formData);
    }
}

function toggleGifContainer() {
    let gifContainer = document.querySelector("#gifContainer");
    gifContainer.classList.toggle("hidden");
}

function searchGifs(event) {
    let query = event.target.value;

    if (query.trim() != "") {
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
                        let donnees = {
                            'message': gif.media[0].tinygif.url,
                            'channel': document.querySelector("#channelInput").value,
                            'user': document.querySelector("#userInput").value,
                            'timestamp': new Date().toISOString(),
                            'file_type': 'gif'
                        };

                        let donneesJson = JSON.stringify(donnees);

                        let xmlhttp = new XMLHttpRequest();

                        xmlhttp.onreadystatechange = function () {
                            if (xmlhttp.readyState == 4) {
                                if (xmlhttp.status == 201) {
                                    document.querySelector("#messageInput").value = "";
                                    document.querySelector("#gifContainer").classList.add("hidden");
                                } else {
                                    let reponse = JSON.parse(xmlhttp.responseText);
                                    alert(reponse.message);
                                }
                            }
                        }

                        xmlhttp.open("POST", "ajax/ajoutMessage.php");
                        xmlhttp.send(donneesJson);
                    });

                    gifResults.appendChild(img);
                });
            });
    }
}

function fetchUserProfile(userId) {
    fetch(`getUserProfile.php?userId=${userId}`)
        .then(response => response.json())
        .then(data => {
            alert(`Username: ${data.user_firstname} ${data.user_lastname}\nEmail: ${data.user_mail}`);
        });
}
