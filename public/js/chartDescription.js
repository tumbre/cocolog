window.addEventListener('DOMContentLoaded', () => {
    const questionIcons = document.querySelectorAll('#question-icon');
    const tooltipTexts = document.querySelectorAll('#tooltip-text');

    for (let i = 0; i < questionIcons.length; i++) {
        questionIcons[i].addEventListener('mouseenter', () => {
            tooltipTexts[i].classList.remove('opacity-0');
            tooltipTexts[i].classList.add('opacity-100');
        });

        questionIcons[i].addEventListener('mouseleave', () => {
            tooltipTexts[i].classList.remove('opacity-100');
            tooltipTexts[i].classList.add('opacity-0');
        });
    }
});