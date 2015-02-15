# Behat-Laravel

[![ProjectStatus](http://stillmaintained.com/GuilhermeGuitte/behat-laravel.png)](http://stillmaintained.com/GuilhermeGuitte/behat-laravel)

Behat-Laravel is a solution to test your application using the BDD methodology.

## Features:

*Current:*

* Create the folder structure to receive the Acceptance tests.
* Run the acceptance test.
* Ingration with [Zizaco/TestCases-Laravel](https://github.com/Zizaco/testcases-laravel), that provide the useful methods test your application.

## Quick start:

### Required setup

In the ```require``` key of ```composer.json``` file add the following:

```
"guilhermeguitte/behat-laravel": "dev-master"
```


Run the Composer update comand
```
$ composer update
```


In your ```config/app.php``` add ```'GuilhermeGuitte\BehatLaravel\BehatLaravelServiceProvider'``` to the end of the ```$providers``` array

```
'providers' => array(

    'Illuminate\Foundation\Providers\ArtisanServiceProvider',
    'Illuminate\Auth\AuthServiceProvider',
    ...
    'GuilhermeGuitte\BehatLaravel\BehatLaravelServiceProvider',

),
```

Install ```selenium```.

http://docs.seleniumhq.org/download/

Commands
----------------
Now generate Behat's structure folder using the follow artisan's command:

```
$ php artisan behat:install
```

You can pass the test path if you are not using the ```app/tests``` folder.

```
$ php artisan behat:install --test_path==your/test/path
```

Generating Documentation
-----------------------
To create a document in html just run:

```
$ php artisan behat:html # will create a file at application's root
```

or

```
$ php artisan behat:html --out path/you/need/doc.html # will create a file specified path
```

Structure
---------

http://docs.behat.org/


Adding Contexts
---------------

When you create a ```context``` in the folder ```tests\acceptance\contexts``` these files
will be included by ```FeatureContext``` preventing the specification of files
that will be used by the tests.

```
$ php artisan behat:feature --name=NameOfFeature
```

Will create:

```
    app\tests\acceptance\contexts\NameOfFeatureContext.php
    app\tests\acceptance\features\name_of_feature\name_of_feature.feature
```

Running tests
-------------

To run all test, you can use the follow command:

```
$ php artisan behat:run
```

To run tests for specific features, you can specify the name of the folder or the .feature file:

```
$ php artisan behat:run name_of_feature
$ php artisan behat:run name_of_feature/name_of_feature.feature
$ php artisan behat:run name_of_feature/separated_scenarios.feature
```

If you have large feature files and you only want to run a specific senario use

```
$ php artisan behat:run --name="name of feature"
```

Laravel behat currently supports the following behat command line options:

```
 --format (-f)        How to format features. pretty is default.
                      Default formatters are:
                      - pretty: Prints the feature as is.
                      - progress: Prints one character per step.
                      - html: Generates a nice looking HTML report.
                      - junit: Generates a report similar to Ant+JUnit.
                      - failed: Prints list of failed scenarios.
                      - snippets: Prints only snippets for undefined steps.

 --no-snippets        Do not print out snippets
 --profile (-p)       Specify config profile to use.
 --name               Only execute the feature elements which match
                      part of the given name or regex.
```


License
-------
Behat-Laravel is free software distributed under the terms of the MIT license.
