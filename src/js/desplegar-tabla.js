document.addEventListener('DOMContentLoaded', function() {
    const estateItems = document.querySelectorAll('.estate__item');

    estateItems.forEach(item => {
        item.addEventListener('click', function(e) {
            target = e.target
            if (!target.classList.contains("table-actions") && !target.classList.contains("table__icon--delete")) {
                    item.classList.toggle("estate__item--clicked")
            }
        });
    });
});