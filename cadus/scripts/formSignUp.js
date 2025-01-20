
/**
 * Vérifie si les mots de passe correspondent avant d'envoyer le formulaire.
 * Affiche un message d'erreur si les mots de passe ne sont pas identiques.
 */
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const passwordInput = document.getElementById('mot-de-passe');
    const confirmPasswordInput = document.getElementById('conf-mot-de-passe');
    const passwordError = document.getElementById('password-error');

    form.addEventListener('submit', function (event) {
        if (passwordInput.value !== confirmPasswordInput.value) {
            event.preventDefault(); // Annule la soumission du formulaire
            passwordError.style.display = 'block'; // Affiche le message d'erreur
        } else {
            passwordError.style.display = 'none'; // Cache le message d'erreur
        }
    });
});
