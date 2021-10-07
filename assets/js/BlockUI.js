class BlockUI {
    static block(node, message) {
        if (!this.isBlocked(node)) {
            let overlay = document.createElement('div');
            let loader = document.createElement('span');

            overlay.classList.add('block-overlay', 'js-block-element');
            overlay.style.width = node.offsetWidth + "px";
            overlay.style.height = node.offsetHeight + "px";

            loader.classList.add('loader-icon');
            overlay.appendChild(loader);

            if (message) {
                let text = document.createElement('span');
                text.classList.add('block-message');
                text.innerHTML = message;

                overlay.appendChild(text);
            }

            node.classList.add('processing');
            node.prepend(overlay);
        }
    }

    static unblock(node) {

        if (!this.isBlocked(node)) {
            return false;
        }

        node.classList.remove('processing');

        let blockElement = node.querySelector('.js-block-element');

        if (null != blockElement) {
            blockElement.remove();
        }
    }

    static isBlocked(node) {
        return node.classList.contains('processing');
    }
}