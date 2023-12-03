# UE-L312-2023-carpooling

*****************************************

Ce fichier README a été généré le 3 decembre 2023 par \
Valentine Maillard et Siham Charef \
Dernière mise-à-jour le : 3 décembre 2023.

***************************************
# INFORMATIONS GENERALES
***************************************

## Titre du dossier

UE-312-2023-carpooling

## Objectifs de l'application

Permettre aux utilisateurs de faire du covoiturage
Créer un profil, associer des voitures, publier une annonce et réserver

## Auteurs et contact

2 étudiantes de l'Université de Limoges \
[@Siham Charef](https://github.com/SihamWeb) - siham.charef@etu.unilim.fr \
[@Valentine Maillard](https://github.com/Valou38) - valentine.maillard@etu.unilim.fr


## Accessibilité

L'ensemble du code est hébergé de façon publique sur la plateforme GitHub \
https://github.com/Valou38/GroupeC-S3-L311-2023



*******************************************
# LE PROJET
*******************************************

## Cadre du projet

Projet créé dans le cadre de la formation Licence professionnelle métiers de l'informatique - Applications web de l'Université de Limoges. \
Travail de groupe constitué de 2 étudiants en 3ème année \
Promotion 2023 - 2024

## Méthodologie du projet

Jeu de fichiers créés suivant une base fournie par l'Université.
L'ensemble des modifications de programmation a été réalisé en équipe et de façon asynchrone par l'intermédiaire de logiciels annexes (JetBrains, Discord).
La majorité des parties a été divisée en part égale, même si souvent, lorsqu'on est bloqué, un regard neuf est utile.

## Objectifs du projet

Réaliser l'application web de covoiturage \
Editer et créer l'ensemble des fichiers pour permettre l'intégration des différentes fonctionnalités. 

Utilisation du modèle MVC (Modele - Vue - Controller)

**********************************************
# INFORMATIONS TECHNIQUES de l'APPLICATION
***********************************************

## Conditions de démarrage

Vérifier dans le fichier class/Services/DataBaseService.php que vos identifiants locaux correspondent à ceux du ficher.

Créer votre base de données "carpooling" et importer le fichier tables.sql dans votre gestionnaire de bases de données SQL.

## Fonctionnement

Pour faire fonctionner l'application, lancer le fichier index.php dans un navigateur \
Une fois l'application lancée, La possibilité de créer un compte s'offre à vous. \
Une fois le compte créé, vous pouvez consulter et réserver une annonce. \
Pour pouvoir créer une annonce, veuillez au préalable ajouter vos voitures. \

## Languages d'écriture

Les fichiers sont écrits en PHP, CSS, HTML, SQL. Le Readme est un .Markdown.

## Arborescence


```
UE-312-2023-carpooling _ branche main

├── assets
    └── CSS
        └── style.css    
├── class
    ├── Controller
        ├── AdsController.php
        ├── CarsController.php
        ├── ReservatiosnController.php
        └── UsersController.php        
    ├── Entities
        ├── Ad.php
        ├── Car.php
        ├── Reservation.php    
        └── User.php
    └── Services
        ├── AdsService.php
        ├── CarsService.php
        ├── DataBaseService.php
        ├── ReservationsService.php
        └── UserService.php        
└── vendor
    └── Composer
        └── autoload.php

ads_create.php
ads_delete.php
ads_read.php
ads_update.php
cars_create.php
cars_delete.php
cars_read.php
cars_update.php
composer.json
index.php
README.md
reservations_create.php
reservation_delete.php
reservation_read.php
reservations_update.php
tables.sql
users_create.php
users_delete.php
users_read.php
users_update.php

```

