class TextClamp {
    constructor(options = {}) {
        this.options = {
            containerClass: options.containerClass || '.clamp-container',
            contentClass: options.contentClass || '.line-clamp-6',
            btnClass: options.btnClass || '.read-more-btn',
            expandedText: options.expandedText || 'Read Less',
            collapsedText: options.collapsedText || 'Read More',
            maxLines: options.maxLines || 6
        };
        this.init();
    }

    init() {
        document.querySelectorAll(this.options.containerClass).forEach(container => {
            const content = container.querySelector(this.options.contentClass);
            const btn = container.querySelector(this.options.btnClass);
            
            if (content && btn) {
                // Initially hide the button
                btn.style.display = 'none';
                
                if (this.isOverflowing(content)) {
                    btn.style.display = 'inline-block';
                    btn.addEventListener('click', () => this.toggleContent(content, btn));
                }
            }
        });
    }

    isOverflowing(element) {
        return element.scrollHeight > parseInt(getComputedStyle(element).lineHeight) * this.options.maxLines;
    }

    toggleContent(content, btn) {
        const isExpanded = !content.classList.contains(this.options.contentClass.slice(1));
        content.classList.toggle(this.options.contentClass.slice(1));
        btn.textContent = isExpanded ? this.options.collapsedText : this.options.expandedText;
    }
}

export default TextClamp; 