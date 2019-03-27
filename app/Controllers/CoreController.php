<?php

// Puisque ma classe CoreController ne sera jamais instancée directement
// je ne ferais jamais de new CoreController
// Je peux l'indiquer à PHP en faisant un :
// abstract class Controller
// Ma classe CoreController deviens une classe abstraite, cela ne change rien à son fonctionnement
// elle ne peux simplement plus être instanciée directement !
class CoreController {

    protected $baseUrl;
    protected $dbData;

    public function __construct($baseUrl)
    {
        $this->baseUrl = $baseUrl;

        // Instanciation de DBData.
        $this->dbData = new DBData();
    }

    public function notFound()
    {
        // J'envoi un status 404 à mon navigateur
        header('HTTP/1.0 404 Not Found');
        $this->show('tony-404');
    }

    protected function show($tpl_name, $array_argument = [])
    {
        // Je créé une variable $array_productType, qui va contenir
        // les 5 types de produits à afficher dans le footer
        $array_productType = $this->dbData->getFooterProductTypes();

        // Je créé une variable $array_brands, qui va contenir
        // les 5 marques à afficher dans le footer
        $array_brands = $this->dbData->getFooterBrands();

        // Problématique:
        // Je récupere dans ma méthode show, les variables provenant de l'action
        // ces variables me permettent ensuite de rendre dynamique mon template.
        // Le "problème" c'est que dans ma vue je vais devoir les utiliser ainsi:
        // $array_argument['array_Category']
        // Résumé de la problématique:
        // Comment transformer $array_argument['array_Category'] en $array_Category

        // Solution :
        // Je souhaite recréer mes variables contenues dans mon tableau
        // $array_argument sous la forme "nom_variable" => "valeur"
        foreach ($array_argument as $argument_name => $argument_value) {

            // Je dis à PHP créer moi une variable dont le nom
            // est la valeur de la variable "$argument_name"
            // PHP va donc remplacer $argument_name par "array_Category"
            // puis PHP va lire : "$array_Category = $argument_value"
            ${$argument_name} = $argument_value;

            // La ligne du dessus devient par exemple:
            // $array_Category = $argument_value;

            // Fonctionne également :
            // $$argument_name = $argument_value;
        }

        // Petit debug:
        // get_defined_vars() est une fonction native de PHP
        // qui affiche les variables déclarée là où je me trouve
        // dump(get_defined_vars());
        // die();

        require __DIR__.'/../views/header.tpl.php';
        require __DIR__.'/../views/'.$tpl_name.'.tpl.php';
        require __DIR__.'/../views/footer.tpl.php';
    }
}