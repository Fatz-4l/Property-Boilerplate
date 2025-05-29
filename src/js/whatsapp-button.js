// WhatsApp functionality
document.addEventListener('DOMContentLoaded', initWhatsAppButtons);

const CONFIG = {
    DIRECT_URL: 'whatsapp://send',
    WEB_URL: 'https://api.whatsapp.com/send',
    PHONE: '447523683134',
    DELAY: 500
};

//Initialize WhatsApp buttons

function initWhatsAppButtons() {
    document.querySelectorAll('.whatsapp-btn').forEach(setupButton);
}

//Setup individual WhatsApp button
function setupButton(button) {
    const dealCards = button.closest('.deal-cards');
    if (!dealCards) return;

    const title = dealCards.querySelector('.deal-title').textContent.trim();
    const urls = createUrls(title);

    button.setAttribute('href', urls.web);
    button.addEventListener('click', (e) => handleClick(e, urls));
}

//Create WhatsApp URLs
function createUrls(title) {
    const message = `Hello, I came across an opportunity on your website and would appreciate more information regarding - ${title}`;
    const params = `?phone=${CONFIG.PHONE}&text=${encodeURIComponent(message)}`;

    return {
        direct: `${CONFIG.DIRECT_URL}${params}`,
        web: `${CONFIG.WEB_URL}${params}`
    };
}

//Handle click event for the WhatsApp button
function handleClick(e, urls) {
    e.preventDefault();
    window.location.href = urls.direct;

    setTimeout(() => {
        if (document.hasFocus()) {
            window.location.href = urls.web;
        }
    }, CONFIG.DELAY);
} 