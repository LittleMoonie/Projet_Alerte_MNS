const socket = io('wss://alerte-mns.bretserv.fr:3000/socket-server');

function sendMessage(e) {
    e.preventDefault();
    if (input.value) {
        socket.emit('message', input.value);
        input.value = '';
    }

    input.focus();
}

document.querySelector('form').addEventListener('submit', sendMessage);

socket.on('message', (data) => {
    const li = document.createElement('li');
    li.textContent = data;
    document.querySelector('messages').appendChild(li);
})