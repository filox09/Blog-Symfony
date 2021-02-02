# Commande utiles pour symfony


- **Création d'un projet Symfony** : composer create-project symfony/website-skeleton nom-du-projet
- **Importation du Symfony Appache pack** : https://packagist.org/packages/symfony/apache-pack (ajoutez un htaccess)
- **Instalation du serveur web** : composer require server --dev   //  composer require symfony/web-server-bundle --dev ^4.4.2
- **Démarrer le serveur** : php bin/console server:run

- **Création d'un Controller** : php bin/console make:controller

- **Création d'une BDD avec doctrine** : php bin/console doctrine:database:create
- **Création d'une class php pour créer une table sur mysql** : php bin/console make:entity
- **Création de la migration** : php bin/console make:migration
- **Activé la migration** : php bin/console doctrine:migrations:migrate

- **Instalation de orm-fixtures** -  composer require orm-fixtures --dev (non-inclut dans le website-skeleton)
- **Création d'une Fixture (fausse donnée)** : php bin/console make:fixtures
- **Envoyer les fixtures à la base de donnée** : php bin/console doctrine:fixtures:load

- **Création d'un formulaire avec CLI Symfony** : php bin/console make:form