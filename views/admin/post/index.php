<?php
use App\Connection;
use App\Table\PostTable;
use App\Auth;

Auth::check();

$title= "Administration";
$pdo = Connection::getPDO();
$link = $router->url('admin_posts');
[$posts, $pagination] = (new \App\Table\PostTable($pdo))->findPaginated();
?>

<?php if (isset($_GET['delete'])): ?>
<div class="alert alert-sucess">
    L'enregistremenbt a bien été supprimé
</div>
<?php endif ?>

<table class="table">
    <thead>
        <th>#</th>
        <th>Titre</th>
        <th>Actions</th>
    </thead>
    <tbody>
    <?php foreach($posts as $post): ?>
        <tr>
            <td>#<?= $post->getId() ?></td>
            <td>
                <a href="<?= $router->url('admin_post', ['id' => $post->getID()])?>">
                    <?= e($post->getName()) ?></td>
                </a>
            <td>
                <a href="<?= $router->url('admin_post', ['id' => $post->getID()])?>" class="btn btn-primary">
                    Editer
                </a>
                <form action="<?= $router->url('admin_post_delete', ['id' => $post->getID()])?>" method="POST"
                    onsubmit="return confirm('voulez vous vraiment effectuer cette action ?')" style="display: inline">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>

<div class="d-flex justify-content-between my-4">
    <?= $pagination->previousLink($link) ?>
    <?= $pagination->nextLink($link) ?>
</div>
