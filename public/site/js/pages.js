document.addEventListener('DOMContentLoaded', function () {
    var dropdownButton = document.getElementById('coreDropdownBtn');
    var dropdownMenu = document.getElementById('coreDropdownMenu');

    if (dropdownButton && dropdownMenu) {
        dropdownButton.addEventListener('click', function () {
            dropdownMenu.classList.toggle('show');
        });

        document.addEventListener('click', function (event) {
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.remove('show');
            }
        });
    }
});
