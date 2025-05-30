// WhatsApp functionality
document.addEventListener('DOMContentLoaded', () => {
    const CONFIG = {
        MOBILE_URL: 'whatsapp://send',
        WEB_URL: 'https://api.whatsapp.com/send'
    };

    // Get WhatsApp settings from WordPress
    const whatsappNumber = (window.contactInfoSettings && contactInfoSettings.whatsappNumber) || '';
    const whatsappMessage = (window.contactInfoSettings && contactInfoSettings.whatsappMessage) || '';

    // Detect if user is on mobile
    const isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);

    document.querySelectorAll('.whatsapp-btn').forEach(button => {
        const dealCards = button.closest('.deal-cards');
        const titleElement = dealCards?.querySelector('.deal-title');
        if (!dealCards || !titleElement) return;

        const title = titleElement.textContent.trim();
        const params = `?phone=${whatsappNumber}&text=${encodeURIComponent(`${whatsappMessage} - ${title}`)}`;
        
        // Set default href to web version
        const webUrl = `${CONFIG.WEB_URL}${params}`;
        button.setAttribute('href', webUrl);

        button.addEventListener('click', e => {
            if (!isMobile) return; // Let default href handle desktop

            e.preventDefault();
            const mobileUrl = `${CONFIG.MOBILE_URL}${params}`;
            
            // Try mobile app first
            window.location.href = mobileUrl;
            
            // Fallback to web version after a short delay
            setTimeout(() => {
                window.location.href = webUrl;
            }, 300);
        });
    });
}); 