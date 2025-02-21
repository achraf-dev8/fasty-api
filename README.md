# Fasty API (Back-End)

## Introduction

The **Fasty API** is the back-end service that powers the entire Fasty food delivery app. It is built using **PHP** and provides the necessary API endpoints to interact with the mobile apps (Admin and Delivery). The API handles user authentication, order management, menu management, notifications, payment processing, and more. It communicates with the **MySQL** database and integrates with **Firebase** for real-time notifications and social logins (Google/Facebook).

## Features

- **User Management**: 
  - User registration, login, and authentication.
  - OTP-based verification for phone number/email authentication.
  - Integration with Google and Facebook login through Firebase.

- **Order Management**: 
  - Handle incoming orders from customers.
  - Order status tracking (pending, accepted, rejected, delivered).
  - Update and manage order details.

- **Menu Management**: 
  - Add, edit, delete food items, categories, sizes, toppings, and offers.
  - Link sizes, toppings, and offers to food items.

- **Payment Integration**: 
  - Process payments via cash, PayPal, or credit card (Integration via external services if applicable).

- **Review and Rating System**: 
  - Allow customers to rate and review food items.
  - View and manage customer reviews and ratings.

- **Notifications**: 
  - Send push notifications to users (customers, admins, delivery personnel) using **Firebase**.
  - Notifications for order updates, account creation, etc.

- **Admin and Delivery Management**: 
  - Manage delivery personnel and restaurant staff.
  - Track deliveries, confirm delivery status, and update account information for delivery personnel.

## Technologies Used

- **PHP**: The back-end logic and API endpoints are built using PHP.
- **MySQL**: The database stores user data, orders, menu items, reviews, etc.
- **Firebase**: Used for handling notifications and enabling Google/Facebook login.
- **MVC Architecture**: The project follows the **Model-View-Controller** architecture for better code organization and maintainability.
- **Composer**: PHP dependencies are managed using **Composer** for package installation.

## How to Set Up the Project

1. **Download the project**:
   - Clone or download the Fasty API project repository to your local machine.

2. **Set up the Database**:
   - Create a new **MySQL** database and import the provided database file in the project.

3. **Install PHP Dependencies**:
   - Run `composer install` to install the required PHP libraries and dependencies.

4. **Configure Firebase**:
   - Register for **Firebase** and set up a new project.
   - Obtain the **Firebase keys** and add them to the project configuration for notifications and authentication.

5. **Configure API Endpoints**:
   - Set up your server to handle API requests. Ensure that the server is running and can accept API calls.

6. **Run the Application**:
   - Once the server and database are set up, start the API service and ensure that the API endpoints are functional.

## API Endpoints

The **Fasty API** exposes a series of RESTful endpoints to interact with the mobile apps. Examples of these endpoints include:

- **POST /api/register**: User registration endpoint.
- **POST /api/login**: User login endpoint (supports OTP, Google, and Facebook login).
- **POST /api/order**: Create a new order.
- **POST /api/menu**: Add a new menu item.
- **POST /api/review**: Submit a review for a food item.

Refer to the documentation for more detailed API endpoints and request/response structures.

## Notes

- This project is still under development, and we welcome any improvements or suggestions.
- Ensure that your server is configured securely, especially for handling sensitive data such as user information and payment transactions.

## Contact Us

If you have any questions or suggestions, feel free to reach out to us via:

- Email: laifaachraf08@gmail.com
