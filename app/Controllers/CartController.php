<?php

class CartController extends CoreController {

    public function cart()
    {
        $cart = new Cart();

        $assign_to_view = [
            'array_Products' => $cart->getProducts()
        ];

        $this->show('cart', $assign_to_view);
    }

    /**
     * Méthode d'ajout d'un produit au panier
     *
     * @return redirectTo /mon-panier/
     */
    public function add()
    {
        // Au cas où mon utilisateur modifie mon formulaire d'ajout au panier...
        // Premier test: mes champs existent bien
        if (!isset($_POST['product_id']) || !isset($_POST['product_qty'])) {

            header('Location: '.$this->baseUrl.'/mon-panier/');
        }

        // Mise en place d'un "cast" en "int"
        // PHP transforme ainsi la valeur en entier.
        // Si ce n'est pas possible, PHP met une valeur à 0
        $product_id = (int)$_POST['product_id'];
        $product_qty = (int)$_POST['product_qty'];

        // Au cas où mon utilisateur modifie mon formulaire d'ajout au panier...
        // Deuxième test: mes champs ne sont pas vide !
        if (empty($product_id) || $product_qty <= 0) {

            header('Location: '.$this->baseUrl.'/mon-panier/');
        }

        // Je demande à DBData, de me fournir le produit qui porte l'id "product_id"
        $product = $this->dbData->getProductDetails($product_id);

        // Au cas où mon utilisateur modifie mon formulaire d'ajout au panier...
        // Troisième test: Si l'id envoyé ne correspond pas à un produit en BDD
        if (empty($product)) {

            header('Location: '.$this->baseUrl.'/mon-panier/');
        }

        // Je créé une nouvelle instance de ma classe Cart
        // Celle qui me permet de manipuler mon panier en Session
        $cart = new Cart();
        $succed = $cart->addProduct($product, $product_qty);

        // Maintenant je redirige vers la page 'mon-panier'
        header('Location: '.$this->baseUrl.'/mon-panier/');
    }

    public function update()
    {
        // Je modifie mon produit au panier
        // ...
        // ...
        // ...
        // ...

        // Maintenant je redirige vers la page 'mon-panier'
        header('Location: '.$this->baseUrl.'/mon-panier/');
    }

    public function delete($params)
    {
        // Je supprime un produit de mon panier
        // ...
        // ...
        // ...
        // ...

        // Maintenant je redirige vers la page 'mon-panier'
        header('Location: '.$this->baseUrl.'/mon-panier/');
    }
}