<?php
    // Vérification de la requête POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupération des données du formulaire
        $nom = $_POST['nom'];
        $whatsapp = $_POST["whatsapp"];
        $etat = $_POST["etat"];
        $login = $_POST["login"];
        $password = $_POST["password"];
        $idVille = $_POST["select1"];
        $idAgence = $_POST["select2"];
        $idService = $_POST["libelleService"];

        // Connexion à la base de données et exécution de la requête
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "tp";

        // Création de la connexion
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Vérification de la connexion
        if ($conn->connect_error) {
            die("Erreur de connexion à la base de données : " . $conn->connect_error);
        }

        // Construction de la requête SQL pour insérer les données dans la table Agent
        $sql = "INSERT INTO Agent (nom, whatsapp, etat, login, password, idVille) VALUES (?, ?, ?, ?, ?)";

        // Préparation de la requête SQL
        if ($stmt = $conn->prepare($sql)) {
            // Liaison des variables à la requête préparée en tant que paramètres
            $stmt->bind_param($nom, $whatsapp, $etat, $login, $password, $idVille);

            // Exécution de la requête préparée
            if ($stmt->execute()) {
                echo "Les dones ont été insérées avec succès.";
            } else {
                echo "Erreur : " . $sql . "<br>" . $conn->error;
            }

            // Fermeture de l'instruction
            $stmt->close();
        }

        // Fermeture de la connexion à la base de données
       // $conn->close();
    }
?>
