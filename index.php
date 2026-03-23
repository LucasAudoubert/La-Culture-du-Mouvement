<?php get_header(); ?>

<main id="primary" class="site-main">
	<?php
	// Chargement de la section Hero
	get_template_part('components/hero');
	get_template_part('components/approche');
	get_template_part('components/pour-qui');

	// Les futurs composants (Approche, A propos, etc.) viendront s'ajouter ici
	?>
</main>

<?php get_footer(); ?>