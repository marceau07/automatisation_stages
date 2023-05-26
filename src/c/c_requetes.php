<?php

include_once __DIR__ . '/../m/connect.php';

if (isset($_POST['recupererDonnees']) && !empty($_POST['recupererDonnees'])) {
    $html = '';
    $sessions = array();
    foreach (recupererDonnees() as $data) {
        $head = '';
        $footer = '';
        if (!in_array($data['nom_session'], $sessions)) {
            array_push($sessions, $data['nom_session']);
            $head = '
            <table class="table-stages" id="table-stages-' . $data['nom_session'] . '">
                <thead>
                    <tr>
                        <th>Session</th>
                        <th>NOM</th>
                        <th>Prénom</th>
                        <th>Horaire mois 1</th>
                        <th>Horaire mois 2</th>
                        <th>Horaire mois 3</th>
                        <th>Attestation (envoyée/reçue)</th>
                        <th>Évaluation (demande/reçue)</th>
                        <th>Envoi/Relance</th>
                    </tr>
                </thead>
                <tbody>';
        }
        $html .= $head . '
        <tr>
            <td>' . strtoupper($data['nom_session']) . '</td>
            <td>' . strtoupper($data['nom']) . '</td>
            <td>' . ucfirst($data['prenom']) . '</td>
            <td class="' . (!empty($data['horaires_recues_1']) ? 'coul-vert' : 'coul-rouge') . '">' . (!empty($data['horaires_recues_1']) ? 'Oui' : 'Non') . '</td>
            <td class="' . (!empty($data['horaires_recues_2']) ? 'coul-vert' : 'coul-rouge') . '">' . (!empty($data['horaires_recues_2']) ? 'Oui' : 'Non') . '</td>
            <td class="' . (!empty($data['horaires_recues_3']) ? 'coul-vert' : 'coul-rouge') . '">' . (!empty($data['horaires_recues_3']) ? 'Oui' : 'Non') . '</td>
            <td class="' . (!empty($data['attestation_recue']) ? 'coul-vert' : 'coul-rouge') . '">' . (!empty($data['attestation_recue']) ? '<a href="/">Voir</a>' : '') . '&nbsp;' . (!empty($data['attestation_mail_envoye']) ? "Oui" : "Non") . '/' . (!empty($data['attestation_recue']) ? "Oui" : "Non") . '</td>
            <td class="' . (!empty($data['evaluation_recue']) ? 'coul-vert' : 'coul-rouge') . '">' . (!empty($data['evaluation_recue']) ? '<a href="/">Voir</a>' : '') . '&nbsp;' . (!empty($data['evaluation_mail_envoye']) ? "Oui" : "Non") . '/' . (!empty($data['evaluation_recue']) ? "Oui" : "Non") . '</td>
            <td ' . ($data['compteur_demandes'] === 0 ? 'premiere_demande' : 'plusieurs_demandes') . '>' . ($data['compteur_demandes'] === 0 ? '<a role="button" href="#">1ère demande</a>' : '<a role="button" href="#">Relance</a>') . '</td>
        </tr>' . $footer;
    }
    die(json_encode($html));
}
