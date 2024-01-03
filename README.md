# SaveurDuMaroc
 Création d’une application qui stocke des données et les récupère à partir du neo4j avec PHP Laravel
Pour lancer une application Laravel avec Neo4j, suivez ces étapes :

1. **Installation des dépendances :**
   Assurez-vous que vous avez installé Composer et Node.js sur votre machine. Ensuite, ouvrez une console et naviguez vers le répertoire de votre projet Laravel. Exécutez les commandes suivantes pour installer les dépendances :

   ```bash
   composer install
   npm install
   ```

2. **Configuration de la base de données Neo4j :**
   - Assurez-vous que Neo4j est installé et en cours d'exécution sur votre machine.
   - Configurez votre fichier `.env` avec les informations de connexion Neo4j que vous avez fournies, telles que :

     ```env
     DB_CONNECTION=neo4j
     NEO4J_CONNECTION=bolt
     NEO4J_HOST=localhost
     NEO4J_PORT=7687
     NEO4J_USERNAME=recette
     NEO4J_PASSWORD=password
     ```

3. **Génération de la clé d'application Laravel :**
   Exécutez la commande suivante pour générer la clé d'application Laravel :

   ```bash
   php artisan key:generate
   ```

4. **Exécution des migrations et des seeders :**
   Pour créer les tables de base de données et ajouter des données de test, utilisez les commandes suivantes :

   ```bash
   php artisan migrate
   php artisan db:seed
   ```

5. **Lancement du serveur :**
   Enfin, lancez le serveur Laravel avec la commande :

   ```bash
   php artisan serve
   ```

   Cela devrait démarrer le serveur de développement, et vous devriez pouvoir accéder à votre application à l'adresse [http://127.0.0.1:8000](http://127.0.0.1:8000) dans votre navigateur.

Assurez-vous que votre serveur Neo4j est opérationnel et que les informations de connexion dans le fichier `.env` sont correctes. Si vous rencontrez des problèmes, assurez-vous de vérifier les journaux d'erreurs pour des messages spécifiques.
