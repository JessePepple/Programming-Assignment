<main>
	<h1>Welcome to Ed's Electronics</h1>

	<p>We stock a large variety of electrical goods including phones, tvs, computers and games. Everything comes with at least a one year guarantee and free next day delivery.</p>

	<hr />

	<h2>Product list</h2>
	<ul class="products">
		<?php
		if(!empty($products)):
			foreach($products as $product): ?>
				<li>
					<a href="/product.php?id=<?= $product['id'] ?>">
						<h3><?= ucwords($product['name']) ?></h3>
					</a>
					<p><?= ucfirst($product['description']) ?></p>


					<div class="price">£<?= number_format($product['price'], 2) ?></div>
				</li>
				<?php
			endforeach;
		endif; ?>

	</ul>
		</main>