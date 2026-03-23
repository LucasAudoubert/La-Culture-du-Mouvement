<?php
/**
 * Template Name: Page Calendrier
 *
 * Ce modèle affiche les événements ou le planning de Culture Mouvement.
 *
 * @package culture_mouvement
 */

get_header(); ?>

<main id="primary" class="site-main calendar-page">

    <?php
    while ( have_posts() ) :
        the_post(); ?>

        <header class="entry-header">
            <h1 class="entry-title"><?php the_title(); ?></h1>
        </header>

        <div class="entry-content">
            <?php the_content(); ?>
        </div>

        <section class="calendar-wrapper">
            
            <div class="calendar-header">
                <h2>Planning des activités</h2>
                <div class="calendar-legend">
                    <span class="legend-item legend-cours"></span> Cours
                    <span class="legend-item legend-ateliers"></span> Ateliers
                </div>
            </div>

            <div id="calendar-display">
                <?php 
                /**
                 * Emplacement pour le calendrier.
                 * Si tu utilises un plugin, insère le shortcode ici via echo do_shortcode();
                 */
                ?>

                <div class="placeholder-calendar">
                    <p>Le calendrier s'affichera ici.</p>
                    <small>(Utilisez un shortcode de plugin ou une boucle WP_Query pour des événements personnalisés)</small>
                </div>
            </div>

        </section>

    <?php endwhile; ?>

</main>

<?php
get_sidebar();
get_footer();