<section class="hero">
    <div class="container">
      <!-- Breadcrumbs -->
      <ol class="breadcrumb justify-content-center">
        <li class="breadcrumb-item"><a href="<?= $this->baseUrl; ?>">Home</a></li>
        <li class="breadcrumb-item active"><?= $category->getName(); ?></li>
      </ol>
    </div>
  </section>

  <section class="products-grid">
    <div class="container-fluid">

      <div class="row" itemtype="http://schema.org/Product" itemscope>
        <!-- product-->
        <div class="col-lg-6 col-sm-12">
          <div class="product-image">
            <a href="detail.html" class="product-hover-overlay-link">
              <img src="<?= $this->baseUrl . '/' .$product->getPicture(); ?>" alt="product" class="img-fluid" itemprop="image">
            </a>
          </div>
        </div>
        <div class="col-lg-6 col-sm-12">
          <div class="mb-3">
            <h3 class="h3 text-uppercase mb-1" itemprop="name"><?= $product->getName(); ?></h3>
            <div class="text-muted">by <em itemprop="brand"><?= $brand->getName(); ?></em></div>
            <div itemprop="aggregateRating" itemtype="http://schema.org/AggregateRating" itemscope>
                <meta itemprop="ratingCount" content="18">
                <meta itemprop="ratingValue" content="4">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-o"></i>
            </div>
          </div>
          <div class="my-2" itemprop="offers" itemtype="http://schema.org/Offer" itemscope>
            <meta itemprop="availability" content="InStock">
            <meta itemprop="priceCurrency" content="EUR">
            <div class="text-muted"><span class="h4" itemprop="price"><?= $product->getPrice(); ?></span> € TTC</div>
          </div>
          <div class="product-action-buttons">
            <form action="<?= $this->baseUrl.'/ajout-panier/'; ?>" method="post">
              <input type="hidden" name="product_id" value="<?= $product->getId(); ?>">
              <input type="hidden" name="product_qty" value="1">
              <button class="btn btn-dark btn-buy"><i class="fa fa-shopping-cart"></i><span class="btn-buy-label ml-2">Ajouter au panier</span></button>
            </form>
          </div>
          <div class="mt-5">
            <p itemprop="description">
              <?= $product->getDescription(); ?>
            </p>
          </div>
        </div>
        <!-- /product-->
      </div>

    </div>
  </section>