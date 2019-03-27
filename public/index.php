<?php

# Index.php est mon point d'entré unique !
# C'est lui qui vient instancier mon controller en fonction de mon url.
# Ensuite c'est lui qui se charge d'executer la méthode (action) du controller.
# Il fait donc correspondre une url à un couple Controller/Méthode: c'est le principe de la route !
# Ce fichier est donc devant les Controllers, on parle alors de FrontController !

// Inclusion de l'autoload de composer
require __DIR__.'/../vendor/autoload.php';

// Inclusion de nos Models
require __DIR__.'/../app/Models/CoreModel.php';
require __DIR__.'/../app/Models/FooterModel.php';
require __DIR__.'/../app/Models/Brand.php';
require __DIR__.'/../app/Models/Category.php';
require __DIR__.'/../app/Models/Product.php';
require __DIR__.'/../app/Models/ProductType.php';

// Inclusion de nos Utils
require __DIR__.'/../app/Utils/DBData.php';
require __DIR__.'/../app/Utils/Cart.php';

// Inclusion des controllers
require __DIR__.'/../app/Controllers/CoreController.php';
require __DIR__.'/../app/Controllers/MainController.php';
require __DIR__.'/../app/Controllers/CatalogController.php';
require __DIR__.'/../app/Controllers/CartController.php';

// On active le système de session au début du script pour chaque page !
session_start();

// Mise en place de notre système de "routage" avec des IF/ELSE
// Méthode pas super ergo/pratique
// if (empty($_GET['_url']) || $_GET['_url'] == '/home') {

//     $controller = new MainController();
//     $controller->home();

// } elseif ($_GET['_url'] == '/catalogue/produit/') {

//     $controller = new CatalogController();
//     $controller->product();

// } else {

//     $controller = new MainController();
//     $controller->notFound();
// }


// Instance de AltoRouter
$router = new AltoRouter();

// Utilisation de la méthode setBasePath
// D'après la doc elle permet de déclarer à AltoRouteur, la partie "statique" de notre URL

// Je récupere la base_uri (si envoyée par Apache, d'après le .htaccess)
$baseUrl = isset($_SERVER['BASE_URI']) ? trim($_SERVER['BASE_URI']) : '/';

// http://php.net/manual/fr/function.trim.php
// $toto = trim('   sqkjdfksqdj   ') devient $toto = 'sqkjdfksqdj'

// Je donne à AltoRouteur l'information de la base_uri
$router->setBasePath($baseUrl);

// Déclaration des routes à AltoRouteur

$router->map('GET', '/', ['MainController', 'home'], 'home');
$router->map('GET', '/mentions-legales/', ['MainController', 'legalMentions'], 'legalMentions');
$router->map('GET', '/catalogue/categorie/[i:category_id]', ['CatalogController', 'category'], 'categoryDetails');
$router->map('GET', '/catalogue/type/[i:type_id]', ['CatalogController', 'type'], 'typeDetails');
$router->map('GET', '/catalogue/produit/[i:product_id]', ['CatalogController', 'product'], 'productDetails');
$router->map('GET', '/mon-panier/', ['CartController', 'cart'], 'cartShow');
$router->map('POST', '/ajout-panier/', ['CartController', 'add'], 'cartAdd');
$router->map('POST', '/modif-panier/', ['CartController', 'update'], 'cartUpdate');
$router->map('GET', '/supp-product-panier/[i:product_id]', ['CartController', 'delete'], 'cartDelete');


// Je demande à AltoRouteur si il y a une correspondance entre les routes déclarées
// et l'url actuelle
$match = $router->match();

// Si il y a un match...
if ($match) {

    /*
        Détails de la variable "$match" :

        array(3) {
            ["target"]	=> array(
                0 => 'Nom du controller',
                1 => 'Nom de la méthode'
            )
            ["params"]	=> array( Liste des parametres... )
            ["name"] 	=> 'Nom de la route'
        }
    */

    // Je stock dans des variables les noms de mon controlleur déterminé & de la méthode
    $controllerName = $match['target'][0];
    $actionName = $match['target'][1];

    // J'instancie mon controller
    // PHP va remplacer la variable $controllerName par sa valeur
    // puis il va instancier la bonne classe
    // ex: $controller = new MainController();
    $controller = new $controllerName($baseUrl);

    // J'appel la méthode correspondant à la route (déterminée par AltoRouteur)
    // PHP va remplacer la variable $actionName par sa valeur
    // puis il va appeler la méthode
    // ex: $controller->home()
    $controller->$actionName($match['params']);

// Sinon c'est une 404 !
} else {

    $controller = new MainController();
    $controller->notFound();
}
