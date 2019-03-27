<section>
  <div class="container-fluid">

    <div class="row mx-0">

      <?php

      $counter = 0;

      foreach ($array_Category as $Category) :

        // Je compte le nombre de fois où je passe dans ma boucle
        $counter++;

        ?>
          <div class="<?= $counter > 2 ? 'col-lg-4' : 'col-md-6'; ?>">
            <div class="card border-0 text-white text-center"><img src="<?= $this->baseUrl.'/'.$Category->getPicture(); ?>"
                alt="Card image" class="card-img">
              <div class="card-img-overlay d-flex align-items-center">
                <div class="w-100 py-3">
                  <h2 class="display-3 font-weight-bold mb-4"><?= $Category->getName(); ?></h2><a href="<?= $this->baseUrl; ?>/catalogue/categorie/<?= $Category->getId(); ?>" class="btn btn-light">Découvrir</a>
                </div>
              </div>
            </div>
          </div>
        <?php

        if ($counter == 2) : ?>

          <!-- Fermeture de ma row -->
          </div>
          <!-- Ouverture d'une nouvelle row -->
          <div class="row mx-0">

          <?php
        endif;


      endforeach;

      ?>

    </div>
  </div>
</section>