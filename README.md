# SaveurDuMaroc

 Creation of an application that stores and retrieves data from Neo4j using PHP Laravel.
To launch a Laravel application with Neo4j, follow these steps:

1. **Install Dependencies :**
  Make sure you have Composer and Node.js installed on your machine. Then, open a console and navigate to your Laravel project directory. Execute the following commands to install dependencies
   ```bash
   composer install
   npm install
   ```

2. **Configure Neo4j Database:**
   - Ensure Neo4j is installed and running on your machine.
   - Configure your .env file with the Neo4j connection information you provided, such as:
     ```env
     DB_CONNECTION=neo4j
     NEO4J_CONNECTION=bolt
     NEO4J_HOST=localhost
     NEO4J_PORT=7687
     NEO4J_USERNAME=recette
     NEO4J_PASSWORD=password
     ```

3. **Generate Laravel Application Key:**
Execute the following command to generate the Laravel application key:

   ```bash
   php artisan key:generate
   ```

5. **Run Migrations and Seeders:**
   To create the database tables and add test data, use the following commands:


   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Start the Server:**
  Finally, launch the Laravel server with the command:

   ```bash
   php artisan serve
   ```

   This should start the development server, and you should be able to access your application at http://127.0.0.1:8000 in your browser.

Ensure your Neo4j server is operational, and the connection information in the .env file is correct. If you encounter issues, be sure to check the error logs for specific messages.
