<?php
$args = array(
    'post_type'      => 'landing-page',
    'name'           => 'avis',
    'posts_per_page' => 1,
    'post_status'    => 'publish',
);

$reviews_query = new WP_Query($args);

if ($reviews_query->have_posts()) :
    while ($reviews_query->have_posts()) : $reviews_query->the_post();
        $avis_data = [];
        for ($i = 1; $i <= 6; $i++) {
            $text = get_field("avis{$i}_texte");
            if ($text) {
                $avis_data[] = [
                    'etoiles' => get_field("avis{$i}_etoiles") ?: '★★★★★',
                    'texte'   => $text,
                    'auteur'  => get_field("avis{$i}_auteur") ?: 'Client'
                ];
            }
        }
?>

        <section class="reviews-section" id="avis">
            <div class="container-reviews">
                <div class="reviews-header">
                    <h2 class="reviews-title">Ce qu'ils en <span>pensent</span></h2>
                </div>
            </div>

            <div class="reviews-slider-wrapper">
                <div class="reviews-track">

                    <?php
                    ?>
                    <?php for ($j = 0; $j < 2; $j++) : ?>
                        <div class="reviews-group">
                            <?php foreach ($avis_data as $item) : ?>
                                <div class="review-card">
                                    <div class="review-stars"><?php echo esc_html($item['etoiles']); ?></div>
                                    <p class="review-text">"<?php echo esc_html($item['texte']); ?>"</p>
                                    <div class="review-author">- <?php echo esc_html($item['auteur']); ?></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endfor; ?>

                </div>
            </div>
        </section>

<?php endwhile;
    wp_reset_postdata();
endif; ?>