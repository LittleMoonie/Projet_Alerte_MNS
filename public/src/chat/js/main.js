class User {
    constructor(id, username) {
        this.id = id;
        this.username = username;
    }
}

const users = [
    new User(1, 'Ugo'),
    new User(2, 'Lazaro'),
    new User(3, 'Charlie'),
];

const input = document.getElementById('messageInput');
const userList = document.getElementById('userList');

var conn = new WebSocket('ws://localhost:8080');
conn.onopen = function(e){
    console.log("Connection Established with WebSocket")
}

input.addEventListener('input', (e) => {
    const cursorPosition = input.selectionStart; // Get current cursor position
    const textBeforeCursor = input.value.substring(0, cursorPosition); // Get the text before the cursor
    
    // Check if the last character before the cursor is '@'
    if (textBeforeCursor.endsWith('@')) {
        userList.style.display = 'block';
        userList.innerHTML = '';
        users.forEach(user => {
            const userDiv = document.createElement('div');
            userDiv.textContent = user.username;
            userDiv.onclick = function() {
                // Replace '@' with the username within a <span> and a space, and keep the rest of the input unchanged
                const mention = `@${user.username+"#" + user.id}`;
                const textAfterCursor = input.value.substring(cursorPosition);
                input.value = textBeforeCursor.slice(0, -1) + mention + textAfterCursor; // Remove the '@' before inserting
                userList.style.display = 'none';
                // Focus back to the input field and move the cursor to the end
                input.focus();
                // Due to setting innerHTML, this might not work as expected for an input element. Consider using a contenteditable div if you need rich text (like spans) inside.
                const newCursorPosition = textBeforeCursor.length + mention.length - 1;
                input.setSelectionRange(newCursorPosition, newCursorPosition);
            };
            userList.appendChild(userDiv);
        });
    } else {
        userList.style.display = 'none';
    }
});

document.getElementById('messageInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault(); // Prevent the default action to avoid submitting a form if it's wrapped in one
        const messageText = input.value.trim();
        sendMessage(messageText, true); // Assuming 'true' indicates the current user
        input.value = ''; // Clear the input field after sending
    }
});


document.getElementById('sendButton').addEventListener('click', () => {
    const messageText = input.value.trim();
    
    if (messageText) {
        sendMessage(messageText, true); // Assuming 'true' indicates the current user
        input.value = ''; // Clear the input field after sending
    }
});

function sendMessage(text, isCurrentUser) {
    const messagesArea = document.querySelector('.flex-1.overflow-y-auto'); // Adjust this selector based on your actual messages container
    const messageDiv = document.createElement('div');
    messageDiv.classList.add('flex', 'items-end', 'space-x-2', 'mb-4');
    
    if (isCurrentUser) {
        messageDiv.classList.add('justify-end');
    }
    
    const messageContentDiv = document.createElement('div');
    messageContentDiv.classList.add('text-right'); // Adjust text alignment as needed
    
    const messageContent = document.createElement('p');
    messageContent.innerHTML = text.replace(/@([a-zA-Z0-9]+)#(\d+)/g, '<span class="mention">@$1</span>'); // Highlight mentions
    messageContent.classList.add('bg-subtle_highlight', 'text-light_surface_text', 'text-lg', 'font-medium', 'rounded-message_button', 'break-all', 'p-2', 'max-w-md');
    
    // Create timestamp element
    const timestamp = document.createElement('p');
    timestamp.textContent = new Date().toLocaleDateString([], { day: "2-digit", month: "2-digit", year: "2-digit" }) + ' - ' + new Date().toLocaleTimeString([], {hour: '2-digit', minute: '2-digit', hour12: true });
    timestamp.classList.add('text-light_surface_text', 'font-normal', 'text-xs');    
    
    // Append message content and timestamp to the container div
    messageContentDiv.appendChild(messageContent);
    messageContentDiv.appendChild(timestamp);
    
    messageDiv.appendChild(messageContentDiv);
    
    messagesArea.appendChild(messageDiv);

    conn.send(text); // Send the message text instead of the DOM element.
    console.log("Message Sent to Connection \n" + text);
    messagesArea.scrollTop = messagesArea.scrollHeight; // Scroll to the bottom to show the new message
}

const rightSidebar = document.querySelector('.right-sidebar');
users.forEach(user => {
    const userDiv = document.createElement('div');
    userDiv.textContent = user.username;
    userDiv.classList.add('text-dark_surface_text', 'p-2');
    rightSidebar.appendChild(userDiv);
});

