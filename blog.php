<?php
/**
 * Template Name: Page Blog
 * * Ce modèle permet d'afficher la liste des articles sur une page spécifique.
 * @package culture_mouvement
 */

get_header(); ?>

<main id="primary" class="site-main">

    <header class="page-header">
        <h1 class="page-title"><?php single_post_title(); ?></h1>
    </header>

    <div class="blog-container">
        <?php
        // On définit les arguments pour récupérer les articles (posts)
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => 10, // Nombre d'articles à afficher
            'paged'          => get_query_var('paged') ? get_query_var('paged') : 1
        );

        $blog_query = new WP_Query($args);

        if ( $blog_query->have_posts() ) :
            while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
                
                <article id="post-<?php the_ID(); ?>" <?php post_class('blog-card'); ?>>
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-thumbnail">
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
                        </div>
                    <?php endif; ?>

                    <div class="post-content">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="entry-meta">
                            Posté le <?php echo get_the_date(); ?> par <?php the_author(); ?>
                        </div>
                        <div class="entry-summary">
                            <?php the_excerpt(); ?>
                        </div>
                    </div>
                </article>

            <?php endwhile;

            // Pagination personnalisée
            echo paginate_links(array('total' => $blog_query->max_num_pages));

            wp_reset_postdata(); // Important : on nettoie après la requête personnalisée

        else :
            echo '<p>Aucun article trouvé.</p>';
        endif;
        ?>
    </div>

</main>

<?php
get_sidebar();
get_footer();