<?php

// use SocialLinks\Page;

class MainController extends CoreController {

    public function __construct($baseUrl)
    {
        // Comme j'ai définit mon constructeur sur
        // ma classe enfant, celui de ma classe mère n'est pas appelé.
        // Si je souhaite l'appeler manuellement je fait donc:
        parent::__construct($baseUrl);
    }

    public function home()
    {
        // Je demande à mon objet dbData (propriété du CoreController dont j'hérite)
        // de me donner les 5 catégories de la home.
        // Je stock le tableau de category dans ma var "array_Category"
        $array_Category = $this->dbData->getHomeCategories();

        $assign_to_view = [
            'array_Category' => $array_Category,
            'toto' => 'tutu',
        ];

        $this->show('home', $assign_to_view);
    }

    public function legalMentions()
    {
        $this->show('legal-mentions');
    }
}