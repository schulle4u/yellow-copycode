// Copycode extension, https://github.com/schulle4u/yellow-copycode

document.addEventListener('DOMContentLoaded', function () {
    const codeBlocks = document.querySelectorAll('pre');
    const copyButtons = document.querySelectorAll('.copycode-btn');

    copyButtons.forEach((button, index) => {
        button.addEventListener('click', function () {
            // Create a temporary text area
            const tempTextArea = document.createElement('textarea');
            tempTextArea.value = codeBlocks[index].textContent;
            document.body.appendChild(tempTextArea);
            tempTextArea.select();

            try {
                // Copy text to clipboard
                document.execCommand('copy');

                // Save original button text
                const originalText = button.querySelector('.copycode-btn-text').textContent;

                // Get code copied message from data attribute
                const copiedText = button.getAttribute('data-copycodeCopied');

                // Update button label (visible part)
                button.querySelector('.copycode-btn-text').textContent = copiedText;

                // Update text for screen readers
                const srOnlySpan = button.querySelector('.copycode-sr-only');
                srOnlySpan.textContent = copiedText;

                // Restore original label after 2 seconds
                setTimeout(() => {
                    button.querySelector('.copycode-btn-text').textContent = originalText;
                    srOnlySpan.textContent = '';
                }, 2000);
            } catch (err) {
                console.error('Failed!', err);
            }

            // Remove temporary textarea
            document.body.removeChild(tempTextArea);
        });
    });
});
