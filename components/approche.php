<?php
// Récupération des champs ACF depuis le CPT approche
$approche_titre = 'L\'APPROCHE';

// Carte 1 - Neurologie
$carte1_titre      = 'NEUROLOGIE';
$carte1_soustitre  = 'SYSTEME NERVEUX';
$carte1_paragraphe = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus dignissim diam sed lorem gravida vestibulum.';

// Carte 2 - Mobilité
$carte2_titre      = 'MOBILITÉ';
$carte2_soustitre  = 'CONTRÔLE MOTEUR';
$carte2_paragraphe = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus dignissim diam sed lorem gravida vestibulum.';

// Carte 3 - Longévité
$carte3_titre      = 'LONGÉVITÉ';
$carte3_soustitre  = 'PERFORMANCE DURABLE';
$carte3_paragraphe = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus dignissim diam sed lorem gravida vestibulum.';

$approche_query = new WP_Query(array(
    'post_type'      => 'approche',
    'posts_per_page' => 1,
    'post_status'    => 'publish',
));

if ($approche_query->have_posts()) {
    while ($approche_query->have_posts()) {
        $approche_query->the_post();

        if (function_exists('get_field')) {
            $approche_titre    = get_field('titre')            ?: $approche_titre;

            $carte1_titre      = get_field('carte1_titre')      ?: $carte1_titre;
            $carte1_soustitre  = get_field('carte1_soustitre')  ?: $carte1_soustitre;
            $carte1_paragraphe = get_field('carte1_paragraphe') ?: $carte1_paragraphe;

            $carte2_titre      = get_field('carte2_titre')      ?: $carte2_titre;
            $carte2_soustitre  = get_field('carte2_soustitre')  ?: $carte2_soustitre;
            $carte2_paragraphe = get_field('carte2_paragraphe') ?: $carte2_paragraphe;

            $carte3_titre      = get_field('carte3_titre')      ?: $carte3_titre;
            $carte3_soustitre  = get_field('carte3_soustitre')  ?: $carte3_soustitre;
            $carte3_paragraphe = get_field('carte3_paragraphe') ?: $carte3_paragraphe;
        }
    }
    wp_reset_postdata();
}
?>

<section id="approche" class="approach-section">
    <div class="container">
        <h2 class="section-title"><?php echo esc_html($approche_titre); ?><span class="dot"></span></h2>

        <div class="cards-container">
            <div class="approach-card card-light">
                <div class="card-icon brain-icon">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/cerveaux.svg" alt="Icône Neurologie">
                </div>
                <h3><?php echo esc_html($carte1_titre); ?></h3>
                <span class="subtitle"><?php echo esc_html($carte1_soustitre); ?></span>
                <div class="line"></div>
<<<<<<< style
                <p>Reconnexion cerveau / corps, travail des réflexes posturaux et de la coordination pour sécuriser chaque geste.</p>
=======
                <p><?php echo esc_html($carte1_paragraphe); ?></p>
>>>>>>> main
            </div>

            <div class="approach-card card-dark">
                <div class="card-icon cross-icon">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/croix.svg" alt="Icône Mobilité">
                </div>
                <h3><?php echo esc_html($carte2_titre); ?></h3>
                <span class="subtitle"><?php echo esc_html($carte2_soustitre); ?></span>
                <div class="line"></div>
<<<<<<< style
                <p>Exercices ciblés pour libérer les amplitudes, améliorer la qualité de mouvement et gagner en fluidité.</p>
=======
                <p><?php echo esc_html($carte2_paragraphe); ?></p>
>>>>>>> main
            </div>

            <div class="approach-card card-teal">
                <div class="card-icon pulse-icon">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/beat.svg" alt="Icône Longévité">
                </div>
                <h3><?php echo esc_html($carte3_titre); ?></h3>
                <span class="subtitle"><?php echo esc_html($carte3_soustitre); ?></span>
                <div class="line"></div>
<<<<<<< style
                <p>Programmation progressive, récupération et hygiène de vie pour continuer à bouger longtemps, sans douleur inutile.</p>
=======
                <p><?php echo esc_html($carte3_paragraphe); ?></p>
>>>>>>> main
            </div>
        </div>
    </div>
</section>