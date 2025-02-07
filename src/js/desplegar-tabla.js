document.addEventListener('DOMContentLoaded', function() {
    const estateItems = document.querySelectorAll('.estate__item');

    estateItems.forEach(item => {
        item.addEventListener('click', function() {
            item.classList.toggle("estate__item--clicked")
        });
    });
});