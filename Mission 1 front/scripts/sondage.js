document.addEventListener("DOMContentLoaded", function() {
    const fieldsets = document.querySelectorAll("fieldset");
    const btnRetour = document.getElementById("btnRetour");
    const btnSuivant = document.getElementById("btnSuivant");
    const submitButton = document.querySelector('button[type="submit"]');
    let currentStep = 0;  // étape actuelle

    // afficher le fieldset courant
    function showStep(step) {
        // Cacher tous les fieldsets
        fieldsets.forEach((fieldset, i) => {
            if (i === step) {
                fieldset.classList.add("active");
            } else {
                fieldset.classList.remove("active");
            }
        });

        // Affichage des boutons
        btnRetour.style.display = step === 0 ? "none" : "inline-block";
        if (step === fieldsets.length - 1) {
            btnSuivant.classList.add("hidden");
            submitButton.classList.remove("hidden");
        } else {
            btnSuivant.classList.remove("hidden");
            submitButton.classList.add("hidden");
        }
    }

    // passer à l'étape suivante
    btnSuivant.addEventListener("click", function() {
        if (currentStep < fieldsets.length - 1) {
            currentStep++;
            showStep(currentStep);
        }
    });

    // revenir à l'étape précédente
    btnRetour.addEventListener("click", function() {
        if (currentStep > 0) {
            currentStep--;
            showStep(currentStep);
        }
    });

    showStep(currentStep);
});
