
# Api de test avec GraphQl

Bienvenue sur le dépôt Git de Ammar MOHAMADI, cette application web est construite avec Symfony 6.4.2 et utilisant MariaDB 10.6 comme système de gestion de base de données.

## Prérequis

Pour exécuter ce projet, vous aurez besoin des éléments suivants installés localement :
- PHP 8.1 ou supérieur
- Composer (pour la gestion des dépendances PHP)
- Symfony CLI
- MariaDB 10.6
- Un serveur web comme Apache

## Installation

1. Clonez ce dépôt sur votre machine locale.
   \`\`\`
   git clone https://github.com/webdev1401/jlotest.git
   cd jlotest
   \`\`\`

2. Installez les dépendances PHP avec Composer.
   \`\`\`
   composer install
   \`\`\`

3. Copiez le fichier `.env` en `.env.local` et ajustez les paramètres de connexion à la base de données.
   \`\`\`
   cp .env .env.local
   \`\`\`

4. Créez la base de données et appliquez les migrations.
   \`\`\`
   php bin/console doctrine:database:create
   php bin/console doctrine:migrations:migrate
   \`\`\`

5. (Optionnel) Chargez les fixtures pour avoir un jeu de données de départ.
   \`\`\`
   php bin/console doctrine:fixtures:load
   \`\`\`

6. Démarrez le serveur web local.
   \`\`\`
   symfony server:start
   \`\`\`

Votre application devrait maintenant être accessible à l'adresse https://localhost:8000.

## Utilisation

Vous pouvez interroger l'api de test via https://jlotest.prototyp.fr/api/graphql

## Support

Si vous rencontrez des problèmes ou avez des questions, n'hésitez pas à ouvrir un ticket ou à contacter le mainteneur à webdev@prototyp.fr.
