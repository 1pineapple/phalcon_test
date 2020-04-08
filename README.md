# Test Application

[Phalcon][1] is a web framework delivered as a C extension providing high
performance and lower resource consumption.

This is a sample application for the Phalcon PHP Framework. We expect to
implement as many features as possible to showcase the framework and its
potential.

Please write us if you have any feedback.

Thanks.

## NOTE

This application was created for test task.
Purpose: creating an MVC application in phalcon for viewing and editing users.

Database: Mysql / Postgresql
PHP Version: 7.2.x / 7.3.x
Phalcon Version: 4.x
JQuery Version: 3+
You can use Bootstrap CSS 3+

The application must have cli for initial deployment (creating a database, creating users)
The application must have:
1. Authorization Page
2. Page with the list of users in the database
3. User add / edit page, with the ability to specify the access level: Add / Edit, View list, Delete (can be selected in any combination)
4. In case of insufficient rights, issue a message
5. Ability to change user
6. Data, form and list must be transferred using AJAX
7. Session data storage to choose from

## Get Started

### Requirements

* PHP >= 7.2
* [Apache][2] Web Server with [mod_rewrite][3] enabled or [Nginx][4] Web Server
* Latest stable [Phalcon Framework release][5] extension enabled
* [MySQL][6] >= 5.5

### Installation

1. Copy project to local environment - `git clone `
2. Copy file `cp .env.example .env`
3. Edit .env file with your DB connection information
4. Run command for initialization project `init`
5. For create user `php run create user --login=test_user --password=plain_password --roles=create,update,list,delete`
