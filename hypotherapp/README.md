# Hypotherapp - Gestion des Poneys 🐴🗓️💰

Hypotherapp est une application web développée avec Laravel pour gérer les **rendez-vous**, les **clients**, les **poneys** et surtout la **facturation**. Elle permet aux utilisateurs de **planifier des rendez-vous**, **assigner des poneys à des clients** et **générer des factures PDF** automatiquement.

## 🚀 Fonctionnalités principales

- **🔒 Authentification** : Inscription, connexion et gestion des utilisateurs avec des rôles (admin, employee).
- **🤝 Gestion des clients** : Ajouter, modifier et supprimer des clients.
- **🐴 Gestion des poneys** : Assigner des poneys à des rendez-vous, ajouter de nouveaux poneys, modifier et supprimer des poneys.
- **🗓️ Rendez-vous** : Planifier des rendez-vous avec des créneaux horaires disponibles.
- **💰 Facturation (PDF)** : Générer des factures PDF détaillées grâce à **Laravel DomPDF**.
- **🎨 Interface utilisateur intuitive** : Conçue pour une navigation fluide et agréable.

## 🛠️ Technologies utilisées

- **Backend** : Laravel 10.x
- **Frontend** : Bootstrap 5, Font Awesome, Tailwind CSS
- **Template Engine** : Blade
- **Base de données** : SQLite
- **Génération de factures PDF** : `barryvdh/laravel-dompdf`
- **Autres outils** : Composer, npm, Carbon (gestion des dates)

## 📦 Installation

Suivez ces étapes pour installer et configurer le projet localement.

### ⚙️ Prérequis

- PHP 8.1 ou supérieur
- Composer
- Node.js et npm (pour les assets frontend)

### 🔧 Étapes d'installation

#### 1️⃣ Cloner le dépôt

```bash
git clone https://github.com/octhama/SandboxWebDynPHP.git
cd SandboxWebDynPHP/hypotherapp
```

#### 2️⃣ Installer les dépendances PHP

```bash
composer install
```

#### 3️⃣ Installer les dépendances JavaScript

```bash
npm install
npm run build
```

#### 4️⃣ Configurer l'environnement

Copiez le fichier `.env.example` en `.env` :

```bash
cp .env.example .env
```

Vérifiez la configuration de la base de données dans le fichier `.env` :

```env
DB_CONNECTION=sqlite
DB_DATABASE=../database/database.sqlite # Chemin vers la base de données SQLite
# DB_DATABASE="database/database.sqlite"  Chemin vers la base de données SQLite pour effectuer les migrations et les seeders
```

#### 5️⃣ Générer une clé d'application

```bash
php artisan key:generate
```

#### 6️⃣ Exécuter les migrations et les seeders

```bash
php artisan migrate --seed
```

#### 7️⃣ Installer Laravel DomPDF pour la facturation

Le package **`barryvdh/laravel-dompdf`** est utilisé pour générer des factures au format PDF. Installez-le avec :

```bash
composer require barryvdh/laravel-dompdf
```

#### 8️⃣ Démarrer le serveur de développement

```bash
php artisan serve
```

L'application sera accessible à l'adresse : **[http://127.0.0.1:8000](http://localhost:8000)**

## 📂 Structure du projet

```
📦 hypotherapp
├── app/         # Modèles, contrôleurs et middlewares
├── database/    # Migrations, seeders et database SQLite
├── resources/   # Vues Blade, assets (CSS, JS)
├── routes/      # Routes de l'application
├── public/      # Fichiers accessibles publiquement
├── config/      # Fichiers de configuration
└── .env         # Fichier de configuration de l'environnement
```

## 📌 Utilisation

### 🗓️ 1️⃣ Créer un rendez-vous

1. Connectez-vous à l'application.
2. Accédez à la section **Rendez-vous**.
3. Ajoutez un client, le nombre de poneys et le nombre de minutes (min 10 min, max 20 min).
4. Accédez à la section **Clients - Liste des clients** pour voir la liste des clients avec la possibilité de les modifier ou les supprimer et voir les factures et les générer.
5. Accédez à la section **Nouveau Rendez-vous** pour ajouter un nouveau rendez-vous avec un client, le nombre de poneys et le créneau horaire désiré pour utiliser les minutes.
6. Cliquez sur **Créer le rendez-vous**.
7. Le rendez-vous sera ajouté avec succès dans la liste des rendez-vous.

### 💰 2️⃣ Générer une facture PDF

1. Accédez à la section **Clients - Liste des clients**.
2. Cliquer sur le bouton **Voir** pour voir les détails du client et générer la facture.
3. Cliquez sur **Générer la facture PDF**.
4. Le fichier **PDF** sera téléchargé automatiquement.

### 🐴 3️⃣ Gérer les poneys

1. Accédez à la section **Poneys**.
2. Ajoutez un nouveau poney avec le formulaire.
3. Cliquer sur **Ajouter le poney**.
4. Le poney sera ajouté avec succès dans la liste des poneys.

### 👤 4️⃣ Créer un utilisateur

1. Accédez à l'application via ce lien : **[http://127.0.0.1:8000**.
2. Si vous n'avez pas de compte, cliquez sur **S'inscrire**.
3. Remplissez le formulaire d'inscription.
4. Choisissez un rôle : **admin** ou **employee**.
5. Cliquez sur **S'inscrire**.
6. Vous serez redirigé vers la page de connexion.
7. Connectez-vous avec vos identifiants.
8. Cliquez sur **Se connecter**.

## ✨ Auteur

**Octhama** - Développeur principal - [GitHub](https://github.com/octhama)

## ❤️ Remerciements

Merci à l'équipe de Laravel pour leur excellent framework, ainsi qu'à la communauté open-source pour les outils utilisés dans ce projet.
Merci à **maitrepylos** - Php Sensei - [GitHub](https://github.com/maitrepylos) pour ses précieux conseils et son soutien.


