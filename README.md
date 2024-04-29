# Mathindex
Projet Symfony Fin d'année BTS2 

Présentation :
la plateforme Mathindex est un site internet permettant l'accès à une banque d'exercice en ligne.
Ce site est comprend plusieurs pages:
- une page d'accueil
- une page de connexion
- une page avec tous les exercices
- une page avec tous les exercices créés par le contributeur ou l'administrateur
- plusieurs pages d'administration

Identifiants de testing :

![Capture](https://github.com/BR4NJO/Mathindex/assets/101703473/0d35cade-fb22-440b-958f-14f730b08756)

Installation du projet :

1. afin d’initialiser le projet, veuillez vous rendre à la racine de projet et écrire en ligne de commande :

composer install

2. Si vous avez de modifié le style du projet, veuillez entrer les commandes suivantes :

npm init
npm Install @symfony/stimulus-bridge
npm run watch

3. Afin de créer la base de données, veuillez entrer ces lignes de commande :

php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force

Cette ligne permet de créer les données de test :

php bin/console doctrine:fixtures:load 

4. Le démarrage du server se fait via cette dernière commande :
 
symfony server:start

Après cela, vous aurez accès au site à l'adresse locale :

127.0.0.1:8000


Auteurs:

- Marcus Favernay (github : marcusWeb04)
- Dimitri Granit (github : Snekye)
- Alexandre Brunet (github : BR4NJO)
