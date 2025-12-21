// Copycode extension, https://github.com/schulle4u/yellow-copycode

document.addEventListener("DOMContentLoaded", function () {
    const codeBlocks = document.querySelectorAll("pre");
    const copyButtons = document.querySelectorAll(".copycode-btn");

    copyButtons.forEach((button, index) => {
        button.addEventListener("click", function () {
            const tempTextArea = document.createElement("textarea");
            tempTextArea.value = codeBlocks[index].textContent;
            document.body.appendChild(tempTextArea);
            tempTextArea.select();

            try {
                document.execCommand("copy");

                const originalText = button.querySelector(".copycode-btn-text").textContent;

                const copiedText = button.getAttribute("data-copycode-copied");

                button.querySelector(".copycode-btn-text").textContent = copiedText;

                setTimeout(() => {
                    button.querySelector(".copycode-btn-text").textContent = originalText;
                }, 2000);
            } catch (err) {
                console.error("Failed!", err);
            }

            document.body.removeChild(tempTextArea);
        });
    });
});
