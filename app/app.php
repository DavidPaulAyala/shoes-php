<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Brand.php";
    require_once __DIR__."/../src/Store.php";

    use Symfony\Component\Debug\Debug;
    Debug::enable();

    $app = new Silex\Application();

    $app['debug'] = true;

    $server = 'mysql:host=localhost:8889;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render("index.html.twig");
    });

    $app->get("/stores", function() use ($app) {
        return $app['twig']->render("stores.html.twig", array('stores' => Store::getAll()));
    });

    $app->get("/brands", function() use ($app) {
        return $app['twig']->render("brands.html.twig", array('brands' => Brand::getAll()));
    });

    $app->post("/stores", function() use ($app) {
        $store = new Store($_POST['name']);
        $store->save();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    $app->post("/delete_stores", function() use ($app) {
    Store::deleteAll();
    return $app['twig']->render('index.html.twig');
    });

    $app->get("/stores/{id}", function($id) use ($app) {
    $store = Store::find($id);
    return $app['twig']->render('store.html.twig', array('store' => $store, 'brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
    });

    $app->post("/brands", function() use ($app) {
        $brand = new Brand($_POST['name']);
        $brand->save();
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });

    $app->post("/delete_brands", function() use ($app) {
    Brand::deleteAll();
    return $app['twig']->render('index.html.twig');
    });

    $app->get("/brands/{id}", function($id) use ($app) {
    $brand = Brand::find($id);
    return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'brands' => $brand->getStores(), 'all_brands' => Store::getAll()));
    });

    return $app;
?>
