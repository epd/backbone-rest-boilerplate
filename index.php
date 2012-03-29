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
 * Mongo connection.
 */
/* --- Comment this line to enable MongoDB support ---
$_SERVER['mongo.hostname'] = 'localhost';
try {
    // Default connection resource
    $dsn = sprintf('mongodb://%s', $_SERVER['mongo.hostname']);

    // If we need to authenticate, go ahead and do it
    if (isset($_SERVER['mongo.username']) && !empty($_SERVER['mongo.username'])) {
        $dsn = sprintf('mongodb://%s:%s@%s', $_SERVER['mongo.hostname'], $_SERVER['mongo.username'], $_SERVER['mongo.password']);
    }

    // Make the connection!
    $mongo = new Mongo($dsn, array('persist' => 'x'));
}

// An error has occured connecting to DB
catch (MongoConnectionException $e) {
    die("Could not connect to Mongo database");
}
// --- */

/**
 * MySQL PDO connection
 */
/* --- Comment this line to enable PDO support ---
try {
    // Go ahead and create our connection!
    $pdo = new PDO(

        // If we need sockets, use them. If not, use hostname
        sprintf('mysql:' . (isset($_SERVER['pdo.socket']) && !empty($_SERVER['pdo.socket']) ? 'unix_socket' : 'host') . '=%s;dbname=%s', isset($_SERVER['pdo.socket']) && !empty($_SERVER['pdo.socket']) ? $_SERVER['pdo.socket'] : $_SERVER['pdo.hostname'], $_SERVER['pdo.database']),

        // Authenticate with these credentials
        sprintf('%s', $_SERVER['pdo.username']),
        sprintf('%s', $_SERVER['pdo.password'])
    );
}

// An error has occured connecting to DB
catch (PDOException $e) {
    die("Could not connect to MySQL database");
}
// --- */

/**
* Route definitions.
*/
$app->get('/', function () use($app) {
    // Get our main layout and render it
    $app->render('layout.html', array(
        // Shows up in the <title> tags
        'app_title' => 'Backbone.js REST Boilerplate',

        // Use the release version from the build script
        'assets_js_path' => 'dist/release',
        'assets_css_path' => 'dist/release',
    ));
});

/**
* Initialize the application.
*/
$app->run();
