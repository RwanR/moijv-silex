<?php

use Silex\Application;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\SecurityServiceProvider;

$app = new Application();
$app->register(new ServiceControllerServiceProvider());
$app->register(new AssetServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());

$app->register(new SessionServiceProvider());
$app->register(new SecurityServiceProvider(), array(
    'security.firewalls' => [   
        'front' => array(
        'pattern' => '^/',
        'http' => true,
        'anonymous' => true,
        'users' => array(
            // raw password is foo
            'admin' => array('ROLE_ADMIN', '$2y$10$3i9/lVd8UOFIJ6PAMFt8gu3/r5g0qeCJvoSlLCsvMTythye19F77a'),
            ),
        ),
    ]
));
$app['twig'] = $app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...

    return $twig;
});
$app['users.dao'] = function($app){
    return new \DAO\UserDAO($app['pdo']);
};
$app['game.dao'] = function($app){
    return new \DAO\GameDAO($app['pdo']);
};
$app['category.dao'] = function($app){
    return new \DAO\CategoryDAO($app['pdo']);
};
$app['loaning.dao'] = function($app){
    return new \DAO\LoaningDAO($app['pdo']);
};

$app['pdo'] = function($app){
    $options = $app['pdo.options'];
    return new \PDO("{$options['sgbdr']}:host={$options['host']};dbname={$options['dbname']};charset={$options['charset']}",
            $options['username'],
            $options['password'],
            [\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION           
            ]);       
};
return $app;
