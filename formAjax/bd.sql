create table TP;

use tp;

-- Création de la table Ville
CREATE TABLE Ville (
    idVille INT PRIMARY KEY,
    libelleVille VARCHAR(255)
);

-- Création de la table Agence avec clé étrangère idVille
CREATE TABLE Agence (
    idAgence INT PRIMARY KEY,
    libelleAgence VARCHAR(255),
    idVille INT,
    FOREIGN KEY (idVille) REFERENCES Ville(idVille)
);

-- Création de la table Service avec clé étrangère idAgence
CREATE TABLE Service (
    idService INT PRIMARY KEY,
    libelleService VARCHAR(255),
    idAgence INT,
    FOREIGN KEY (idAgence) REFERENCES Agence(idAgence)
);

-- Création de la table Agent
CREATE TABLE Agent (
    int INT AUTO_INCREMENT PRIMARY KEY,
    whatsapp INT,
    etat INT,
    login VARCHAR(255),
    password TEXT,
    ville VARCHAR(255),
    idVille INT,
    FOREIGN KEY (idVille) REFERENCES Ville(idVille)
);
