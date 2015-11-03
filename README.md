Yii 2 Advanced Application Template
===================================

The template includes three tiers: front end, back end, and console, each of which
is a separate Yii application.

The template is designed to work in a team development environment. It supports
deploying the application in different environments.


DIRECTORY STRUCTURE
-------------------

```
common
	config/				contains shared configurations
	mail/				contains view files for e-mails
	models/				contains model classes used in both backend and frontend
	tests/				contains various tests for objects that are common among applications
console
	config/				contains console configurations
	controllers/		contains console controllers (commands)
	migrations/			contains database migrations
	models/				contains console-specific model classes
	runtime/			contains files generated during runtime
	tests/				contains various tests for the console application
backend
	assets/				contains application assets such as JavaScript and CSS
	components          contains components files
	config/				contains backend configurations
	controllers/		contains Web controller classes
	models/				contains backend-specific model classes
	runtime/			contains files generated during runtime
	tests/				contains various tests for the backend application
	views/				contains view files for the Web application
frontend
	assets/				contains application assets such as JavaScript and CSS
	components          contains components files
	config/				contains frontend configurations
	controllers/		contains Web controller classes
	models/				contains frontend-specific model classes
	runtime/			contains files generated during runtime
	tests/				contains various tests for the frontend application
	views/				contains view files for the Web application
api
    components          contains components files
    config              contains api configurations
    controllers         contains REST controller classes
    help                contains swagger api help
    models              contains api-specific model classes
    runtime             contains files generated during runtime
vendor/					contains dependent 3rd-party packages
web                     contains the entry script and Web resources
environments/			contains environment-based overrides
```

INSTALLATION USING VAGRANT
--------------------------

Vagrant is a virtual machine management program. It works in conjunction with a VM program
(most commonly VirtualBox but also VMWare and others) to make hosting
a VM easier.

1. Clone the application.
2. Download and Install [Vagrant](https://www.vagrantup.com/) and [VirtualBox](https://www.virtualbox.org/wiki/Downloads)
3. After installing vagrant, type `vagrant plugin install vagrant-hostsupdater` and `vagrant up` on the project root folder
4. The very first time you run this Vagrant box, it will need to download an ubuntu image which may take 10 minutes or so. This only happens once even if you destroy the vagrant box later.
5. The boot process will prompt for your OS password to make changes to /etc/hosts
6. Once the VM is up, you can use the following URLs:

   - frontend.local (frontend url)
   - backend.local (backend url)
   - api.local (api url)

The VM works by keeping your whole repo folder in sync with the guest Linux box. This means you work like you always do, use your IDE
to write code in your native operating system, and any changes are kept in sync with the server VM. There is no manual uploading or
transferring and you shouldn't need to do anything directly with the VM. Just make your code changes, save, and then use your browser
to see the results. There's nothing else.

If you need to connect to the machine for any reason, you can use the command: `vagrant ssh`
This will ssh you into the virtual box, so you're on the Linux machine.

MANUAL INSTALLATION
-------------------
1. Clone the application
2. Download [Composer](https://getcomposer.org/)
3. Open your command line and type
   - sudo composer global require "fxp/composer-asset-plugin:1.0.3"
   - sudo composer install
4. Configure your database and environment paths in `environment/local/common/config`
5. type `sudo ./init --env=Localhost --overwrite=All`
6. type `sudo ./yii migrate --interactive=0`

ADJUSTING PROJECT CONFIGURATION
-------------------------------

1 Adjusting the application endpoint

  - By default the frontend, backend and api is pointing to frontend.local, backend.local and api.local.
    To adjust them you need to modify the `puphpet/config.yaml` and type `vagrant reload` or `vagrant provision` to reload the puphpet configuration

    also adjust the `Vagrantfile` `config.hostsupdater.aliases` according to your application

2. The vagrant has already built-in LAMP stack. in order to access the database, access it via your preferred MySQL GUI Tools or access it via browser http://192.168.57.101/adminer

3. The default login for administrator credentials is `admin/nimda123`, you may want to adjust the credentials in
`console/migrations/m130524_201442_init.php`

WORKING WITH GRUNT
------------------

If you do `vagrant` as a project setup, just simply do this following

1. type `vagrant ssh` to access the VM machine
2. go to the project folder by typing `cd /var/www/html`
3. type `grunt watch` to watch the LESS and JS

If you do `manual installation` as a project setup, do the following

1. Install [NodeJS](http://nodejs.org/)
2. After installing NodeJS, type `npm install -g grunt-cli` and `npm install grunt --save-dev` and `npm install` on the project root folder
3. type `grunt watch` to watch the LESS and JS.

Every time you change a LESS or a JS, the grunt compiler will automatically create a compiled version mentioned in gruntfile.js
To adjust the compiled version, modify the `gruntfile.js` accordingly to your project