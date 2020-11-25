    <?php

    use App\Helpers\Text;
    use App\Model\Post;
    use App\Connection;

    $title = 'Les petites annonces';
    $pdo = Connection::getPDO();

    $query = $pdo->query('SELECT * FROM post ORDER BY create_at DESC LIMIT 12');
    $posts = $query->fetchAll(PDO:: FETCH_CLASS, Post::class);
    ?>

    <h1>Les petites annonces</h1>



    <div class="row">
        <?php foreach($posts as $post): ?>
        <div class="col-md-3">
            <?php require  'card.php' ?>
        </div>
        <?php endforeach ?>
    </div>



