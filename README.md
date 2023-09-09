<p align="center"><img src="public\images\generiques\garagevparrot.jpg">

<h1>Projet Garage V. PARROT</h1>

Bonjour et bienvenue ! <br>
Vous trouverez ci-dessous l'ensemble des étapes à suivre afin de déployer dans un environnemen local le projet Garage V.Parrot. 
Pour tester les différentes fonctionnalités de l'application, veuillez vous rendre dans le  "_manuel d'utilisation_" dans le dossier **Annexes**. Vous y trouverez notamment les identifiants de connexion de l'Admin et un employé. <br>
Je vous souhaite une excellente navigation !

<h2>Description </h2>

Dépôt du projet Garage 

Les documents suivants sont disponibles dans le dossier ANNEXES : 
<ul>
<li>Charte graphique</li>
<li>Manuel d'utilisation</li>
<li>Documentation technique</li>
<li> Requête SQL</li>
</ul>

<h2> Pré-requis avant l'exécution locale du projet </h2>

Installation de XAMPP (version 8.2.4) et démarrage des modules Apache & MySQL <br>
Installation de PHP (version 8.2.4 utilisée dans ce projet) <br>
Installation de Composer qui est un gestionnaire de dépendances <br>
Installation de Doctrine
Mettre en place un gestionnaire de base de données (PhpMyAdmin)

<h2> Récupération du projet depuis le dépôt distant Github </h2>

Pour récupérer le projet Garage V PARROT, copier la commande GIT Clone ci-dessous et coller-là dans votre terminal GIT pour y récupérer le dépôts. <br>
```
git clone https://github.com/Jonathan-Saenger/Garage-V-Parrot.git
```
Vous devriez voir apparaitre l'arborescence du projet au sein de votre IDE. 

<h2> Installation </h2>

**Déplacez-vous dans le dossier en tapant dans votre invite de commandes :** <br>
```
 cd Garage-V-Parrot
```
Le lien de la base de donnée figure déjà dans le fichier .env. Cette base est uniquement créée pour le garage. A défaut, <br>
vous pouvez la commenter (en ajoutant # devant) ou directement la remplacer par votre base de donnée dans un fichier .env.local que vous aurez créé
au préalable. Les étapes suivantes vous expliquent comment procéder si vous utilisez votre propre base de données. 

**Configuration de la base de données :** (à défaut d'utilisation de la base de données déjà présente)<br>
Dans le fichier .env.local au sein du répertoire racine du projet, configurez les identifiants de votre base de données : <br>
Exemple : DATABASE_URL="(votre base de données)"<br>

**Pour créer la base de données, effectuez la commande :** <br>
``` 
symfony doctrine:database:create
```

**Ensuite, pour mettre à jour la base de données locale, effectuez les migrations avec la commande :** 
```
symfony doctrine:migrations:migrate
```

**Créer le compte Admin de Vincent Parrot :** 

``` 
symfony console dbal:run-sql "INSERT INTO user (id, email, roles, password, nom, prenom) VALUES (NULL, 'vincentparrot@vparrot.com', '[\"ROLE_ADMIN\"]', '\$2y\$13\$98WQ3hxd/J0P7YthyL9gXeeM4pR/iheiwKWp20Gd/gXBAbUJclYqO', 'Parrot', 'Vincent');"
```
Login : vincentparrot@vparrot.com<br>
Password : Vincent3508;/ParrotAdmin<br>

ATTENTION : les passwords figurants dans l'application et la base de données doivent systématiquement être hashés. L'application les hashe automatiquement. <br>
A défaut, vous pouvez les hasher manuellement avec la commande : 
```
symfony console security:hash-password 
```
Vous n'avez plus qu'à copier puis coller le password hashé qui a été générer. <br>

Une fois le compte admin créé, vous pouvez utiliser pleinement l'application. 

<h2> Utilisation </h2>

Pour lancer le serveur de développement, tapez l'invite de commande : 
```
 symfony server:start
 ```

<h2> Configuration de la boite mail </h2>

Pour tester la boite mail dans un environnement local : <br>
Créer un fichier .env.local et ajouter la ligne suivante pour pouvoir vous connecter à la boite mail de l'application. 
``` 
MAILER_DSN=smtp://96e675448063ed:c21baf9a59b215@sandbox.smtp.mailtrap.io:2525 
```

Commentez la ligne figurant dans le fichier .env. avec # <br>
```
 #MAILER_DSN=smtp://96e675448063ed:c21baf9a59b215@sandbox.smtp.mailtrap.io:2525
 ```

Cela permettra de tester la boite mail en environnement local.

