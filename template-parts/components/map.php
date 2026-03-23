<?php
/**
 * Composant Localisation - OpenStreetMap via Leaflet.js
 * @package culture_mouvement
 */

$adresse   = '190 RUE DU BLA BLABLABLA';
$cp_ville  = '00000 BLABLABLA';
$gare      = 'Gare la plus proche du local';
$parking   = 'Nom du parking';
$email     = 'coach.laculturemouvement@gmail.com';
$telephone = '+33 6 00 00 00 00';
?>

<section id="localisation" class="home-section">
    <div class="container-localisation">
        <h2 class="section-title-map">Localisation</h2>

        <div class="map-wrapper">

            <div class="map-infos">

                <div class="map-info-block">
                    <span class="map-label">Adresse du local</span>
                    <address>
                        <?php echo esc_html( $adresse ); ?><br>
                        <?php echo esc_html( $cp_ville ); ?>
                    </address>
                </div>

                <div class="map-info-block">
                    <span class="map-label">Accès transport</span>
                    <ul class="map-transport">
                        <li><?php echo esc_html( $gare ); ?></li>
                        <li>Parking : <?php echo esc_html( $parking ); ?></li>
                    </ul>
                </div>

                <hr class="map-divider">

                <div class="map-info-block">
                    <span class="map-label">Contact</span>
                    <a href="mailto:<?php echo esc_attr( $email ); ?>" class="map-contact-email">
                        <?php echo esc_html( $email ); ?>
                    </a>
                    <a href="tel:<?php echo esc_attr( str_replace( ' ', '', $telephone ) ); ?>" class="map-contact-phone">
                        <?php echo esc_html( $telephone ); ?>
                    </a>
                </div>

            </div>

            <div class="map-container" id="leaflet-map"></div>

        </div>
    </div>
</section>
