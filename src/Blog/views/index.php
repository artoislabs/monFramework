<?= $renderer->render('../../views/header'); ?>

<h1>Bienvenue sur le blog</h1>


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