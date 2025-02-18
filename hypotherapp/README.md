# Hypotherapp - Gestion des Poneys 🐴🗓️💰

Hypotherapp est une application web développée avec Laravel pour gérer les **rendez-vous**, les **clients**, les **poneys** et surtout la **facturation**. Elle permet aux utilisateurs de **planifier des rendez-vous**, **assigner des poneys à des clients** et **générer des factures PDF** automatiquement.

## 🚀 Fonctionnalités principales

- **🤝 Gestion des clients** : Ajouter, modifier et supprimer des clients.
- **🐴 Gestion des poneys** : Assigner des poneys à des rendez-vous.
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

## 👅 Installation

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
DB_DATABASE=../database/database.sqlite
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

L'application sera accessible à l'adresse : **[http://localhost:8000](http://localhost:8000)**

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
3. Sélectionnez un client, une plage horaire et assignez des poneys.
4. Cliquez sur **Créer le rendez-vous**.

### 💰 2️⃣ Générer une facture PDF

1. Accédez à la section **Facturation**.
2. Sélectionnez un client et un mois.
3. Cliquez sur **Générer la facture PDF**.
4. Le fichier **PDF** sera téléchargé automatiquement.

## 🧪 Tests

Pour exécuter les tests unitaires et fonctionnels :

```bash
php artisan test
```

## 💪 Contribuer

Les contributions sont les bienvenues ! 🚀

1. **Forkez** le dépôt.
2. **Créez une branche** pour votre fonctionnalité :

   ```bash
   git checkout -b feature/nouvelle-fonctionnalite
   ```

3. **Committez vos changements** :

   ```bash
   git commit -m 'Ajouter une nouvelle fonctionnalité'
   ```

4. **Pushez la branche** :

   ```bash
   git push origin feature/nouvelle-fonctionnalite
   ```

5. **Ouvrez une Pull Request**.

## 📝 Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

## ✨ Auteur

**Octhama** - Développeur principal - [GitHub](https://github.com/octhama)

## ❤️ Remerciements

Merci à l'équipe de Laravel pour leur excellent framework, ainsi qu'à la communauté open-source pour les outils utilisés dans ce projet.
Merci à **maitrepylos** - Php Sensei - [GitHub](https://github.com/maitrepylos) pour ses précieux conseils et son soutien.


