# Mathindex
Projet Symfony Fin d'année BTS2 

Présentation :
La plateforme Mathindex est un site internet permettant l'accés à une banque d'exercice en ligne.
Ce site est comprends plusieurs pages:
- une page d'accueil
- une page de connexion
- une page avec tous les exercices
- une page avec tout les exercices créer par le contributeur ou l'administrateur
- plusieurs page d'administration


Identifiants :

![Capture](https://github.com/BR4NJO/Mathindex/assets/101703473/0d35cade-fb22-440b-958f-14f730b08756)


Installation du projet :

1. Afin d’initialiser le projet, veillez vous rendre à la racines de projet et écrire en ligne de commande :

composer install


2. Si vous avez de modifier le style du projet, veillez entrer la commande suivante :

npm init
npm install @symfony/stimulus-bridge
npm run watch

3. Afin de créer la base de donnée et de charger les donnés de test veillez entrer c’est lignes de commandes :

symfony console doctrine:database:create
symfony console doctrine:schema:update
symfony console doctrine:fixtures:load 
(attention si vous ne voulez pas entrer les données de test, n’entrer pas la ligne ci-dessus)

4. Afin de pouvoir vous rendre sur le site internet, veillez entrer :
 
symfony server:start

aprés cela vous aurrez accés au site par le bié de ce lien :

127.0.0.1:8001
