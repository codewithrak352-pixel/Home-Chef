const chatHTML = `
  <div class="chat-widget">
    <button class="chat-btn" onclick="toggleChat()">
      <i class="fas fa-comment-dots"></i>
    </button>
    <div class="chat-window" id="chatWindow">
      <div class="chat-header">
        <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=100&auto=format" alt="Bot">
        <div>
          <div class="fw-bold">Home Chef AI</div>
          <div class="small opacity-75">Online | Active</div>
        </div>
      </div>
      <div class="chat-body" id="chatBody">
        <div class="msg msg-bot">Hi there! 👋 I'm your Home Chef assistant. How can I help you today?</div>
      </div>
      <div class="chat-footer">
        <input type="text" id="chatInput" class="chat-input" placeholder="Type a message..." onkeypress="handleChatKey(event)">
        <button class="chat-send" onclick="sendChat()">
          <i class="fas fa-paper-plane"></i>
        </button>
      </div>
    </div>
  </div>
`;

document.body.insertAdjacentHTML('beforeend', chatHTML);

function toggleChat() {
  const win = document.getElementById('chatWindow');
  win.style.display = win.style.display === 'flex' ? 'none' : 'flex';
}

function handleChatKey(e) {
  if (e.key === 'Enter') sendChat();
}

function sendChat() {
  const input = document.getElementById('chatInput');
  const body = document.getElementById('chatBody');
  const msg = input.value.trim();
  
  if (!msg) return;

  // Add user message
  const userMsg = document.createElement('div');
  userMsg.className = 'msg msg-user';
  userMsg.innerText = msg;
  body.appendChild(userMsg);
  
  input.value = '';
  body.scrollTop = body.scrollHeight;

  // AI Logic
  setTimeout(() => {
    const botMsg = document.createElement('div');
    botMsg.className = 'msg msg-bot';
    botMsg.innerText = getBotResponse(msg);
    body.appendChild(botMsg);
    body.scrollTop = body.scrollHeight;
  }, 1000);
}

function getBotResponse(msg) {
  const m = msg.toLowerCase();
  if (m.includes('hello') || m.includes('hi')) return "Hello! Welcome to Home Chef. Ready to cook something delicious?";
  if (m.includes('price') || m.includes('cost')) return "Our meals start as low as Rs. 899 per serving! You can see full pricing on our signup page.";
  if (m.includes('menu') || m.includes('food')) return "We have 35+ weekly recipes! You can explore them on our 'Our Menu' page.";
  if (m.includes('family')) return "Our Family Plan is perfect for 4 people! It's designed to be picky-eater approved.";
  if (m.includes('delivery')) return "We deliver fresh ingredients in insulated boxes right to your doorstep once a week.";
  if (m.includes('gift')) return "Yes, we offer both digital and physical gift cards starting from Rs. 2500.";
  if (m.includes('register') || m.includes('signup')) return "You can create an account by clicking the 'Get Started' button at the top right!";
  
  return "That's a great question! For specific details, our support team is also available, but I can tell you that Home Chef is all about making gourmet cooking simple and fun.";
}
