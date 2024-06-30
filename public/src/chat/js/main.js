document.addEventListener("DOMContentLoaded", function () {
  const conn = new WebSocket("ws://localhost:8080");
  const input = document.getElementById("messageInput");
  const sendButton = document.getElementById("sendButton");
  const messagesArea = document.getElementById("messagesArea");
  const toggleUserList = document.getElementById("toggleUserList");
  const rightSidebar = document.getElementById("rightSidebar");
  const userInfoPopup = document.getElementById("userInfoPopup");
  const popupContent = document.getElementById("popupContent");
  const closePopup = document.getElementById("closePopup");
  const emojiButton = document.getElementById("emojiButton");
  const gifButton = document.getElementById("gifButton");
  const fileButton = document.getElementById("fileButton");
  const fileInput = document.getElementById("fileInput");

  conn.onopen = () => console.log("Connected to WebSocket");
  conn.onmessage = (e) => {
      const messageData = JSON.parse(e.data);
      displayMessage(messageData);
  };

  sendButton.addEventListener("click", sendMessage);
  input.addEventListener("keypress", (e) => {
      if (e.key === "Enter") {
          e.preventDefault();
          sendMessage();
      }
  });

  function sendMessage() {
      const messageText = input.value.trim();
      if (messageText) {
          const messageData = {
              user: "<?= htmlspecialchars($_SESSION['userId']) ?>",
              content: messageText,
              timestamp: new Date().toISOString(),
              channel: "<?= htmlspecialchars($_GET['channel']) ?>"
          };
          conn.send(JSON.stringify(messageData));
          input.value = "";
      }
  }

  function displayMessage(messageData) {
      const messageDiv = document.createElement("div");
      messageDiv.classList.add("flex", "items-start", "space-x-2");

      const avatar = document.createElement("img");
      avatar.src = `../../../upload/sm_${messageData.user_picture}`;
      avatar.alt = "Avatar";
      avatar.classList.add("h-10", "w-10", "rounded-full", "mb-4");

      const messageContent = document.createElement("div");
      messageContent.classList.add("text-left");

      const userName = document.createElement("div");
      userName.classList.add("text-light_surface_text", "font-medium");
      userName.textContent = `${messageData.user_firstname} ${messageData.user_lastname}`;

      const messageText = document.createElement("p");
      messageText.classList.add("bg-subtle_highlight", "text-light_surface_text", "text-lg", "font-medium", "rounded-message_button", "break-all", "p-2", "max-w-md");
      messageText.textContent = messageData.content;

      const timestamp = document.createElement("p");
      timestamp.classList.add("text-light_surface_text", "font-normal", "text-xs");
      timestamp.textContent = new Date(messageData.timestamp).toLocaleString();

      messageContent.appendChild(userName);
      messageContent.appendChild(messageText);
      messageContent.appendChild(timestamp);
      messageDiv.appendChild(avatar);
      messageDiv.appendChild(messageContent);

      messagesArea.appendChild(messageDiv);
      messagesArea.scrollTop = messagesArea.scrollHeight;
  }

  toggleUserList.addEventListener("click", () => {
      rightSidebar.classList.toggle("hidden");
  });

  document.querySelectorAll(".right-sidebar").forEach(userDiv => {
      userDiv.addEventListener("click", () => {
          const userId = userDiv.getAttribute("data-userid");
          fetchUserInfo(userId);
      });
  });

  closePopup.addEventListener("click", () => {
      userInfoPopup.classList.add("hidden");
  });

  function fetchUserInfo(userId) {
      fetch(`user_info.php?user_id=${userId}`)
          .then(response => response.json())
          .then(data => {
              popupContent.innerHTML = `
                  <div><strong>Name:</strong> ${data.first_name} ${data.last_name}</div>
                  <div><strong>Email:</strong> ${data.email}</div>
                  <img src="../../../upload/sm_${data.picture}" alt="Avatar" class="h-20 w-20 rounded-full">
              `;
              userInfoPopup.classList.remove("hidden");
          });
  }

  emojiButton.addEventListener("click", () => {
      // Implement emoji picker logic
  });

  gifButton.addEventListener("click", () => {
      // Implement GIF picker logic
  });

  fileButton.addEventListener("click", () => {
      fileInput.click();
  });

  fileInput.addEventListener("change", () => {
      const file = fileInput.files[0];
      if (file) {
          const formData = new FormData();
          formData.append("file", file);

          fetch("upload_file.php", {
              method: "POST",
              body: formData
          })
              .then(response => response.json())
              .then(data => {
                  const messageData = {
                      user: "<?= htmlspecialchars($_SESSION['userId']) ?>",
                      content: `<a href="${data.file_path}" download>${file.name}</a>`,
                      timestamp: new Date().toISOString(),
                      channel: "<?= htmlspecialchars($_GET['channel']) ?>"
                  };
                  conn.send(JSON.stringify(messageData));
              });
      }
  });
});
