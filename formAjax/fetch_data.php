<?php
    // Vérification de la requête POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupération de l'option sélectionnée
        $selectedOption = $_POST["option"];
        $type = $_POST["type"];

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

        // Construction de la requête SQL en fonction de l'option sélectionnée
        if ($type == "ville") {
            $sql = "SELECT idVille, libelleVille FROM Ville";
            $textKey = "libelleVille";
            $valueKey = "idVille";
        } elseif ($type == "agence") {
            $sql = "SELECT idAgence, libelleAgence FROM Agence WHERE idVille = '" . $selectedOption . "'";
            $textKey = "libelleAgence";
            $valueKey = "idAgence";
        } elseif ($type == "service") {
            $sql = "SELECT idService, libelleService FROM Service WHERE idAgence = '" . $selectedOption . "'";
            $textKey = "libelleService";
            $valueKey = "idService";
        }

        // Exécution de la requête SQL
        $result = $conn->query($sql);

        // Vérification des résultats et construction du tableau d'options
        if ($result->num_rows > 0) {
            $options = array();
            while ($row = $result->fetch_assoc()) {
                $option = array(
                    "text" => $row[$textKey],
                    "value" => $row[$valueKey]
                );
                array_push($options, $option);
            }
            echo json_encode($options);
        } else {
            echo json_encode(array());
        }

        // Fermeture de la connexion à la base de données
       // $conn->close();
    }
