<?php
include_once __DIR__ . '/m/connect.php';
include_once __DIR__ . '/m/requetes.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Automatisation documents stage</title>
    <link rel="stylesheet" href="css/style.css?v=<?=uniqid()?>">
</head>
<body>
    <div id="tables-stages"></div>
    <div class="container">
        <a data-modal="modal-one">Open Modal</a>
    </div>

    <div class="modal" id="modal-one">
        <div class="modal-bg"></div> <!-- Ajouter la classe "modal-exit" si on souhaite quitter la modale en cliquant à l'extérieur -->
        <div class="modal-container">
            <button class="modal-close modal-exit">X</button>
            <div>
                <label for="horaires_mois_1">
                    <input type="checkbox" name="horaires_mois_1" id="horaires_mois_1" checked>
                    Horaires mois 1
                </label>
            </div>
            <div>
                <label for="horaires_mois_2">
                    <input type="checkbox" name="horaires_mois_2" id="horaires_mois_2" checked>
                    Horaires mois 2
                </label>
            </div>
            <div>
                <label for="horaires_mois_3">
                    <input type="checkbox" name="horaires_mois_3" id="horaires_mois_3" checked>
                    Horaires mois 3
                </label>
            </div>
            <div>
                <label for="attestation_de_stage">
                    <input type="checkbox" name="attestation_de_stage" id="attestation_de_stage" checked>
                    Attestation de stage
                </label>
            </div>
            <div>
                <label for="evaluation_de_stage">
                    <input type="checkbox" name="evaluation_de_stage" id="evaluation_de_stage" checked>
                    Évaluation de stage
                </label>
            </div>
            <button class="modal-exit">Annuler</button>
            <button class="modal-send modal-exit">Envoyer</button>
        </div>
    </div>
    <script src="js/script.js?v=<?=uniqid()?>"></script>
</body>
</html>
