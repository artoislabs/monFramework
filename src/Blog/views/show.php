<?= $renderer->render('../../views/header', ['title' => $slug  ]); ?>

<h1>Bienvenue sur l'article' <?= $slug ?></h1>


<div>
	<ul>
		<li><a href="<?= $router->generateUri('blog.show', ['slug' => 'zazazaz-dqsd']); ?>">Article 1 </a> </li>
		<li>Menu </li>
		<li>Menu </li>
		<li>Menu </li>
		<li>Menu </li>
		<li>Menu </li>
		<li>Menu </li>
	</ul>
</div>
<?= $renderer->render('../../views/footer'); ?>