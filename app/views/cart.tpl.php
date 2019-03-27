
    <h1>Vous affichez la page du panier</h1>

    <ul>

    <?php foreach ($array_Products as $product): ?>

        <li><?= $product->getName(); ?></li>


    <?php endforeach; ?>

    </ul>
