// main.js
document.addEventListener("DOMContentLoaded", () => {
    // Initialize the application
    initChat();
    initEmojiPicker();
    initFileUpload();
    initGifSearch();
    toggleUserList();
});

// Initialize chat functionality
function initChat() {
    let lastId = 0;
    const messageInput = document.querySelector("#messageInput");
    const sendButton = document.querySelector("#sendButton");

    messageInput.addEventListener("keyup", (e) => {
        if (e.key === "Enter") {
            sendMessage();
        }
    });

    sendButton.addEventListener("click", sendMessage);

    setInterval(loadMessages, 1000);
}

// Load messages via AJAX
function loadMessages() {
    const channelId = document.querySelector("#channelInput").value;
    const userId = document.querySelector("#userInput").value;
    const xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && (this.status === 200 || this.status === 201)) {
            const messages = JSON.parse(this.responseText);
            const discussion = document.querySelector("#messagesArea");

            messages.reverse().forEach((message) => {
                const dateMessage = formatDate(message.message_timestamp);
                const isCurrentUser = message.message_sender_id == userId;
                discussion.innerHTML += createMessageHTML(message, dateMessage, isCurrentUser);
                lastId = message.message_id;
            });

            discussion.scrollTop = discussion.scrollHeight;
        }
    };

    xmlhttp.open("GET", `ajax/chargeMessages.php?lastId=${lastId}&channelId=${channelId}`, true);
    xmlhttp.send();
}

// Send a new message via AJAX
function sendMessage() {
    const message = document.querySelector("#messageInput").value;
    const channel = document.querySelector("#channelInput").value;
    const user = document.querySelector("#userInput").value;

    if (message.trim() !== "") {
        const date = new Date();
        const messageData = {
            message: message,
            channel: channel,
            user: user,
            timestamp: date.toISOString(),
            file_type: "text",
        };

        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState === 4) {
                if (this.status === 201) {
                    document.querySelector("#messageInput").value = "";
                } else {
                    alert(JSON.parse(this.responseText).message);
                }
            }
        };

        xmlhttp.open("POST", "ajax/ajoutMessage.php", true);
        xmlhttp.setRequestHeader("Content-Type", "application/json");
        xmlhttp.send(JSON.stringify(messageData));
    }
}

// Create HTML for a message
function createMessageHTML(message, dateMessage, isCurrentUser) {
    return isCurrentUser
        ? `<div class="flex items-end space-x-2 justify-end">
               <div class="text-right">
                   <div class="text-light_surface_text font-medium">${message.user_firstname} ${message.user_lastname}</div>
                   <p class="bg-subtle_highlight text-light_surface_text text-lg font-medium rounded-message_button break-all p-2 max-w-md">${message.message_content}</p>
                   <p class="text-light_surface_text font-normal text-xs">${dateMessage}</p>
               </div>
               <img src="${'../../../upload/sm_' + message.user_picture}" alt="Avatar" class="h-10 w-10 rounded-full mb-4">
           </div>`
        : `<div class="flex items-start space-x-2">
               <img src="${'../../../upload/sm_' + message.user_picture}" alt="Avatar" class="h-10 w-10 rounded-full mb-4">
               <div class="text-left">
                   <div class="text-light_surface_text font-medium">${message.user_firstname} ${message.user_lastname}</div>
                   <p class="bg-subtle_highlight text-light_surface_text text-lg font-medium rounded-message_button break-all p-2 max-w-md">${message.message_content}</p>
                   <p class="text-light_surface_text font-normal text-xs">${dateMessage}</p>
               </div>
           </div>`;
}

// Format date
function formatDate(timestamp) {
    const date = new Date(timestamp);
    return date.toLocaleString();
}

// Initialize emoji picker
function initEmojiPicker() {
    const emojiPicker = document.querySelector("emoji-picker");
    emojiPicker.addEventListener("emoji-click", (event) => {
        const messageInput = document.querySelector("#messageInput");
        messageInput.value += event.detail.unicode;
    });
}

// Initialize file upload
function initFileUpload() {
    const uploadButton = document.querySelector("#uploadButton");
    const fileInput = document.querySelector("#fileInput");

    uploadButton.addEventListener("click", () => {
        fileInput.click();
    });

    fileInput.addEventListener("change", (event) => {
        handleFileUpload(event.target.files[0]);
    });
}

// Handle file upload
function handleFileUpload(file) {
    if (file) {
        const formData = new FormData();
        formData.append("file", file);

        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState === 4) {
                if (this.status === 201) {
                    const response = JSON.parse(this.responseText);
                    sendMessage(response.file_url, "file");
                } else {
                    alert(JSON.parse(this.responseText).message);
                }
            }
        };

        xmlhttp.open("POST", "uploadFile.php", true);
        xmlhttp.send(formData);
    }
}

// Initialize GIF search
function initGifSearch() {
    const gifButton = document.querySelector("#gifButton");
    const gifContainer = document.querySelector("#gifContainer");
    const gifSearch = document.querySelector("#gifSearch");

    gifButton.addEventListener("click", () => {
        gifContainer.classList.toggle("hidden");
    });

    gifSearch.addEventListener("input", (event) => {
        searchGifs(event.target.value);
    });
}

// Search GIFs via Tenor API
function searchGifs(query) {
    if (query.trim() !== "") {
        fetch(`https://api.tenor.com/v1/search?q=${query}&key=YOUR_TENOR_API_KEY&limit=10`)
            .then((response) => response.json())
            .then((data) => {
                const gifResults = document.querySelector("#gifResults");
                gifResults.innerHTML = "";

                data.results.forEach((gif) => {
                    const img = document.createElement("img");
                    img.src = gif.media[0].tinygif.url;
                    img.classList.add("w-32", "h-32", "cursor-pointer");
                    img.addEventListener("click", () => {
                        sendMessage(gif.media[0].tinygif.url, "gif");
                        gifContainer.classList.add("hidden");
                    });
                    gifResults.appendChild(img);
                });
            });
    }
}

// Send message with additional data (file or GIF)
function sendMessage(content, type = "text") {
    const channel = document.querySelector("#channelInput").value;
    const user = document.querySelector("#userInput").value;

    const date = new Date();
    const messageData = {
        message: content,
        channel: channel,
        user: user,
        timestamp: date.toISOString(),
        file_type: type,
    };

    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (this.status === 201) {
                document.querySelector("#messageInput").value = "";
            } else {
                alert(JSON.parse(this.responseText).message);
            }
        }
    };

    xmlhttp.open("POST", "ajax/ajoutMessage.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/json");
    xmlhttp.send(JSON.stringify(messageData));
}

// Toggle user list visibility
function toggleUserList() {
    const toggleButton = document.querySelector("#toggleUsersButton");
    const rightSidebar = document.querySelector("#rightSidebar");

    toggleButton.addEventListener("click", () => {
        rightSidebar.classList.toggle("hidden");
    });
}
