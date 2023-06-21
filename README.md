# Online Ordering Web Application for APO Bangpo Merch PH

This web application allows users to order products from APO Bangpo Merch PH online. It utilizes a data mining technique called K-means to provide personalized recommendations to users.

## Features

- User registration and authentication
- Product catalog with search functionality
- Shopping cart and order management
- Recommendation system based on K-means clustering
- Payment integration
- Admin dashboard for product and user management

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/IanMerico/Capstone.git
   
2. Install the dependencies:
   
  npm install

3. Configure the database connection in config.js.
4. Start the application:
   npm start

# Usage
1. Navigate to the project's directory.
2. Run the application:
   npm start
3. Open a web browser and visit http://localhost:3000.

#Contributing
Contributions are welcome! If you find any issues or have suggestions, please feel free to open an issue or submit a pull request.

#License
This project is owned under the BSIS Group 4.

#Acknowledgements

- Thanks to APO Bangpo Merch PH for providing the dataset and inspiration for this project.
- Special thanks to the contributors of LibraryX for their guidance and support.

## XAMPP Configuration

To run this project locally, you'll need to set up XAMPP and configure it accordingly. Follow the steps below to get started:

### Step 1: Download and Install XAMPP

1. Visit the [XAMPP website](https://www.apachefriends.org/index.html) and download the appropriate version for your operating system.
2. Run the installer and follow the installation instructions.

### Step 2: Start Apache and MySQL Servers

1. Open XAMPP Control Panel.
2. Click the "Start" button next to Apache to start the Apache server.
3. Click the "Start" button next to MySQL to start the MySQL server.

### Step 3: Import the Database

1. Open a web browser and visit `http://localhost/phpmyadmin`.
2. Click on "New" in the left sidebar to create a new database.
3. Enter a name for the database and click "Create."
4. Select the newly created database from the left sidebar.
5. Click on the "Import" tab at the top.
6. Choose the SQL file for the database, which is typically provided with the project.
7. Click "Go" to import the database structure and data.

### Step 4: Configure Database Connection

In your project directory, locate the file responsible for configuring the database connection (e.g., `config.php` or `database.js`). Update the following settings with your XAMPP configuration:

```php
$db_host = 'localhost:';
$db_user = 'root';
$db_pass = '';
$db_name = 'ecommerce_db';

Make sure the values for $db_user, $db_pass, and $db_name match your XAMPP setup.

#Step 5: Run the Application
1. Start XAMPP and make sure Apache and MySQL servers are running.
2. Open a web browser and visit http://localhost/your_project_folder to access your project.


