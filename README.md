# USERWERK Shopify Popup Plugin

### Requirements

- PHP 8.1 version
- Composer version from 1.10.1
- Docker and Docker Compose
- Ngrok

## Automatic installation

### 1. Retrieving project files

You need to clone this repository - "git clone https://github.com/valery-yazykov-innowise/Shopify-plugin.git" and switch to the desired branch "git checkout server-test".

### 2. Running the script for quick setup

"sudo sh project-setup.sh" - runs the installation and autofills the data in the .env.

- SHOPIFY_API_KEY = Partners Shopify -> Apps -> Your App -> Overview -> Client ID.
- SHOPIFY_API_SECRET = Partners Shopify -> Apps -> Your App -> Overview -> Client Secret.
- SHOPIFY_APP_HOST_NAME = Ngrok -> Forwarding -> First Value.
- STORE_NAME = Shopify Admin -> Settings.

### 3. Adding data to Shopify Partners settings

When the installation is complete, transfer the data from the command line to the App setup.

```
App URL = https://40-31v1-148-2509.eu.ngrok.io
Allowed Redirection URL(s) = https://40-31v1-148-2509.eu.ngrok.io/hookcallback.php
                             https://40-31v1-148-2509.eu.ngrok.io/authcallback.php
```

- App URL = Ngrok -> Forwarding -> First Value.
- Allowed Redirection URL(s) = Ngrok -> Forwarding -> First Value /hookcallback.php and Ngrok -> Forwarding -> First Value /authcallback.php.

## Manual installation

### 1 . Obtaining access to customer information

Plugin works out of the box with Shopify.checkout object. But if you want to use webhooks also, go to partners.shopify.com, then App setup -> Protected customer data access and check for have all necessary permissions to receive and process clients personal data.

### 2. Preparing the environment to start a project
Go to the folder where docker-compose.yml stores and run "docker-compose up", then go inside www/ and run "composer install". After that all dependencies will be created.

Next you need to run ngrok - "ngrok http 8080".

You need to change the .env.example file. To change the name, run the command - "mv .env.example .env" and open this file "sudo nano .env".

Environment Example:
```dotenv
SHOPIFY_API_KEY=211kn41j5as8f12hnb5j12b5h14v
SHOPIFY_API_SECRET=j1g41jf78as7n81mnca87f5an2
SHOPIFY_APP_SCOPES=write_script_tags,read_script_tags
SHOPIFY_APP_HOST_NAME=https://40-31v1-148-2509.eu.ngrok.io
STORE_NAME=https://test.myshopify.com
API_VERSION=2023-01
FILE_NAME=shopify-token.txt
```

You need to change 4 values: SHOPIFY_API_KEY, SHOPIFY_API_SECRET, SHOPIFY_APP_HOST_NAME, STORE_NAME.

- SHOPIFY_API_KEY = Partners Shopify -> Apps -> Your App -> Overview -> Client ID.
- SHOPIFY_API_SECRET = Partners Shopify -> Apps -> Your App -> Overview -> Client Secret. 
- SHOPIFY_APP_HOST_NAME = Ngrok -> Forwarding -> First Value.
- STORE_NAME = Shopify Admin -> Settings.

Save this file and exit - "ctrl + o" + "ctrl + z".

Next you need to go to the docker container - "docker exec -it php-apache bash".
After these steps, enter this command and give permission to modify files - "chown -R www-data:www-data /var/www/".
Then write "exit" and exit from container.

### 3. Changing fields in Shopify Partners app settings

After these steps, you need to fill in the required fields in App Setup (Shopify Partners). To do this, go to your app settings (Shopify Partners -> Apps -> Your App -> App Setup -> URLs).

Example fields in App Setup:

```
App URL = https://40-31v1-148-2509.eu.ngrok.io
Allowed Redirection URL(s) = https://40-31v1-148-2509.eu.ngrok.io/hookcallback.php
                             https://40-31v1-148-2509.eu.ngrok.io/authcallback.php
```

- App URL = Ngrok -> Forwarding -> First Value.
- Allowed Redirection URL(s) = Ngrok -> Forwarding -> First Value /hookcallback.php and Ngrok -> Forwarding -> First Value /authcallback.php.


After host your plugin or run ngrok don't forget change URLs.

Then connect with store owner to grant you access for the store. Then chose this store inside plugin Overview page Select store btn. Click install and go through installation process.

## Plugin admin panel on the store

After installation is complete you will be redirected to admin panel where you can switch on/off popup window on thank-you page or setting up plugins domain address. Note that shopify-token.txt will be also created, this file keeps store data so keep it in .gitignore and don't provide its content to the third party.
```
for "chocoala.staging.userwerk.com/uw.js"  

Domain will be "chocoala"
```
Default value of domain - "chocoala", of popup visibility - true


## References

Plugin is made on the basis of Shopify recommended library https://github.com/Shopify/shopify-api-php.
Read its docs for receiving more information. So in case of need use this documentation or contact http://innowise-group.com
