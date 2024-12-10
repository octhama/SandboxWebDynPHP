# Laravel CRUD Application - Test Sandboxer

## Description
Ce projet est une application Laravel permettant de gérer des entités comme **Clients** (Customers) et **Employés** (Employees) avec des opérations CRUD (Create, Read, Update, Delete). Il utilise la base de données **Chinook** pour les tests et les démonstrations.

### Fonctionnalités principales :
- Gestion des **Clients** : Ajout, modification, suppression et affichage.
- Gestion des **Employés** : Ajout, modification, suppression et affichage.
- Une page d'accueil stylisée.
- Intégration complète de **Bootstrap** pour le design.

## Installation
### Prérequis :
- **PHP 8.0+**
- **Composer**
- **Laravel 10+**
- Une base de données SQLite (fichier fourni : `chinook.sqlite`)

### Étapes d'installation :
1. Clonez ce dépôt :
   ```bash
   git clone <URL_DU_DEPOT>
   cd <NOM_DU_DEPOT>
   ```

2. Installez les dépendances :
   ```bash
   composer install
   ```

3. Configurez le fichier `.env` :
   ```env
   DB_CONNECTION=sqlite
   DB_DATABASE=/chemin/vers/votre/chinook.sqlite
   ```

4. Exécutez le serveur de développement Laravel :
   ```bash
   php artisan serve
   ```

5. Accédez à l'application à l'adresse : [http://127.0.0.1:8000](http://127.0.0.1:8000)

## Commandes de Création de Ressources
Pour simplifier la gestion des entités dans l'application, utilisez les commandes artisan suivantes :

### Modèle et contrôleur pour les clients :
```bash
php artisan make:model Customer -m
php artisan make:controller CustomerController --resource
```

### Modèle et contrôleur pour les employés :
```bash
php artisan make:model Employee -m
php artisan make:controller EmployeeController --resource
```

Ces commandes :
- Créent les fichiers du modèle dans `app/Models/`.
- Créent des contrôleurs avec des méthodes prêtes pour les opérations CRUD dans `app/Http/Controllers/`.
- Génèrent des fichiers de migration (option `-m`) pour définir les tables dans la base de données.

## Structure du Projet
Voici une vue simplifiée de la structure du projet :

```
├── app
│   ├── Http
│   │   ├── Controllers
│   │   │   ├── CustomerController.php
│   │   │   └── EmployeeController.php
│   │   └── Middleware
│   ├── Models
│   │   ├── Customer.php
│   │   └── Employee.php
│   └── Providers
├── config
├── database
│   ├── migrations
│   ├── factories
│   └── chinook.sqlite
├── public
│   ├── css
│   ├── js
│   └── index.php
├── resources
│   ├── views
│   │   ├── customers
│   │   │   ├── _form.blade.php
│   │   │   ├── create.blade.php
│   │   │   ├── edit.blade.php
│   │   │   └── index.blade.php
│   │   ├── employees
│   │   │   ├── _form.blade.php
│   │   │   ├── create.blade.php
│   │   │   ├── edit.blade.php
│   │   │   └── index.blade.php
│   │   └── welcome.blade.php
├── routes
│   └── web.php
└── tests
    ├── Feature
    └── Unit
```

### Points importants :
- **Contrôleurs** : Gèrent la logique métier pour les clients et les employés.
- **Modèles** : Représentent les tables `Customer` et `Employee` de la base de données Chinook.
- **Vues** : Utilisent Blade pour afficher des interfaces utilisateur élégantes.
- **Formulaires partagés** : Les fichiers `_form.blade.php` sont réutilisables pour la création et la modification.
- **Page d'accueil** : `welcome.blade.php` offre une entrée élégante à l'application.

## Utilisation
### Gestion des Clients
1. Accédez à la section Clients via [http://127.0.0.1:8000/customers](http://127.0.0.1:8000/customers).
2. Ajoutez, modifiez ou supprimez un client.

### Gestion des Employés
1. Accédez à la section Employés via [http://127.0.0.1:8000/employees](http://127.0.0.1:8000/employees).
2. Ajoutez, modifiez ou supprimez un employé.

## Tests
1. Configurez l'environnement de test dans `.env.testing`.
2. Exécutez les tests :
   ```bash
   php artisan test
   ```

## Ressources utiles
- [Laravel Documentation](https://laravel.com/docs)
- [Bootstrap Documentation](https://getbootstrap.com/docs)
- [Chinook Database Schema](https://www.sqlitetutorial.net/sqlite-sample-database/)
