const { senderName, authUserId, receiverId, csrfToken, sendUrl } = window.CHAT_CONFIG;

const channelName = 'chat.' + [authUserId, receiverId]
    .map(Number)
    .sort((a, b) => a - b)
    .join('.');

window.Echo.private(channelName)
    .listen('MessageSent', (data) => {
        if (data.sender_id === authUserId) return;
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
        },
        body: JSON.stringify({ body })
    })
        .then(res => res.json())
        .then(data => {
            // Append for the sender immediately (receiver gets it via Pusher)
            appendMessage(senderName, data.body, true);
            input.value = '';
        });
}

/*function appendMessage(senderName, body, isMine) {
    const box = document.getElementById('chat-box');
    const div = document.createElement('div');
    div.className = 'message ' + (isMine ? 'mine' : 'theirs');
    div.innerHTML = `<strong>${senderName}:</strong> ${body}`;
    box.appendChild(div);
    box.scrollTop = box.scrollHeight;
}*/

function appendMessage(senderName, body, isMine) {
        const container = document.getElementById('messages-container');

    const div = document.createElement('div');
    div.className = `w-full chat ${isMine ? 'chat-end' : 'chat-start'}`;

    // Get first letter of sender name for avatar
    const initial = senderName.charAt(0).toUpperCase();

    // Get current time in H:i format
    const now = new Date();
    const time = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: false });

    div.innerHTML = `
        <div class="chat-image avatar">
            <div class="avatar avatar-placeholder">
                <div class="bg-neutral text-neutral-content w-8 rounded-full">
                    <span class="text-xs">${initial}</span>
                </div>
            </div>
        </div>
        <div class="chat-bubble">${body}</div>
        <div class="chat-footer opacity-50">
            <time class="text-xs opacity-50">${time}</time>
        </div>
    `;

    container.appendChild(div);

    const box = document.getElementById('chat-box');
    box.scrollTop = box.scrollHeight;
}
