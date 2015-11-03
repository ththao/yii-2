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



WORKING WITH GRUNT
------------------

1. Install [NodeJS](http://nodejs.org/)
2. After installing NodeJS, type `npm install -g grunt-cli` and `npm install grunt --save-dev` and `npm install` on the project root folder
3. type `grunt watch` to watch the LESS and JS.

Every time you change a LESS or a JS, the grunt compiler will automatically create a compiled version mentioned in gruntfile.js
To adjust the compiled version, modify the `gruntfile.js` accordingly to your project