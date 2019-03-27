<?php

class CatalogController extends CoreController {

    public function category($params)
    {
        $category = $this->dbData->getCategoryDetails($params['category_id']);
        $brand = $this->dbData->getBrandDetails(7);
        $type = $this->dbData->getProductTypeDetails(2);

        dump($category);
        dump($brand);
        dump($type);
        // die();

        $this->show('category');
    }

    public function type($params)
    {
        $this->show('type');
    }

    public function product($params)
    {
        // J'execute la méthode "getProductDetails" de ma classe DBData
        // je lui donne en parametre l'id du produit concerné
        $myProduct = $this->dbData->getProductDetails($params['product_id']);

        // Si mon produit n'existe pas
        if (empty($myProduct)) {

            // J'execute la méthode notFound héritée de mon CoreController
            $this->notFound();

            // Puis j'arrete l'execution de mon code là
            die();
        }

        // Je vais également avoir besoin du nom de la marque.
        // OR, dans mon modéle "product" je ne stock pas le nom de la marque
        // mais uniquement son ID
        // Je demande donc à dbData de me fournir un objet contenant ma marque.
        $myBrand = $this->dbData->getBrandDetails($myProduct->getBrandId());

        // Je vais également avoir besoin du nom de ma catégorie.
        // OR, dans mon modéle "product" je ne stock pas le nom de la catégorie
        // mais uniquement son ID
        // Je demande donc à dbData de me fournir un objet contenant ma catégorie.
        $myCategory = $this->dbData->getCategoryDetails($myProduct->getCategoryId());

        $assign_to_view = [
            'product' => $myProduct,
            'brand' => $myBrand,
            'category' => $myCategory,
        ];

        $this->show('product', $assign_to_view);
    }
}