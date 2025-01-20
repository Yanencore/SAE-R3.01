document.addEventListener('DOMContentLoaded', function () {
    const checkbox = document.getElementById('showPswd');
    const passwordField = document.getElementById('mot-de-passe');

    if (checkbox && passwordField) {
        checkbox.addEventListener('change', function () {
            passwordField.type = this.checked ? 'text' : 'password';
        });
    }
});