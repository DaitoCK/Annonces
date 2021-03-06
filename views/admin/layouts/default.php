<!doctype html>
<html lang="fr" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= isset($title) ? e($title) : 'Les Bonnes Affaires'?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body class="d-flex flex-column h-100">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a href="#" class="navbar_brand">Les bonnes affaires</a>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="<?= $router->url('admin_posts') ?> " class="nav-link">Articles</a>
        </li>
        <li class="nav-item">
            <a href="<?= $router->url('admin_categories') ?> " class="nav-link">Catégories</a>
        </li>
        <li class="nav-item">
            <form action="<?= $router->url('logout') ?>" method="post" style="display:inline">
                <button type="submit" class="nav-link" style="background: transparent; border:none">Se deconnecter</button>
            </form>
        </li>
    </ul>
</nav>

<div class="container mt-4">
    <?= $content ?>
</div>
</div>

<footer class="bg-light py-4 footer mt-auto">
    <div class="container">
        Page générée en <?= round(1000 * (microtime(true) - DEBUG_TIME)) ?>ms
    </div>
</footer>
</body>
</html>




