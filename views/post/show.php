<?php
$id = (int)$params['id'];
$slug = $params['slug'];

$pdo = \App\Connection::getPDO();
$query = $pdo->prepare('SELECT * FROM post WHERE id = :id');
$query->execute(['id' => $id]);
$post = $query ->fetchAll(PDO::FETCH_CLASS, Post::class)[0];
dd($post);