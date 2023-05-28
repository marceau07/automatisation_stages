<?php 

function recupererDonnees() {
    global $db;

    $req = $db->prepare("SELECT nom, prenom, nom_session, horaires_recues_1, horaires_recues_2, horaires_recues_3, attestation_mail_envoye, attestation_recue, evaluation_mail_envoye, evaluation_recue, compteur_demandes
                        FROM stagiaires
                        JOIN sessions ON sessions.id = stagiaires.id_session
                        LEFT JOIN stages ON stages.id = stagiaires.id_stage;");
    $req->execute();
    $donnees = $req->fetchAll(PDO::FETCH_ASSOC);
    return $donnees;
}