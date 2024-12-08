document.addEventListener('DOMContentLoaded', () => {
    const textElement = document.getElementById('changingText');
    const buttons = document.querySelectorAll('.NeumorphismButton');
    //textes pour chaque bouton
    const BaseText = "C.A.D.U.S. vous aide à obtenir votre dossier médical et à constituer " +
                            "votre demande d'indemnisation, en veillant à éviter les erreurs " +
                            "ou omissions. Ils vous conseillent tout au long de votre parcours jusqu'à l'indemnisation.";
    const buttonsText = {
        BtnDossier: {
            Text: BaseText,

        },
        BtnIndemn: {
            Text: " L'association étudie votre dossier médical pour déterminer l'existence des différents préjudices" +
                    " et fournit les éléments indispensables à leur indemnisation. Elle " +
                    "vous conseille sur le choix des commentaires à apporter et met en avant tous les préjudices subis.",

        },
        BtnJur: {
            Text: "C.A.D.U.S. vous informe sur vos droits en tant que victime et vous aide à obtenir " +
                "une aide juridictionnelle, ainsi que l'assistance juridique prévue dans vos contrats d'assurance.",

        },
        BtnNego: {
            Text: "L'association vous prépare à la négociation et à l'expertise médicale, favorisant une indemnisation rapide" +
                " dans le cadre d'une procédure à l'amiable et la résolution des conflits par la conciliation.",

        }
    };


    // Fonction qui garde le style :active d'un bouton jusqu'à qu'un autre bouton soit activer
    buttons.forEach(button => {
        button.addEventListener('click', () => {
            if (button.classList.contains('active')) {
                button.classList.remove('active');
            } else {
                buttons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
            }
        });
    });

    // Fonction pour l'activation d'un bouton
    function handleClick(buttonId) {
        textElement.style.opacity = 0;
        setTimeout(() => {
            textElement.textContent = buttonsText[buttonId].Text;
            // animation de transition
            textElement.style.opacity = 0.75;
        }, 300);
    }


    document.getElementById('BtnDossier').addEventListener('click', () => handleClick('BtnDossier'));
    document.getElementById('BtnIndemn').addEventListener('click', () => handleClick('BtnIndemn'));
    document.getElementById('BtnJur').addEventListener('click', () => handleClick('BtnJur'));
    document.getElementById('BtnNego').addEventListener('click', () => handleClick('BtnNego'));
});