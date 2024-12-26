# E-Commerce Platform Documentation

## Project Overview
This project is a full-featured e-commerce platform named **Lokalaku**. It includes functionalities for both users and administrators, allowing for product management, order processing, and user account management.

## Tech Stack
- **Backend:** PHP
- **Database:** MySQL (e-commerce_db)
- **Frontend:** HTML, CSS, JavaScript

## Directory Structure

### Views
- **Admin Panel**
  - `adminProduct.php`: Interface for adding new products.
  - `adminUpdateProduct.php`: Interface for updating existing products.
  - `editProduct.php`: Interface for editing product details.
  - `manageOrder-page.php`: Interface for managing orders.
  
- **User Interface**
  - `cart.php`: Shopping cart interface.
  - `home-page.php`: Main landing page for users.
  - `login-page.php`: User login interface.
  - `register-page.php`: User registration interface.
  - `profile-dashboard.php`: User profile management.
  - `orderstatus-page.php`: View order status.
  - `orderdetails-page.php`: View detailed order information.
  - `product-details.php`: View detailed product information.
  - `thank-you.php`: Post-checkout success page.

### Private
- **Admin Processes**
  - `adminProductProcess.php`: Handles product addition.
  - `adminProductUpdateProcess.php`: Handles product updates.
  - `deleteProductProcess.php`: Handles product deletion.

- **Cart Processes**
  - `cartProcess.php`: Handles adding items to the cart.
  - `cartRegistry.php`: Retrieves cart items.
  - `cartRemoval.php`: Handles removal of items from the cart.
  - `cartInclude.php`: Updates cart status.

- **Order Processes**
  - `checkoutProcess.php`: Handles order checkout.
  - `editOrderProcess.php`: Handles order status updates.
  - `manageOrderProcess.php`: Retrieves order information.
  - `orderDetailProcess.php`: Retrieves detailed order information.
  - `orderStatusProcess.php`: Retrieves order status.

- **User Processes**
  - `loginProcess.php`: Handles user login.
  - `registerProcess.php`: Handles user registration.
  - `profileProcess.php`: Handles profile updates.
  - `reviewProcess.php`: Handles product reviews.

- **Category Management**
  - `categoryRegistry.php`: Retrieves product categories.

### Config
- `openConn.php`: Establishes database connection.
- `closeConn.php`: Closes database connection.
- `sessionInfo.php`: Manages session information.

### Database
- `e-commerce_db.sql`: SQL dump for database structure and initial data.

## Development
- **Collaboration Method:** GitHub
- **Version Control:** Git

## Usage
1. **Setup Database:** Import `e-commerce_db.sql` into your MySQL server.
2. **Configure Database Connection:** Update `openConn.php` with your database credentials.
3. **Run the Application:** Access the application through your local server (e.g., `http://localhost/project/ecommerce/views/home-page.php`).

## License
This project is licensed under the MIT License.

## Contact
For any inquiries or issues, please contact the project maintainer.
