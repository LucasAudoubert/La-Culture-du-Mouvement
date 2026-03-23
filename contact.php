<?php
/**
 * Template Name: Page Contact
 * * Ce modèle permet d'afficher une page de contact avec un formulaire 
 * et éventuellement des informations de coordonnées.
 * * @package culture_mouvement
 */

get_header(); ?>

<main id="primary" class="site-main contact-page">

    <?php
    while ( have_posts() ) :
        the_post(); ?>

        <header class="entry-header">
            <h1 class="entry-title"><?php the_title(); ?></h1>
        </header>

        <div class="contact-container" style="display: flex; gap: 40px; flex-wrap: wrap;">
            
            <div class="contact-content" style="flex: 1; min-width: 300px;">
                <?php the_content(); ?>
                
                <div class="contact-details" style="margin-top: 20px;">
                    <h3>Nos coordonnées</h3>
                    <ul>
                        <li><strong>Adresse :</strong> 123 Rue de la Culture, Paris</li>
                        <li><strong>Email :</strong> contact@culturemouvement.fr</li>
                        <li><strong>Téléphone :</strong> 01 23 45 67 89</li>
                    </ul>
                </div>
            </div>

            <div class="contact-form-area" style="flex: 1; min-width: 300px; background: #f9f9f9; padding: 20px; border-radius: 8px;">
                <h3>Envoyez-nous un message</h3>
                
                <?php 
                /* * ASTUCE : La plupart des développeurs WP utilisent l'extension 
                 * "Contact Form 7" ou "WPForms". 
                 * Si tu en as une, remplace le code ci-dessous par le shortcode :
                 * echo do_shortcode('[contact-form-7 id="123" title="Contact"]');
                 */
                ?>
                
                <form action="#" method="post" class="custom-contact-form">
                    <p>
                        <label for="name">Nom</label><br>
                        <input type="text" name="name" id="name" style="width:100%;">
                    </p>
                    <p>
                        <label for="email">Email</label><br>
                        <input type="email" name="email" id="email" style="width:100%;">
                    </p>
                    <p>
                        <label for="message">Message</label><br>
                        <textarea name="message" id="message" rows="5" style="width:100%;"></textarea>
                    </p>
                    <p>
                        <button type="submit" class="button">Envoyer</button>
                    </p>
                </form>
            </div>

        </div>

    <?php endwhile; ?>

</main>

<?php
get_sidebar();
get_footer();