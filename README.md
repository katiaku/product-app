# Description

This is a product management app built using PHP, MySQL, ReactJS, and SASS.

# Features

Product List Page: This page displays a list of the products that have been added to the system. It also provides an option to mass delete selected products.

Adding a Product Page: This page allows users to add a new product to the system. The user can enter the product SKU, name, price, type and attributes.

# Installation

Before proceeding with the installation, please ensure that you have Node.js and XAMPP installed on your machine.

## Frontend Setup

Clone the repository from Github:
```
git clone https://github.com/your-username/your-repo.git
```

Navigate to the frontend directory:
```
cd src
```

Install the dependencies:
```
npm install react react-dom react-router-dom axios node-sass sass-loader
```

Start the development server:
```
npm start
```

## Backend Setup

Copy the project folder to your XAMPP htdocs directory.

Start the Apache and MySQL servers in XAMPP.

Set the database credentials and other configuration details in dbh.inc.php.

## Running the app

Start the development server for the frontend by running npm start in the frontend directory.

Start the backend API by navigating to http://localhost/product-app/server/api in your browser.

You can use the app by navigating to http://localhost:3000 in your browser.
