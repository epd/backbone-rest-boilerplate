<?php
/**
 * Setup Slim and Mustache components.
 */
require_once 'rest/Slim.php';
require_once 'rest/MustacheView.php';
$app = new Slim(array(
    'view' => new MustacheView(),
    'templates.path' => __DIR__ . '/app/templates',
));

/**
 * Route definitions.
 */
$app->get('/', function () use($app) {
    $app->render('layout.html', array(
      'app_title' => 'Backbone.js REST Boilerplate',
    ));
});

/**
 * Initialize the application.
 */
$app->run();
