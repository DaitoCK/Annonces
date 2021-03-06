<?php
namespace App\Table;

use App\PaginatedQuery;
use App\Model\Post;


final class PostTable extends Table {

    // Je rappelle mes valeurs protégé de la table Parent.
    protected $table = "post";
    protected $class = Post::class;


    public function updatePost (Post $post): void
    {

        $this->update([
            'name' => $post->getName(),
            'slug' => $post->getSlug(),
            'content' => $post->getContent(),
            'create_at' => $post->getCreateAt()->format('Y-m-d H:i:s')
        ], $post->getID());
    }

    public function createPost (Post $post): void
    {
        $id = $this->create([
            'name' => $post->getName(),
            'slug' => $post->getSlug(),
            'content' => $post->getContent(),
            'create_at' => $post->getCreateAt()->format('Y-m-d H:i:s')
        ]);
        $post->setID($id);
    }

    public function attachCategories (int $id, array $categories) {
        $this->pdo->exec('DELETE FROM post_category WHERE post_id = ' . $id);
        $query = $this->pdo->prepare('INSERT INTO post_category SET post_id = ?, category_id = ?');
        foreach($categories as $category){
            $query->execute([$id, $category]);
        }
    }



    /* Pour mettre en place la pagination si dessous. Il va falloir calculer les variables suivantes :
              - Le nombre total d'articles (une requête SQL avec un COUNT(id)).
              - Le nombre d'articles par page (on peut définir une variable ou utiliser une constante).
              - Le nombre de pages (obtenu en divisant le nombre total d'articles par le nombre d'éléments par page).
           Il suffit ensuite de jouer avec le paramètre OFFSET afin d'afficher les articles correspondant à une certaine page. */

    public function findPaginated()
    {
        $paginatedQuery = new PaginatedQuery(
            "SELECT * FROM {$this->table} ORDER BY create_at DESC ",
            "SELECT COUNT(id) FROM {$this->table}");
        $this->pdo;
        $posts = $paginatedQuery->getItems(Post::class);
        (new CategoryTable($this->pdo))->hydratePosts($posts);
        return [$posts, $paginatedQuery];
    }

    public function findPaginatedForCategory (int $categoryID)
    {

        $paginatedQuery = new PaginatedQuery(
            "SELECT p.*
            FROM post p
            JOIN post_category pc ON pc.post_id = p.id
            WHERE pc.category_id = {$categoryID}
            ORDER BY create_at DESC",
            "SELECT COUNT(category_id) FROM post_category WHERE category_id = {$categoryID}"
        );

        $posts = $paginatedQuery->getItems(Post::class);
        (new CategoryTable($this->pdo))->hydratePosts($posts);
        return [$posts, $paginatedQuery];
    }

}