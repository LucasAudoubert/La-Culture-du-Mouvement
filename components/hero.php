<?php
$args = array(
    'post_type'      => 'hero',
    'posts_per_page' => 1,
    'post_status'    => 'publish',
);

$hero_query = new WP_Query($args);

if ($hero_query->have_posts()) :
    while ($hero_query->have_posts()) : $hero_query->the_post();

        $tag       = get_field('hero_tag') ?: 'NEUROLOGIE & PERFORMANCE';
        $title     = get_field('hero_title') ?: 'Bouger mieux.<br>Durer<br>longtemps.';
        $desc      = get_field('hero_description') ?: 'Une approche neuro-fonctionnelle...';
        $cta_text  = get_field('hero_cta_text') ?: 'PRENDRE RENDEZ-VOUS';
        $cta_link  = get_field('hero_cta_link') ?: '#rendez-vous';
        // Ici on utilise ton nouveau fond sans la fille
        $bg_url    = get_template_directory_uri() . '/assets/img/fond-parralax-girl.png';
        $loc_value = get_field('hero_loc_value') ?: 'Nanterre (92)';
?>

        <section class="hero-section" style="background-image: url('<?php echo esc_url($bg_url); ?>');">

            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/parallax-girl.png" class="hero-parallax-girl" alt="">

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
                    <div class="video-placeholder">
                        <div class="dots">
                            <span class="dot active"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                        </div>
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
    echo '<p style="color:white; text-align:center; padding:50px;">Créez un article dans le menu "Héros" pour afficher cette section.</p>';
endif;
?>