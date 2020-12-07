<?php
namespace App\Model;

use App\Helpers\Text;
use \DateTime;

/* Une classe pou représenter nos données:
Lorsque l'on récupère des données il peut être intéréssant de les organiser dans des objets. Cela offre 2 avantages :
- On peut créer des "getters" qui permettent de contrôler le type de retour pour chacun de nos champs (par exemple on
peut convertir les date MySQL en DateTime PHP).
- On a des objets avec des signatures connues et il est plus simple d'identifier leur structure lorsqu'ils sont utilisé
en paramètre dans des méthodes.*/

class Post {
    private $id;

    private $slug;

    private $name;

    private $content;

    private $create_at;

    private $categories = [];

    public function getName(): ?string
    {
        return $this->name;
    }

    //Set name permet de redéfinir une valeur.
    public function setName (string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setContent (string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }


    public function getFormattedContent(): ?string{
        return  nl2br(e($this->content));
    }

    public  function getExcerpt (): ?string
    {
        if ($this->content === null) {
            return null;
        }
        return nl2br(htmlentities(Text::excerpt($this->content,60)));
    }

    public function getCreateAt (): DateTime
    {
        return new DateTime($this->create_at);
    }

    public function getSlug (): ?string
    {
        return $this->slug;
    }

    public function getID (): ?int
    {
        return $this->id;
    }

    /** @return Category[] */
    public function getCategories (): array
    {
        return $this->categories;
    }

    public function addCategory (Category $category): void
    {
        $this->categories[] = $category;
        $category->setPost($this);
    }

}