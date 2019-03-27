<?php

/**
 * Classe permettant de retourner des données stockées dans la base de données
 */
class DBData {

	/** @var PDO */
	private $dbh;

    /**
     * Constructeur se connectant à la base de données à partir des informations du fichier de configuration
     */
    public function __construct() {
        // Récupération des données du fichier de config
        //   la fonction parse_ini_file parse le fichier et retourne un array associatif
        // Attention, "config.conf" ne doit pas être versionné,
        //   on versionnera plutôt un fichier d'exemple "config.dist.conf" ne contenant aucune valeur
        $configData = parse_ini_file(__DIR__.'/../config.conf');

        try {
            $this->dbh = new PDO(
                "mysql:host={$configData['DB_HOST']};dbname={$configData['DB_NAME']};charset=utf8",
                $configData['DB_USERNAME'],
                $configData['DB_PASSWORD'],
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING) // Affiche les erreurs SQL à l'écran
            );
        }
        catch(\Exception $exception) {
            echo 'Erreur de connexion...<br>';
            echo $exception->getMessage().'<br>';
            echo '<pre>';
            echo $exception->getTraceAsString();
            echo '</pre>';
            exit;
        }
    }

    /**
     * Méthode permettant de retourner les données sur un produit donné
     *
     * @param int $productId
     * @return Product
     */
    public function getProductDetails($productId) {

        $sql = "SELECT *
                FROM product
                WHERE product.id = {$productId};";

        $pdoStatement = $this->dbh->query($sql);

        // Méthode 1: old school
        // $result = $pdoStatement->fetch(PDO::FETCH_ASSOC);

        // $product = new Product();
        // $product->setId($result['id']);
        // $product->...

        // Méthode 2 : Super dev 4.0
        return $pdoStatement->fetchObject('Product');
    }

    /**
     * Méthode permettant de retourner les données sur une catégorie donnée
     *
     * @param int $categoryId
     * @return Category
     */
    public function getCategoryDetails($categoryId) {

        $sql = "SELECT *
                FROM `category`
                WHERE category.id = {$categoryId};";

        $pdoStatement = $this->dbh->query($sql);

        return $pdoStatement->fetchObject('Category');
    }

    /**
     * Méthode permettant de retourner les données sur une marque donnée
     *
     * @param int $brandId
     * @return Brand
     */
    public function getBrandDetails($brandId) {

        $sql = "SELECT *
                FROM `brand`
                WHERE brand.id = {$brandId};";

        $pdoStatement = $this->dbh->query($sql);

        return $pdoStatement->fetchObject('Brand');
    }

    /**
     * Méthode permettant de retourner les données sur un type de produit donné
     *
     * @param int $typeId
     * @return ProductType
     */
    public function getProductTypeDetails($typeId) {

        $sql = "SELECT *
                FROM `type`
                WHERE type.id = {$typeId};";

        $pdoStatement = $this->dbh->query($sql);

        return $pdoStatement->fetchObject('ProductType');
    }

    /**
     * Méthode permettant de retourner les 5 catégories sur la page d'accueil
     *
     * @return Category[]
     */
    public function getHomeCategories() {

        $sql = "SELECT *
                FROM `category`
                WHERE home_order > 0
                ORDER BY home_order
                LIMIT 5;";

        $pdoStatement = $this->dbh->query($sql);

        // Si je fait un fetchObject:
        //  je n'aurai que le premier résultat
        // return $pdoStatement->fetchObject('ProductType');

        // Du coup si je veux un tableau d'objets:
        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'Category');
    }

    /**
     * Méthode permettant de retourner les 5 marques en bas de page
     *
     * @return Brand[]
     */
    public function getFooterBrands() {

        $sql = "SELECT *
                FROM `brand`
                WHERE footer_order > 0
                ORDER BY footer_order
                LIMIT 5;";

        $pdoStatement = $this->dbh->query($sql);

        // Si je fait un fetchObject:
        //  je n'aurai que le premier résultat
        // return $pdoStatement->fetchObject('ProductType');

        // Du coup si je veux un tableau d'objets:
        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'Brand');
    }

    /**
     * Méthode permettant de retourner les 5 types de produit en bas de page
     *
     * @return ProductType[]
     */
    public function getFooterProductTypes() {

        $sql = "SELECT *
                FROM `type`
                WHERE footer_order > 0
                ORDER BY footer_order
                LIMIT 5;";

        $pdoStatement = $this->dbh->query($sql);

        // Si je fait un fetchObject:
        //  je n'aurai que le premier résultat
        // return $pdoStatement->fetchObject('ProductType');

        // Du coup si je veux un tableau d'objets:
        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'ProductType');
    }
}