<?php
namespace App\Model;

use App\Helpers\Text;

use \DateTime;

class Post {

    private $id;

    private $slug;

    private $name;

    private $content;

    private $create_at;

    private $categories = [];

    public function getName () {
        return $this->name;
    }

    public function getExcerpt (): ?string
    {
        if ($this->content === null) {
            return null;
        }
         return nl2br(htmlentities(Text::excerpt($this->content, 60)));
    }

    public function getCreateAt (): DateTime
    {
        return new DateTime($this->create_at);
    }
    public function getSlug (): ?string
    {
        return $this->slug;
    }
    public function getID(): ?int
    {
        return $this->id;
    }
}