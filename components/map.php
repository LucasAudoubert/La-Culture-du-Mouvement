<?php

/**
 * Composant Localisation - OpenStreetMap via Leaflet.js
 * @package culture_mouvement
 */
?>

<section id="localisation" class="home-section">
    <div class="container-localisation">
        <h2 class="section-title-map">Où se déroulent les séances ?</h2>

        <div class="map-wrapper">

            <div class="map-infos">

                <div class="map-info-block">
                    <span class="map-label">Adresse du local</span>
                    <address id="map-adresse">
                    </address>
                </div>

                <div class="map-info-block">
                    <span class="map-label">Accès transport</span>
                    <ul class="map-transport">
                        <li>
                            <span class="map-icon">🚆</span>
                            <span id="map-gare"></span>
                        </li>
                        <li>
                            <span class="map-icon">🅿️</span>
                            Parking : <span id="map-parking"></span>
                        </li>
                    </ul>
                </div>

                <hr class="map-divider">

                <div class="map-info-block">
                    <span class="map-label">Contact</span>
                    <a id="map-email" href="#" class="map-contact-email"></a>
                    <a id="map-telephone" href="#" class="map-contact-phone"></a>
                </div>

            </div>

            <div class="map-container" id="leaflet-map"></div>

        </div>
    </div>
</section>