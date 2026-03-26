<?php

/**
 * Composant : Grille des articles de blog
 */
?>
<section class="blog-section">
    <div class="container-blog">
        <div class="blog-header">
            <h1 class="blog-title">Le Blog <span>Mouvement</span></h1>
        </div>

        <div class="blog-grid">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post(); ?>
                    <article class="blog-card">
                        <div class="blog-thumb">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) {
                                    the_post_thumbnail('large');
                                } else { ?>
                                    <div class="placeholder-img"></div>
                                <?php } ?>
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
                <p>Aucun article publié pour le moment.</p>
            <?php endif; ?>
        </div>

        <div class="blog-pagination">
            <?php
            the_posts_pagination(array(
                'mid_size'  => 2,
                'prev_text' => 'Précédent',
                'next_text' => 'Suivant',
            ));
            ?>
        </div>
    </div>
</section>