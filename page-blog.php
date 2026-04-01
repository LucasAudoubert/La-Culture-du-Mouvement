<?php
/* Template Name: Page Blog */
get_header();

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 10,
    'paged' => $paged
);
$blog_query = new WP_Query($args);
?>

<main class="site-main">
    <section class="blog-section">
        <div class="container-blog">
            <div class="blog-header">
                <h1 class="blog-title">Le Blog <span>Mouvement</span></h1>
            </div>

            <div class="blog-list">
                <?php if ($blog_query->have_posts()) :
                    while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                        <article class="blog-card-horizontal">
                            <div class="blog-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <?php if (has_post_thumbnail()) {
                                        the_post_thumbnail('large');
                                    } else {
                                        echo '<div class="placeholder-img"></div>';
                                    } ?>
                                </a>
                            </div>

                            <div class="blog-content">
                                <span class="blog-date"><?php echo get_the_date(); ?></span>
                                <h2 class="blog-post-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <div class="blog-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="blog-read-more">Lire l'article</a>
                            </div>
                        </article>
                    <?php endwhile;
                else : ?>
                    <p>Aucun article publié.</p>
                <?php endif;
                wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>