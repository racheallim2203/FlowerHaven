# Flower Haven Online Florist Website Project

## Introduction

Welcome to the Flower Haven Online Florist Website Project repository. This document serves as a guide to help you navigate the project structure, understand the codebase, and adhere to the project's coding standards and conventions.

This project was developed using the [CakePHP 5.x](https://cakephp.org) framework.

The framework source code can be found here: [cakephp/cakephp](https://github.com/cakephp/cakephp).

## Cloning the Repository

To get a full clone of this repository, including all history commits, run the following command:

```bash
git clone --mirror https://git.infotech.monash.edu/UGIE/ugie-2024/team036/team036-app_fit3047.git
```

## Repository Structure
Here’s an overview of the main directories and files in this CakePHP project:

```bash
team036-app-fit3047/
│
├── config/                         # Configuration files
│   ├── Migrations/                 # Migration files
│   ├── Seeds/                      # Seeded files
│   ├── app.php                     # Application configuration
│   ├── bootstrap.php               # Bootstrap file
│   ├── plugins.php                 # Plugins configuration
│   ├── routes.php                  # Routes configuration
│   └── ...                         # Other configuration files
│
├── FLOWERHAVENDATABASE/ 
│   └── flowerhaven_team36.sql      # SQL Database
│
├── plugins/                        # Plugins
│
├── src/                            # Source files
│   ├── Controller/                 # Controllers
│   ├── Model/                      # Models
│   ├── View/                       # Views
│   ├── Application.php             # Application setup file
│   └── ...                         # Other source files
│
├── templates/                      # Template files
│
├── tests/                          # Test cases
│
├── webroot/                        # Webroot files
│   ├── css/                        # CSS files
│   ├── font/                       # Font files
│   ├── img/                        # Image files
│   ├── js/                         # JavaScript files
│   └── ...                         # Other webroot files
│
├── .gitignore                      # Git ignore file
├── composer.json                   # Composer configuration
└── README.md                       # This README file
```

## Installation

1. Download [Composer](https://getcomposer.org/doc/00-intro.md) or update `composer self-update`.
2. Run `php composer.phar create-project --prefer-dist cakephp/app [app_name]`.

If Composer is installed globally, run

```bash
composer create-project --prefer-dist cakephp/app
```

In case you want to use a custom app dir name (e.g. `/myapp/`):

```bash
composer create-project --prefer-dist cakephp/app myapp
```

You can now either use your machine's webserver to view the default home page, or start
up the built-in webserver with:

```bash
bin/cake server -p 8765
```

Then visit `http://localhost:8765` to see the welcome page.

## Update

### Install Authentication plugin via composer

> **Note:** [This is the official CakePHP documentation on Authentication](https://book.cakephp.org/authentication/3/en/index.html).
> It is strongly recommended you read through that documentation if you face any issues.
> It will provide additional insights from the official CakePHP folk.

Install this plugin into your CakePHP application using [composer](https://getcomposer.org).

```
composer require "cakephp/authentication"
```

### Install Content Blocks plugin via composer

Install this plugin into your CakePHP application using [composer](https://getcomposer.org).

```
composer require ugie-cake/cakephp-content-blocks
```

#### Load the plugin

Using the `cake` CLI:

```php
bin/cake plugin load ContentBlocks
```

#### Create the `content_blocks` table in your database
>**Note:** [This is the official CakePHP quick start guide on CMS](https://book.cakephp.org/5/en/quickstart.html).

> **Note:** This must be done for each environment you deploy your website to (localhost, dev, prod, etc).
> It also requires you to have setup your `app.php` or `app_local.php` file with an appropriate `Datasources` block to connect to the database.

```
bin/cake migrations migrate
bin/cake migrations migrate --plugin=ContentBlocks
```

#### Insert defined content blocks into database

Once you have defined your content blocks in a seed (see above), then you can run the "Seed" to create the records in the database:

```
# Replace 'ContentBlocksSeed' with the name of your seed class from the previous step.
bin/cake migrations seed --seed ContentBlocksSeed
```


## Configuration

Read and edit the environment specific `config/app_local.php` and set up the
`'Datasources'` and any other configuration relevant for your application.
Other environment agnostic settings can be changed in `config/app.php`.

## Layout

The app skeleton uses [Milligram](https://milligram.io/) (v1.3) minimalist CSS
framework by default. You can, however, replace it with any other library or
custom styles.
