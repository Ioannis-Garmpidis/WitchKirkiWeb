# WitchKirkiWeb
“A PHP e-commerce website with user authentication, shopping cart, and order processing using MySQL database.
WitchKirkiWeb – A Toy E-shop for All Ages 🧸
WitchKirkiWeb is a dynamic PHP-based e-commerce application that allows users and guests to browse, select, and purchase toys categorized by age groups. It simulates a complete online shopping experience with cart functionality and session handling.

🛒 Features
	•	User registration and login with session support
	•	Guest access with ability to place orders
	•	Dynamic homepage with category-based product display
	•	Add-to-cart functionality for both guests and users
	•	Persistent cart using PHP sessions
	•	Order processing with form validation
	•	Confirmation message upon successful purchase
	•	Full navigation system with next/previous category pages
	•	Popup-based login prompts
	•	Responsive UI with category images and custom CSS
 
🗂️ File Structure
	•	/php/ – Core PHP files (index, login, signup, cart, order forms, etc.)
	•	/css/ – Central CSS file for consistent styling
	•	/media/ – Image files for products, logos, and icons
	•	WitchKirkiWeb.sql – MySQL dump of the e-shop database

 sistent styling
	•	/media/ – Image files for products, logos, and icons
	•	WitchKirkiWeb.sql – MySQL dump of the e-shop database
	•	README.md – Description and setup instructions

💾 Database

The project uses a MySQL database with the following tables:
	•	users – Registered user info
	•	products – Product data (title, price, image, category)
	•	orders – Guest/user orders with full cart summary
	•	Cart is session-based and not stored for guests

🛠️ Setup Instructions
	1.	Import WitchKirkiWeb.sql into phpMyAdmin.
	2.	Edit db_connection.php to match your database credentials.
	3.	Launch the project via XAMPP at:
http://localhost/WitchKirkiWeb/php/index.php

🔐 Note

The CVV input is required for order submission, but it is not stored in the database, respecting basic data protection principles.

