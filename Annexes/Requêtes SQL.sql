CREATE DATABASE garage ;

-- Table Admin (Vincent PARROT)
CREATE TABLE admin (
    id INT AUTO_INCREMENT NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    nom VARCHAR(255) NOT NULL,
    mail VARCHAR(255) NOT NULL,
    motdepasse VARCHAR(255) NOT NULL, 
    PRIMARY KEY (id)
);

-- Table Garage
CREATE TABLE garage (
    id INT AUTO_INCREMENT NOT NULL,
    nom VARCHAR(255) NOT NULL,
    adresse VARCHAR(255) NOT NULL, 
    code_postal INT(11),
    ville VARCHAR(255),
    telephone INT(11),
    PRIMARY KEY (id)
);

-- Table horaire du garage 
CREATE TABLE horaire (
    id INT AUTO_INCREMENT NOT NULL,
    jour VARCHAR(255) NOT NULL,
    heure_ouverture TIME DEFAULT NULL,
    heure_fermetre TIME DEFAULT NULL,
    admin_id INT DEFAULT NULL,
    garage_id INT DEFAULT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (admin_id) REFERENCES admin(id),
    FOREIGN KEY (garage_id) REFERENCES garage(id)
);

-- Table Employés 
CREATE TABLE employe (
    id INT AUTO_INCREMENT NOT NULL, 
    prenom VARCHAR(255) NOT NULL, 
    nom VARCHAR(255) NOT NULL, 
    email VARCHAR(255) NOT NULL, 
    motdepasse VARCHAR(255) NOT NULL, 
    admin_id INT DEFAULT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (admin_id) REFERENCES admin(id)
);

-- Table User 
CREATE TABLE user (
    id INT AUTO_INCREMENT NOT NULL, 
    email VARCHAR(180) NOT NULL, 
    roles LONGTEXT NOT NULL, 
    password VARCHAR(255) NOT NULL, 
    nom VARCHAR(255) DEFAULT NULL, 
    prenom VARCHAR(255) DEFAULT NULL, 
    PRIMARY KEY (id)
);

-- Table User-Employé
CREATE TABLE user_employe (
    user_id INT NOT NULL,
    employe_id INT NOT NULL,
    PRIMARY KEY(user_id, employe_id),
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (employe_id) REFERENCES employe(id)
);

-- Table Annonce des véhicules d'occasions
CREATE TABLE annonce (
    id INT AUTO_INCREMENT NOT NULL, 
    photo LONGBLOB NOT NULL, 
    titre VARCHAR(255) NOT NULL,
    description LONGTEXT NOT NULL, 
    infotechniques VARCHAR(255) NOT NULL, 
    marque VARCHAR(255) NOT NULL, 
    prix NUMERIC(6, 2) NOT NULL,
    annee INT NOT NULL, 
    kilometrage INT NOT NULL, 
    informationcontact VARCHAR(255) NOT NULL, 
    garage_id INT DEFAULT NULL,
    FOREIGN KEY (garage_id) REFERENCES garage(id)
);

-- Table Services proposés par le garage 
CREATE TABLE service (
    id INT AUTO_INCREMENT NOT NULL,
    titre VARCHAR(255) NOT NULL, 
    description LONGTEXT NOT NULL, 
    photo LONGBLOB DEFAULT NULL,
    admin_id INT DEFAULT NULL,
    garage_id INT DEFAULT NULL, 
    PRIMARY KEY(id),
    FOREIGN KEY (admin_id) REFERENCES admin(id),
    FOREIGN KEY (garage_id) REFERENCES garage(id)
);

-- Table temoignage des clients 
CREATE TABLE temoignage (
    id INT AUTO_INCREMENT NOT NULL,
    nom VARCHAR(255) NOT NULL,
    commentaire LONGTEXT NOT NULL,
    note INT NOT NULL,
    publication TINYINT(1) NOT NULL,
    jourpublication DATE DEFAULT NULL,
    garage_id INT DEFAULT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (garage_id) REFERENCES garage(id)
);

-- Modification des tables

ALTER TABLE annonce 
    ADD image_name VARCHAR(255) DEFAULT NULL, 
    ADD image_size INT DEFAULT NULL, 
    ADD updated_at DATETIME DEFAULT NULL,
-- modification de la table après installation du bundle Vich Uploader 

ALTER TABLE annonce 
    ADD carburant VARCHAR(255) DEFAULT NULL, 
    ADD boite_vitesse VARCHAR(255) DEFAULT NULL,

ALTER TABLE horaire -- Ajout de deux propriétés pour éclaircir les horaires
    ADD ouverture_soir TIME NOT NULL, 
    ADD fermeture_soir TIME NOT NULL, 
    MODIFY admin_id INT NOT NULL, 
    MODIFY garage_id INT NOT NULL,

