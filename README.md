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

Identifiants :

![Capture](https://github.com/BR4NJO/Mathindex/assets/101703473/0d35cade-fb22-440b-958f-14f730b08756)


Installation du projet :

1. afin d’initialiser le projet, veuillez vous rendre à la racine de projet et écrire en lignes de commande :

composer install


2. Si vous avez de modifier le style du projet, veuillez entrer la commande suivante :

npm init
npm Install @symfony/stimulus-bridge
npm run watch

3. Afin de créer la base de données et de charger les donnés de tests veuillez entrer c’est lignes de commandes :

Symfony console doctrine: database: create
Symfony console doctrine: schéma: update
Symfony console doctrine: fixtures: load 
(attention si vous ne voulez pas entrer les données de test, n’entrer pas la ligne ci-dessus)

4. Afin de pouvoir vous rendre sur le site internet, veuillez entrer :
 
symfony server:start

Après cela vous aurez accès au site par le brier de ce lien :

127.0.0.1:8001


Autheurs:

- Marcus Favernay (github : marcusWeb04)
- Dimitri Granite (github : Snekye)
- Alexandre Brunet (github : BR4NJO)
