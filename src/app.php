<?php

use Silex\Application;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\SecurityServiceProvider;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\ValidatorServiceProvider;

$app = new Application();
$app->register(new ServiceControllerServiceProvider());
$app->register(new AssetServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());
$app->register(new Silex\Provider\LocaleServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'locale_fallbacks' => array('fr'),
    'translator.domains' => [
        'messages' => [
            'fr' => [
                'The credentials were changed from another session.' => 'Les identifiants ont été changés dans une autre session.',
                'The presented password cannot be empty.' => 'Le mot de passe ne peut pas être vide.',
                'The presented password is invalid.' => 'Le mot de passe entré est invalide.',
                'Bad credentials.' => 'Les identifiants sont incorrects'
            ]
        ]
    ]
));

$app->register(new SessionServiceProvider());
$app->register(new SecurityServiceProvider(), array(
    'security.firewalls' => [
        'front' => array(
            'pattern' => '^/',
            'http' => true,
            'anonymous' => true,
            'form' => array('login_path' => '/login', 'check_path' => '/login_check'),
            'logout' => array('logout_path' => '/logout', 'invalidate_session' => true),
            'users' => function() use ($app) {
                return $app['users.dao'];
            }
        ),
        'admin' => array(
            'pattern' => '^/admin/',
            'http' => true,
            'form' => array('login_path' => '/login', 'check_path' => '/admin/login_check'),
            'users' => function() use ($app) {
                return $app['admins.dao'];
            }
        ),
    ]
));
        
$app->register(new FormServiceProvider());
$app->register(new ValidatorServiceProvider());

$app['twig'] = $app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...

    return $twig;
});
$app['users.dao'] = function($app) {
    return new \DAO\UserDAO($app['pdo']);
};
$app['game.dao'] = function($app) {
    return new \DAO\GameDAO($app['pdo']);
};
$app['category.dao'] = function($app) {
    return new \DAO\CategoryDAO($app['pdo']);
};
$app['loaning.dao'] = function($app) {
    return new \DAO\LoaningDAO($app['pdo']);
};

$app['pdo'] = function($app) {
    $options = $app['pdo.options'];
    return new \PDO("{$options['sgbdr']}:host={$options['host']};dbname={$options['dbname']};charset={$options['charset']}", $options['username'], $options['password'], [\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
    ]);
};
return $app;