ALTER TABLE horaire 
    MODIFY  admin_id INT NOT NULL, 
    MODIFY  garage_id INT NOT NULL, 
    MODIFY  heure_ouverture TIME NOT NULL, 
    MODIFY  heure_fermeture TIME NOT NULL, 
    MODIFY  ouverture_soir TIME NOT NULL, 
    MODIFY  fermeture_soir TIME NOT NULL,

ALTER TABLE temoignage 
    MODIFY  garage_id INT NOT NULL, 
    MODIFY  note INT NOT NULL, 
    MODIFY  jourpublication DATE NOT NULL,

ALTER TABLE temoignage 
    MODIFY garage_id INT NOT NULL,

ALTER TABLE annonce 
    MODIFY photo LONGBLOB NOT NULL,

ALTER TABLE admin -- Modification de l'entité Admin
    ADD email VARCHAR(255) NOT NULL, 
    ADD password VARCHAR(255) NOT NULL, 
    DROP mail, 
    DROP motdepasse,

ALTER TABLE employe -- Modification de l'entité employé
    ADD email VARCHAR(255) NOT NULL, 
    ADD password VARCHAR(255) NOT NULL, 
    DROP mail, 
    DROP motdepasse,

ALTER TABLE service
    MODIFY admin_id INT NOT NULL, 
    MODIFY garage_id INT NOT NULL, 
    MODIFY photo LONGBLOB NOT NULL,

-- Création du compte de l'Admin Vincent PARROT & d'un salarié
INSERT INTO user (id, email, roles, password, nom, prenom)
    VALUES 
    (NULL, 'vincentparrot@vparrot.com', '[\"ROLE_ADMIN\"]', '$2y$13$98WQ3hxd/J0P7YthyL9gXeeM4pR/iheiwKWp20Gd/gXBAbUJclYqO', 'Parrot', 'Vincent'),
    (NULL, 'harrywinsley@vparrot.com','[\"ROLE_USER\"]','$2y$13$Qai4nr6WhcjzOESrD8NAd.AAZqWeUA41X61gQMFPMSlKsD1qwjoEu','Winsley', 'Harry');

-- Création des horaires d'ouverture et fermeture du garage 
INSERT INTO horaire (id, jour, heure_ouverture, heure_fermeture, admin_id, garage_id, ouverture_soir, fermeture_soir) 
VALUES 
(NULL, 'Lun.', '08:00:00', '12:00:00', NULL, NULL, '14:00:00', '17:30:00'),
(NULL, 'Mar.', '08:00:00', '12:00:00', NULL, NULL, '14:00:00', '19:00:00'),
(NULL, 'Mer.', '10:00:00', '12:00:00', NULL, NULL, '14:00:00', '16:30:00'),
(NULL, 'Jeu.', '10:00:00', '12:00:00', NULL, NULL, '14:00:00', '16:30:00'),
(NULL, 'Ven.', '08:00:00', '12:00:00', NULL, NULL, '14:00:00', '19:00:00'),
(NULL, 'Sam.', '08:00:00', '12:00:00', NULL, NULL, '14:00:00', '19:00:00'),
(NULL, 'Dim.', NULL, NULL, NULL, NULL, NULL, NULL); -- la valeur NULL est affichée "fermé" dans la vue 

-- Création des services proposés par le garage 
INSERT INTO service (id, titre, description, photo, admin_id, garage_id, image_name, image_size, updated_at)
VALUES 
(NULL, 'Disques', 'Remplacement du système de freinage. Remplacement disques et plaquettes de freins avant et arrière (mâchoires et tambours). Remplacement liquide de frein. Canalisation des freins et flexibles. Purge des freins', LOAD_FILE('public/images/annonce/plaquettes-and-freins-64b6e5371afc9591637243.jpg'), NULL, NULL, NULL, NULL, NULL),
(NULL, 'Vidange/entretien', 'Pour préserver votre moteur Pendant le remplacement de l’huile moteur, vérification gratuite sur la vidange et les filtres, le liquide de direction assistée, la vidange boîte de vitesse manuelle et automatique, le remplacement du liquide de refroidissement / antigel.', LOAD_FILE('public/images/annonce/vidange-and-entretien-64b6e5605ed4d100910004.jpg'), NULL, NULL, NULL, NULL, NULL),
(NULL, 'Boite de vitesse', 'Remplacement de la boite de vitesse Vidange boîte de vitesse manuelle et automatique, remplacement volant moteur, remplacement kit d’embrayage, remplacement de la transmission et soufflet de transmission, réparation de la boîte de vitesse.', LOAD_FILE('public/images/annonce/boite-de-vitesse-64b6e5963e71a230779048.jpg'), NULL, NULL, NULL, NULL, NULL),
(NULL, 'Echappement', 'Remplacement et réparation du système d’échappement Remplacement ou réparation du pot d’échappement, remplacement ou réparation du silencieux, nettoyage du système d’échappement, remplacement additifs FAP, changement de vanne EGR.', LOAD_FILE('public/images/annonce/echappement-64b6e6e335259335370058.jpg'), NULL, NULL, NULL, NULL, NULL),
(NULL, 'Diagnostic auto', 'En cas de panne électrique Nous prenons en charge le diagnostic sur tous les véhicules. Une lecture des codes défauts de vos calculateurs, un effacement des codes défauts sporadiques, diagnostic électronique, édition d’un bilan complet, explication des anomalies trouvées.', LOAD_FILE('public/images/annonce/diagnostique-64b6e8ee681ef528885321.jpg'), NULL, NULL, NULL, NULL, NULL),
(NULL, 'Pneus et roues', 'Vos pneus sont endommagés ? Nos équipes vous accueillent pour la réparation ou le remplacement de vos pneumatiques, toute marque de véhicule comprise. Nous changeons dans les meilleurs délais les pneus lisses ou endommagés. Faites-nous confiance pour une expérience de conduite en toute tranquillité.', LOAD_FILE('public/images/annonce/changement-roue-64b6e4aa3de05639994861.jpg'), NULL, NULL, NULL, NULL, NULL);

