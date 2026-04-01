<?php
$args = array(
    'post_type'      => 'landing-page',
    'posts_per_page' => 1,
    'post_status'    => 'publish',
);

$hero_query = new WP_Query($args);

if ($hero_query->have_posts()) :
    while ($hero_query->have_posts()) : $hero_query->the_post();

        $tag       = get_field('hero_tag') ?: 'NEUROLOGIE & PERFORMANCE';
        $title     = get_field('hero_title') ?: 'Bouger mieux.<br>Durer longtemps.';
        $desc      = get_field('hero_description') ?: 'Un accompagnement personnalisé pour développer un corps plus capable, réduire les douleurs et progresser à votre rythme, en toute sécurité.';
        $cta_text  = get_field('hero_cta_text') ?: 'PRENDRE RENDEZ-VOUS';
        $cta_link  = get_field('hero_cta_link') ?: '/contact';
        $bg_image = get_field('hero_bg');
        $has_custom_bg = false;

        if (is_array($bg_image) && isset($bg_image['url'])) {
            $bg_url = $bg_image['url'];
            $has_custom_bg = true;
        } elseif (is_string($bg_image) && !empty($bg_image)) {
            $bg_url = $bg_image;
            $has_custom_bg = true;
        } else {
            $bg_url = get_template_directory_uri() . '/assets/img/fond-parralax-girl.webp';
        }

        $loc_value = get_field('hero_loc_value') ?: 'Nanterre (92)';
?>

        <section class="hero-section" style="background-image: url('<?php echo esc_url($bg_url); ?>');">

            <?php
            if (!$has_custom_bg) : ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/parallax-girl.webp" class="hero-parallax-girl" alt="">
            <?php endif; ?>

            <canvas id="hero-canvas"></canvas>

            <div class="hero-container">
                <div class="hero-content">
                    <div class="hero-tag"><?php echo esc_html($tag); ?></div>
                    <h1 class="hero-title"><?php echo wp_kses_post($title); ?></h1>
                    <p class="hero-description"><?php echo esc_html($desc); ?></p>

                    <div class="hero-cta">
                        <a href="<?php echo esc_url($cta_link); ?>" class="btn-rdv">
                            <span class="btn-icon">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </span>
                            <span class="btn-text"><?php echo esc_html($cta_text); ?></span>
                        </a>
                    </div>
                </div>

                <div class="hero-visual">

                    <div class="video-placeholder" id="hero-blog-slider" style="overflow: hidden; position: relative;">
                        <div class="slider-wrapper" id="slider-wrapper" style="display: flex; height: 100%; transition: transform 0.5s ease-in-out;">
                            <?php
                            $slider_args = array('post_type' => 'post', 'posts_per_page' => 3);
                            $slider_query = new WP_Query($slider_args);
                            $post_count = $slider_query->post_count;

                            if ($slider_query->have_posts()) :
                                while ($slider_query->have_posts()) : $slider_query->the_post(); ?>

                                    <a href="<?php the_permalink(); ?>" class="hero-slide" style="min-width: 100%; height: 100%; display: block; position: relative; text-decoration: none;">
                                        <?php if (has_post_thumbnail()) {
                                            // Affiche l'image de l'article en forçant sa taille à remplir le conteneur
                                            the_post_thumbnail('medium_large', ['style' => 'width: 100%; height: 100%; object-fit: cover;']);
                                        } else {
                                            // Fond noir de secours s'il n'y a pas d'image
                                            echo '<div style="width: 100%; height: 100%; background: #111;"></div>';
                                        } ?>

                                        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.4);"></div>

                                        <div style="position: absolute; bottom: 0; left: 0; width: 100%; padding: 40px 20px 20px; background: linear-gradient(to top, rgba(0,0,0,0.9), transparent); z-index: 2;">
                                            <h4 style="color: #fff; margin: 0; font-size: 15px; text-transform: uppercase; font-weight: bold; position: relative;"><?php the_title(); ?></h4>
                                        </div>
                                    </a>

                            <?php endwhile;
                            endif;
                            ?>
                        </div>

                        <?php if (isset($post_count) && $post_count > 1) : ?>
                            <div class="dots" style="position: absolute; bottom: 15px; left: 15px; z-index: 10;">
                                <?php for ($i = 0; $i < $post_count; $i++) {
                                    $active_class = ($i === 0) ? ' active' : '';
                                    echo '<span class="dot' . $active_class . '"></span>';
                                } ?>
                            </div>
                        <?php endif;
                        wp_reset_postdata(); ?>
                    </div>

                    <div class="hero-location">
                        <span class="location-label">LOCALISATION</span>
                        <span class="location-value"><?php echo esc_html($loc_value); ?></span>
                    </div>
                </div>
            </div>
        </section>

<?php
    endwhile;
    wp_reset_postdata();
else :
    echo '<p style="color:black; text-align:center; padding:50px;">Créez un article dans le menu "Pages d\'accueil" pour afficher cette section.</p>';
endif;
?>