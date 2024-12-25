# E-Commerce Website Documentation

## Project Overview
A full-featured e-commerce platform with user and admin functionalities.

## Tech Stack
- **Backend:** PHP
- **Database:** MySQL (e-commerce_db)
- **Frontend:** HTML, CSS, JavaScript

## Color Theme
<img src="./public/styles/color-themes.png" alt="Color Theme Palette" width="500"/>

| Color | Hex | RGB |
|-------|-----|-----|
| Primary Dark Grey Blue | #2C3E50 | rgb(44,62,80) |
| Primary Light Blue | #3498DB | rgb(52,152,219) |
| Bright red | #E74C3C | rgb(231, 76, 60) |
| White | #FFFFFF | rgb(255, 255, 255) |

## File Structure

### Authentication
- `login-page.php` - User/admin login interface
- `loginProcess.php` - Email and password verification
- `register-page.php` - New account registration interface
- `registerProcess.php` - Account creation handler
- `logoutProcess.php` - Session termination handler

### User Interface
- `home-page.php` - Main product listing page
- `homeProcess.php` - Product loading handler
- `product-details.php` - Individual product view
- `profile-dashboard.php` - User/admin profile management
- `profileProcess.php` - Profile data handler

### Shopping Cart
- `cart.php` - Shopping cart interface
- `cartProcess.php` - Cart item addition handler
- `cartRegistry.php` - Cart items display handler
- `cartRemoval.php` - Cart item deletion handler
- `cartInclude.php` - Checkout logic handler
- `thank-you.php` - Post-checkout success page

### Admin Panel
- `adminProduct.php` - Product management interface
- `adminUpdateProduct.php` - Product update management interface
- `adminProductProcess.php` - Product database operations
- `adminProductUpdateProcess.php` - Product database operations backend 
- `deleteProduct.php` - Product removal interface
- `deleteProductProcess.php` - Product deletion handler
- `productRegistry.php` - Product listing in admin panel

## Database
The application uses MySQL database named `e-commerce_db`

## Development
- **Collaboration Method:** GitHub
- **Version Control:** Git

http://localhost/project/ecommerce/views/login-page.php