-- Création des véhicules d'occasions 
INSERT INTO annonce (id, photo, titre, description, infotechniques,marque, prix, annee, kilometrage, informationcontact, garage_id, image_name, image_size, updated_at, carburant, boite_vitesse) 
VALUES 
(NULL, LOAD_FILE('public/images/annonce/citroen-c4-caktus-64e3d27945ce7728400022.jpg'), 'Citroën C4 Cactus', 'Equipements et options : ABS, Contrôle de pression des pneus, Direction assistée, Aide parking, Banquette AR 1/3 - 2/3, Fermeture centralisée. Camera de recul Park Assit Capteur de pluie', 'PureTech 110 S&S EAT6 Shine (6 CV)', 'Citroën', '16500', '2020', '26500', NULL, NULL, NULL, NULL, NULL, 'Essence', 'Automatique'),
(NULL, LOAD_FILE('public/images/annonce/peugeot-308-64e3d48923851196771591.jpg'), 'Peugeot 308', '5 places Banquette AR 1/3 - 2/3 Vitres électriques Accoudoir central Climatisation automatique multizones Fermeture centralisée Airbag frontaux', '130ch S&S EAT8 GT Line', 'Peugeot ', '23180', '2019', '39000', NULL, NULL, NULL, NULL, NULL, 'Essence', 'Manuelle'),
(NULL, LOAD_FILE('public/images/annonce/dacia-fabia-64e3d5b279dd2294366377.jpg'), 'Skoda Fabia 1.4', 'Banquette AR 1/3 - 2/3 Vitres électriques Ordinateur de bord Airbags frontaux + latéraux Régulateur de vitesse Consommation mixte: 4.0 litres / 100 km', 'TDI 90 CR FAP BVM5 Clever (5 CV)', 'Skoda', '11900', '2018', '92289', NULL, NULL, NULL, NULL, NULL, 'Essence', 'Manuelle'),
(NULL, LOAD_FILE('public/images/annonce/jaguar-e-pace-2-0-d-64e3d6cb94598699119612.jpg'), 'Jaguar E-Pace 2.0 D', 'Consommation mixte: 6.0 litres / 100 km Nb de portes: 4 portes avec hayon Nombre de places: 5 places Régulateur de vitesse adaptatif Système alerte de véhicule en approche Système de contrôle des angles morts Système de prévention des collisions AR', '150 ch AWD BVA R-Dynamic SE', 'Jaguar', '38500', '2019', '33000', NULL, NULL, NULL, NULL, NULL, 'Diesel', 'Automatique'),
(NULL, LOAD_FILE('public/images/annonce/nissan-qashqai-1-5-64e3d7dacc07e976075280.jpg'), 'Nissan Qashqai 1.5 dCi 115', 'Airbag frontaux, Airbags frontaux + latéraux Contrôle de stabilité (ESP Régulateur de vitesse Roues alliage léger Rétroviseurs électriques Banquette AR 1/3 - 2/3, Accoudoir central Climatisation automatique.', '6 CV 4x4 SUV ABS', 'Nissan', '18900', '2017', '72701', NULL, NULL, NULL, NULL, NULL, 'Essence', 'Automatique'),
(NULL, LOAD_FILE('public/images/annonce/toyota-yaris-69-64e3d9365a640193178937.jpg'), 'Toyota Yaris 69', 'Consommation mixte: 4.8 litres / 100 km Nb de portes: 4 portes avec hayon Nombre de places: 5 places Emissions de CO2: 110 g/km Ordinateur de bord Radio/CD', 'VVT-i Active 4 CV 4.8 litres', 'Toyota', '5000', '2011', '123000', NULL, NULL, NULL, NULL, NULL, 'Essence', 'Manuelle'),
(NULL, LOAD_FILE('public/images/annonce/citroen-c1pg-64e3da42cfdbe923731716.jpg'), 'Citroën C1 VTi', '2 portes avec hayon Equipements et options : ABS, Contrôle de pression des pneus, Rétroviseurs électriques, Banquette AR 1/3 - 2/3, Ordinateur de bord, Climatisation, caméra de recul, limitateur de vitesse Equipements et options : ABS, Contrôle de pression des pneus, Rétroviseurs électriques Banquette AR 1/3 - 2/3, Ordinateur de bord, Climatisation.', '68 S&S Shine (3 CV) 3.8 litres', 'Citroën', '7990', '2014', '61500', NULL, NULL, NULL, NULL, NULL, 'Essence', 'Manuelle'),
(NULL, LOAD_FILE('public/images/annonce/citroen-saxo-1-1i-athena-64e50920510ed964508857.jpg'), 'Citroën Saxo 1.1i Athena', 'Nombre de places: 5 places 2 portes avec hayon Direction assistée Vitres électriques Fermeture centralisée Vitres teintées', 'Berline 5 CV CritAir 3', 'Citroën', '1700', '1997', '114800', NULL, NULL, NULL, NULL, NULL, 'Essence', 'Manuelle'),
(NULL, LOAD_FILE('public/images/annonce/renault-megane-estate-iii-64e50a403e153256523208.jpg'), 'Renault Mégane Estate III', 'Banquette AR 1/3 - 2/3 Vitres électriques Climatisation ABS, Airbags frontaux + latéraux Régulateur de vitesse Rétroviseurs électriques Filtres à particules (FAP)', '', 'Renault', '4300', '2010', '2361000', NULL, NULL, NULL, NULL, NULL, 'Diesel', 'Manuelle'),
(NULL, LOAD_FILE('public/images/annonce/volkswagen-new-beetle-64e50b673c88a517790488.jpg'), 'Volkswagen New Beetle', 'Equipements et options : ABS, Antipatinage (ASR), Airbag frontaux, Airbags frontaux + latéraux, Contrôle de stabilité (ESP), Rétroviseurs électriques, Direction assistée, Vitres électriques, Climatisation, Accoudoir central, Fermeture centralisée, Vitres teintées', '1.9 TDI - 100 (6 CV)', 'Volkswagen', '3800', '2004', '257500', NULL, NULL, NULL, NULL, NULL, 'Diesel', 'Manuelle'),
(NULL, LOAD_FILE('public/images/annonce/peugeot-207-cc-sport-64e50cbf6490c132169442.jpg'), 'Peugeot 207 CC Sport', 'Radar de recul - Rétroviseurs rabattables électriquement - Jantes alu - Phares directionnels - Rétroviseurs électriques dégivrants - Toit panoramique en verre - Banquette 1/3-2/3 - Clim automatique bi-zones - Direction électrique assistance variable - Fixations isofix aux places arrières - Ordinateur de bord', 'CC 1.6 HDi110ch', 'Peugeot', '4990', '2009', '180000', NULL, NULL, NULL, NULL, NULL, 'Diesel', 'Manuelle'),
(NULL, LOAD_FILE('public/images/annonce/volvo-kinetic-business-64e50e7b7804e461778579.jpg'), 'VOLVO S&S Kinetic Business', 'Emissions de CO2: 108 g/km Nb de portes: 4 portes avec hayon Emissions de CO2: 108 g/km REGULATEUR DE VITESSE, RADIO CD, GPS, RADAR DE STATIONNEMENT, CLIM', '114 ch, 6 CV, boite MA 5 portes', 'Volvo', '6100', '2014', '', NULL, NULL, NULL, NULL, NULL, 'Essence', 'Manuelle'),
(NULL, LOAD_FILE('public/images/annonce/mercedes-classe-c-200-64efb2c76d905786186904.jpg'), 'Mercedes Classe C 200', 'Emissions de CO2: 139 g/km Consommation mixte: 5.3 litres / 100 km Nb de portes: 4 portes Nombre de places: 5 places Équipements et options : ABS, Antipatinage (ASR), Airbag conducteur, Airbag frontaux, Contrôle de stabilité (ESP), Régulateur de vitesse, Allumage automatique des feux, Rétroviseurs électriques, dégivrants', 'CDI BlueEfficiency 7 CV Berline', 'Mercedes', '12500', '2013', '149000', NULL, NULL, NULL, NULL, NULL, 'Diesel', 'Manuelle');