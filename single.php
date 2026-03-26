<?php
get_header();
?>

<main class="site-main">
	<article class="single-post-section">
		<div class="container-single">
			<a href="<?php echo home_url('/blog/'); ?>" class="back-to-blog">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
					<line x1="19" y1="12" x2="5" y2="12"></line>
					<polyline points="12 19 5 12 12 5"></polyline>
				</svg>
				Retour au blog
			</a>

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<div class="single-header">
						<span class="blog-date"><?php echo get_the_date(); ?></span>
						<h1 class="single-title"><?php the_title(); ?></h1>
					</div>

					<?php if (has_post_thumbnail()) { ?>
						<div class="single-thumbnail">
							<?php the_post_thumbnail('full'); ?>
						</div>
					<?php } ?>

					<div class="single-content">
						<?php the_content(); ?>
					</div>

			<?php endwhile;
			endif; ?>
		</div>
	</article>

	<section class="other-blogs-section">
		<div class="container-blog">
			<h3 class="other-blogs-title">D'autres articles</h3>
			<div class="other-blogs-grid">
				<?php
				$current_post_id = get_the_ID();
				$other_args = array(
					'post_type'      => 'post',
					'posts_per_page' => 3,
					'post__not_in'   => array($current_post_id),
				);
				$other_query = new WP_Query($other_args);

				if ($other_query->have_posts()) :
					while ($other_query->have_posts()) : $other_query->the_post(); ?>
						<a href="<?php the_permalink(); ?>" class="other-blog-card">
							<div class="other-blog-thumb">
								<?php if (has_post_thumbnail()) {
									the_post_thumbnail('medium');
								} else {
									echo '<div class="placeholder-img"></div>';
								} ?>
							</div>
							<div class="other-blog-info">
								<span class="other-blog-date"><?php echo get_the_date(); ?></span>
								<h4 class="other-blog-title"><?php the_title(); ?></h4>
							</div>
						</a>
					<?php endwhile;
				else : ?>
					<p>Aucun autre article disponible.</p>
				<?php endif;
				wp_reset_postdata(); ?>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>