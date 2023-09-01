<p align="center"><img src="public\images\generiques\garagevparrot.jpg">

<h1>Projet Garage V. PARROT</h1>

Bonjour et bienvenue ! <br>
Vous trouverez ci-dessous l'ensemble des étapes à suivre afin de déployer dans un environnemen local le projet Garage V.Parrot. 
Pour tester les différentes fonctionnalités de l'application, veuillez vous rendre dans le  "_manuel d'utilisation_" dans le dossier **Annexes**. Vous y trouverez notamment les identifiants de connexion de l'Admin et un employé. <br>
Je vous souhaite une excellente navigation !

<h2>Description </h2>

Dépôt du projet Garage 

Les documents annexes sont disponibles dans le dossier ANNEXES : 
<ul>
<li>Charte graphique</li>
<li>Manuel d'utilisation</li>
<li>Documentation technique</li>
</ul>

<h2> Pré-requis avant l'exécution locale du projet </h2>

Installation de XAMPP (version 8.2.4) et démarrage des modules Apache & MySQL <br>
Installation de PHP (version 8.2.4 utilisée dans ce projet) <br>
Installation de Composer qui est un gestionnaire de dépendances <br>
Installation de Doctrine

<h2> Récupération du projet depuis le dépôt distant Github </h2>

Pour récupérer le projet Garage V PARROT, copier la commande GIT Clone ci-dessous et coller-là dans votre terminal GIT pour y récupérer le dépôts. <br>
/* lien du git*/

Vous devriez voir apparaitre l'arborescence du projet au sein de votre IDE. 

<h2> Installation </h2>

**Déplacez-vous dans le dossier en tapant dans votre invite de commandes :** <br>
> cd Garage-V-Parrot <br>

Le lien de la base de donnée figure déjà dans le fichier .env. Cette base est uniquement créée pour le garage. A défaut, <br>
vous pouvez la décommenter (en ajoutant # devant) ou directement la remplacer par votre base de donnée.

**Configuration de la base de données :** (à défaut d'utilisation de la base de données déjà présente)<br>
Dans le fichier .env au sein du répertoire racine du projet, configurez les identifiants de votre base de données : <br>
Exemple : DATABASE_URL="(votre base de données)"<br>

**Pour créer la base de données, effectuez la commande :** <br>
> symfony doctrine:database:create <br>

**Ensuite, pour mettre à jour la base de données locale, effectuez les migrations avec la commande :** 
> symfony doctrine:migrations:migrate
<h2> Utilisation </h2>

Pour lancer le serveur de développement, tapez l'invite de commande : 
> symfony server:start

