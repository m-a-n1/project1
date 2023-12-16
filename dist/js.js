
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.counter-minus, .counter-plus').forEach(function (button) {
            button.addEventListener('click', function () {
                var input = this.parentElement.querySelector('input[type=number]');
                var currentValue = parseInt(input.value) || 0;
                if (this.classList.contains('counter-minus') && currentValue > 1) {
                    input.value = currentValue - 1;
                } else if (this.classList.contains('counter-plus')) {
                    input.value = currentValue + 1;
                }
            });
        });
});
