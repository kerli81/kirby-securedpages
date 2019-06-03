
# Kirby Secured Pages

![Version](https://img.shields.io/badge/Version-1.1.0-blue.svg) ![License](https://img.shields.io/badge/License-MIT-green.svg) ![Kirby](https://img.shields.io/badge/Kirby-3.x-f0c674.svg)

With this plugin for [Kirby CMS](http://getkirby.com) you can prevent unauthorized users to access a page or a hierarchy of pages. The permission will be granted by a user group. If the user is not yet logged in, a login page will be displayed.

## Requirements

+ Kirby CMS, Version **3.x**

****

# Installation

## Download

Download and extract this repository, rename the folder to `securedpages` and drop it into the plugins folder of your Kirby 3 installation. You should end up with a folder structure like this:

```cmd
site/plugins/securedpages/
```

## Composer

If you are using Composer, you can install the plugin with

```cmd
composer require kerli81/securedpages
```

## Git submodule

```cmd
git submodule add https://github.com/kerli81/kerby-securedpages.git site/plugins/securedpages
```


****

# Usage

## Blueprint
To enable the configuration for the page security your blueprint needs to include the security field. Here an example ho such a page blueprint could look like.

```yml
title: Protected Page

columns:
  # main
  - width: 2/3
    sections:
      content:
        type: fields
        fields:
          text:
            text:
            type: textarea
            size: large
            
  # sidebar
  - width: 1/3
    sections:
        securityconfig:
            type: fields
            fields:
                security: fields/kerli81.securedpages.pageconfiguration
        pages:
            type: pages
        files:
            type: files
```
![Template](/.github/template.png?raw=true "Template")

## User Group
The plugin will check if a user is part of a certain user group. To create such a group, create a *.yml file in folder ```blueprints/users/```. You will find below an example of a group definition. 

```yml
title: Webpage Access
description: Usergroup for frontend access

permissions:
  access:
    panel: false
```

To use the group create a new user on the panel. 

## Secure a page incl. sub pages
Go to the page which you will protected and enable the protection. After you enabled it a user group selction field will be displayed. Select the just defined group.

![Protection Configuration](/.github/security_area.png?raw=true "Protection Configuration")

## Options

### Default Behavior
If you navigate to a page which is protected and you are not logged in or your user is not part of the correct user group, your request is forwarded to ```/no-permission```. On this page a login form will be displayed. After correct login you will be forward to your requested page.

### Adjust texts of default behavior
to adjust the texts just override the provided options:

Option | Default | Description
------ | ------- | -----------
kerli81.securedpages.loginform.username.name | Username | Name of the field 'username'
kerli81.securedpages.loginform.username.error | Please enter your username | Error message for the field 'username'
kerli81.securedpages.loginform.password.name | Password | Name of the field 'password'
kerli81.securedpages.loginform.password.error | Please enter your password| Error message for the field 'password'

![Login Form](/.github/loginform.png?raw=true "Login Form")

### display another error page

If you would like to show your custom error page, just update following options:

Option | Value | Description
------ | ------- | -----------
kerli81.securedpages.logintype | custom | Will trigger the page to display. Possible values are: [loginform, custom]
kerli81.securedpages.custom.page | --- | The url (url-slug) to navigate to.