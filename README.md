
## The Cozy Corner Restaurant Website

### Table of Contents

1. [Project Overview](#project-overview)
2. [Dashboard Features](#dashboard-features)
3. [Website Features](#website-features)
4. [Tech Stack](#tech-stack)
5. [Installation](#installation)
6. [Dashboard Usage](#dashboard-usage)
7. [Website Usage](#website-usage)
8. [Screenshots](#screenshots)
9. [Contributing](#contributing)
10. [License](#license)
11. [Contact](#contact)

### ER Diagram

![ERD with colored entities (UML notation)](https://github.com/user-attachments/assets/6e9e8795-2662-4f30-af87-381001d37a93)


### 1. Project Overview

The Cozy Corner is a comprehensive restaurant management system that includes a user-friendly website for customers and a powerful dashboard for administrators. The website allows users to explore the menu, place orders, and make reservations, while the dashboard offers admins tools to manage categories, food items, orders, and users efficiently.

### 2. Features

#### Website
- **Home Page:** Welcomes users with a featured food section and navigation links to different parts of the site.
- **Food Menu:** Displays all available food items with details like price, description, and an option to add items to the order.
- **Categories Page:** Allows users to browse food items by category.
- **Search Functionality:** Enables users to search for specific food items.
- **Order Page:** Displays the current order, allowing users to adjust quantities or remove items.

#### Dashboard
- **Admin Management:** Allows the creation, updating, and deletion of admin users.
- **Category Management:** Enables the management of food categories.
- **Food Management:** Provides tools to add, edit, or remove food items from the menu.
- **Order Management:** Allows admins to view, update, and track the status of customer orders.
- **Statistics Summary:** Displays key metrics and analytics about sales, orders, and customer behavior.
- **User Management:** Allows the management of user accounts, including viewing and updating user details.

### 3. Installation

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/Michael23Magdy/TheCozyCorner_Restaurant_website.git
   cd TheCozyCorner
   ```
   
2. **Set Up the Database:**
   - Import the provided SQL file into your MySQL database to set up the necessary tables.
   - Update the database connection details in the `config/constants.php` file.

3. **Configure the Environment:**
   - Ensure your server is running PHP, MySQL, and a web server like Apache or Nginx.
   - Adjust any environment-specific settings in the configuration files if needed.

4. **Run the Application:**
   - For the website: Access it through your web server using the appropriate URL.
   - For the dashboard: Navigate to the admin login page and enter the provided credentials.
  


### Tech Stack

The project uses the following technologies:

- **Frontend:**
  - **HTML & CSS:** For structuring and styling the web pages, including responsive design and animations.
  - **JavaScript:** For dynamic content updates, form validations, and interactive elements.
  
- **Backend:**
  - **PHP:** Server-side scripting for handling requests, processing data, and managing sessions.
  - **MySQL:** Database management for storing and retrieving data.

- **Tools & Libraries:**
  - **phpMyAdmin:** For managing the MySQL database.
  - **Apache:** Used as the web server (via XAMPP or similar local server environments).
  
- **Version Control:**
  - **Git:** For version control and collaboration.
  - **GitHub:** For repository hosting and project management.


