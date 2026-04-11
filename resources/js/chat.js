const { authUserId, receiverId, csrfToken, sendUrl } = window.CHAT_CONFIG;

const channelName = 'chat.' + [authUserId, receiverId]
    .map(Number)
    .sort((a, b) => a - b)
    .join('.');

window.Echo.private(channelName)
    .listen('MessageSent', (data) => {
        // data.sender is the full User object — use .name
        appendMessage(data.sender.name, data.body, data.sender_id === authUserId);
    });

document.getElementById('send-btn').addEventListener('click', sendMessage);
document.getElementById('msg-input').addEventListener('keydown', e => {
    if (e.key === 'Enter') sendMessage();
});

function sendMessage() {
    const input = document.getElementById('msg-input');
    const body = input.value.trim();
    if (!body) return;

    fetch(sendUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            // Send socket ID so toOthers() correctly excludes the sender
            'X-Socket-ID': window.Echo.socketId(),
        },
        body: JSON.stringify({ body })
    })
        .then(res => res.json())
        .then(data => {
            // Append for the sender immediately (receiver gets it via Pusher)
            appendMessage('You', data.body, true);
            input.value = '';
        });
}

function appendMessage(senderName, body, isMine) {
    const box = document.getElementById('chat-box');
    const div = document.createElement('div');
    div.className = 'message ' + (isMine ? 'mine' : 'theirs');
    div.innerHTML = `<strong>${senderName}:</strong> ${body}`;
    box.appendChild(div);
    box.scrollTop = box.scrollHeight;
}
