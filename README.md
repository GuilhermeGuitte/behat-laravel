# Behat-Laravel

[![ProjectStatus](http://stillmaintained.com/GuilhermeGuitte/behat-laravel.png)](http://stillmaintained.com/GuilhermeGuitte/behat-laravel)

Behat-Laravel is a solution test your application BDD methodology. This package create the following folder structure:

## Features:

*Current:*

* Create the folder structure to for receiving the Acceptance tests.
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
Now generate the Behat's structure folder using the follow artisan's command:

```
$ php artisan behat:install
```

You can pass the test path if you not using the ```app/tests``` which folder`s test.

```
$ php artisan behat:install --test_path==your/test/path
```

Structure
---------

http://docs.behat.org/


Adding Contexts
---------------

When you create a ```context```at folder ```tests\acceptance\contexts``` this files
will be included at ```FeatureContext``` preventing the specification of files
that will used to tests.

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

To running test, you can use the follow command:

```
$ php artisan behat:run
```

License
-------
Behat-Laravel is free software distributed under the terms of the MIT license
