Behat-Laravel
============

Behat-Laravel is a solution test your application BDD methodology. This package create the following folder structure:

Setup:
------

In the ```require``` key of ```composer.json``` file add the following

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
    'GuilhermeGuitte\BehatLaravel\ConfideServiceProvider',

),
```

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

Running tests
-------------

To running test, you can use the follow command:

```
$ php artisan behat:run
```

