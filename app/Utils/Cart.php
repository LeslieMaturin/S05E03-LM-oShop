<?php

// Classe permettant de manipuler les données de mon panier en session
class Cart {

    private $items;

    /*
    $this->items = [
        5 => [
            'id'  => 5,
            'qty' => 1
        ],
        2 => [
            'id'  => 2,
            'qty' => 8
        ],
        ...
    ]

    Schema :
        #id_produit = array(
            'id' => #id_produit,
            'qty' => #qty_produit,
        );
    */

    public function __construct()
    {
        $this->items = [];
        $this->load();
    }

    /**
     * Charge le contenu du panier en session
     *
     * @return void
     */
    public function load()
    {
        if (isset($_SESSION['cart'])) {
            $this->items = $_SESSION['cart'];
        }
    }

    /**
     * Sauvegarde le contenu du panier en session
     *
     * @return void
     */
    public function save()
    {
        $_SESSION['cart'] = $this->items;
    }

    /**
     * Ajoute un produit dans le panier
     *
     * @param Product $productModel
     * @param int $qty
     * @return bool
     */
    public function addProduct($productModel, $qty)
    {
        // Si le status du produit est != 1
        // = si le produit n'est pas disponible
        if ($productModel->getStatus() != 1) {

            return false;
        }

        // Si je n'ai pas encore mon produit dans le panier
        if (!isset($this->items[$productModel->getId()])) {

            $this->items[$productModel->getId()] = [
                'id'  => $productModel->getId(),
                'qty' => $qty
            ];

        // Si j'ai déjà mon produit dans le panier, j'incrémente la qty
        } else {

            $this->items[$productModel->getId()]['qty'] += $qty;

            // += me permet d'écrire ca:
            // $this->items[$productModel->getId()]['qty'] = $this->items[$productModel->getId()]['qty'] + $qty;
        }

        $this->save();

        return true;
    }

    /**
     * Supprime un produit du panier
     *
     * @param Product $productModel
     * @return bool
     */
    public function deleteProduct($productModel)
    {
        // TODO
    }

    /**
     * Modifie la quantié dans le panier pour un produit donné
     *
     * @param Product $productModel
     * @param int $newQty
     * @return void
     */
    public function changeQty($productModel, $newQty)
    {
        // TODO
    }

    /**
     * Retourne la liste des produits dans le panier et leur quantité
     *
     * @return Product[]
     */
    public function getProducts()
    {
        $dbData = new DBData();

        $array_Product = [];

        foreach ($this->items as $item) {

            $array_Product[] = $dbData->getProductDetails($item['id']);
        }

        return $array_Product;
    }

    /**
     * Retourne le montant total du panier
     *
     * @return float
     */
    public function getTotal()
    {
        // TODO
    }
}