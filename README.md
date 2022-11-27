# Product App 🚀

### Introduction
Product App is a simple REST API endpoint that returns a list of products, applies discounts appropriately and products can be filtered.

### Table of Contents 📖
1. <a href="#technology-stack">Technology Stack</a>
2. <a href="#application-features">Application Features</a>
3. <a href="#api-endpoints">API Endpoints</a>
4. <a href="#setup">Setup</a>
5. <a href="#testing">Testing</a>
6. <a href="#author">Author</a>
7. <a href="#license">License</a>


### Technology Stack & Tools 🧰
  - [PHP](https://www.php.net/)
  - [Laravel](https://laravel.com/)
  - SQLite
  - [Git](https://git-scm.com/) 
  - [Composer](https://getcomposer.org/) 

### Application Features 📑
* User can fetch all products
* User can filter products by category and price less than

### API Endpoints 📬
Method | Route | Description
--- | --- | ---
`GET` | `/api/products` | Fetch all products

##### Query Params 🔎
Method | Description
--- | ---
`q` | Filter product by category
`limit` | Number of records to return per page. Default is set to 5
`priceLessThan` | Filter product by prices less than or equal to value

### Setup 👨🏾‍💻
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

  #### Dependencies
  - [Git](https://git-scm.com/) 
  - [Composer](https://getcomposer.org/)  
  - [Laravel](https://laravel.com/)
  #### Getting Started
  - Install and setup laravel
  - Open terminal and run the following commands
    ```
    $ git clone https://github.com/steelze/mytheresa.git
    $ cd mythersa
    $ composer install
    $ cp .env.example .env
    $ php artisan key:generate
    ```
  - Run Migration
    ```
    $ php artisan migrate --seed
    ```
    **NB**: Enter **YES** if you get this prompt when running the command for the first time. *"The SQLite database does not exist: database/database.sqlite. Would you like to create it?"*
    ...

  - Start Application
    ```
    $ php artisan serve
    ```
  - Visit http://localhost:8000/api/products on your browser or Postman

### Testing 🧪
  ```
  $ php artisan test
  ```
  If correctly setup, all tests should pass
  
### Author ✍🏾
Odunayo Ileri Ogungbure

### License 
MIT
