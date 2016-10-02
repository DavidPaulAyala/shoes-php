<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Brands.php";
    require_once __DIR__."/../src/Stores.php";

    use Symfony\Component\Debug\Debug;
    Debug::enable();

    $app = new Silex\Application();

    $app['debug'] = true;

    $server = 'mysql:host=localhost:8889;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
      return $app['twig']->render("home.html.twig");
    });


    $app->get("/test", function() use ($app) {
      return 'test variables here';
    });

    return $app;
?>
