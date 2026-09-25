document.addEventListener("DOMContentLoaded", function () {

    const form = document.querySelector("form");

    if (form) {
        form.addEventListener("submit", function () {
            const button = form.querySelector("button");

            if (button && button.name === "add") {
                button.textContent = "Qo‘shilmoqda...";
                button.disabled = true;
            }
        });
    }

    const deleteLinks = document.querySelectorAll(
        'a[href*="delete="]'
    );

    deleteLinks.forEach(function (link) {
        link.addEventListener("click", function (event) {
            const answer = confirm(
                "Bu o‘quvchini o‘chirishni xohlaysizmi?"
            );

            if (!answer) {
                event.preventDefault();
            }
        });
    });

});