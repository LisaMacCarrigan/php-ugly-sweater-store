# php-ugly-sweater-store

#### An application that lists out specialty sweater stores and the brands of ugly sweaters that they carry. 11.23.2016

#### By [Lisa MacCarrigan](https://github.com/lisamaccarrigan)

![screenshot of project main page](web-app.png)

## Description

This is a web application that lists out specialty sweater stores and the brands of ugly sweaters that they carry. This application demonstrates CRUD functionality and a many-to-many relationship between brands and sweater stores.

## Specifications:
| _Behavior_ | _Input_ | _Output_ |
|:---------------------------------------------------------------------:|:---------------------------------------------------------------------------:|:-------------------------------------------------------------------------------------------------------------------:|
| Add/Save New Store | Enter Name: Sweatz Boutique | Stores: Sweatz Boutique |
| Get/View All Stores | n/a | list of stores |
| Delete All Stores | select 'Delete All' | There are currently no stores |
| Update/Edit Store | Sweatz Boutique | Sweatz Boutique |
| Delete Store | select 'Delete' | There are currently no stores |
| View All Brands For Given Store | select Stores: Sweatz Boutique | Brands: Satirical Sweaters Co. |
| Add/Save New Brand | Enter Name: Satirical Sweaters Co. | Brands: Satirical Sweaters Co. |
| Get/View All Brands | n/a | list of brands |
| Delete All Brands | select 'Delete All' | There are currently no brands |
| Update/Edit Brand | Satirical Sweaters Company | Satirical Sweaters Company |

## Setup/Installation Requirements

If editing:
* Clone this repository: https://github.com/LisaMacCarrigan/php-ugly-sweater-store.git
* OPEN project folder ('php-ugly-sweater-store') in Code Editor of choice

SQL Commands:
* 

Install and Configure PHP development environment - Please visit http://goo.gl/JDBJ0p for easy-to-follow instructions by Epicodus. In general, you will need to:
* Download and Install 'MAMP' by visiting: https://www.mamp.info/en/downloads/.
* Download and Install PHP package manager called 'Composer'
* Inside of Terminal window, from the top level of your project folder, RUN the install command: > composer install
* Inside of Terminal window, within the project's "web" folder, RUN the command: > php -S localhost:8000. Then, in a web browser, visit: http://localhost:8000/

## Known Bugs

No known bugs.

## Support and contact details

For comments or questions, please email Lisa.MacCarrigan@gmail.com

## Technologies Used

* HTML
* PHP
* MAMP Version 3.5.2
* MySQL Server
* phpMyAdmin Version 4.4.10
* Silex (PHP micro-framework)
* Twig (PHP template engine)
* Bootstrap CDN

### License

*This application is licensed under the MIT license*

Copyright (c) 2016 [Lisa MacCarrigan](https://github.com/lisamaccarrigan)
