<?php
/**
 * Composant Contact
 * @package culture_mouvement
 */
?>

<section id="contact" class="home-section contact-section">
    <div class="container">

        <!-- Titre -->
        <div class="contact-header">
            <span class="contact-label">— Contactez-Moi —</span>
            <h2 class="contact-title">Discutons de Votre Projet</h2>
            <div class="contact-divider"></div>
        </div>

        <div class="contact-grid">

            <!-- Colonne gauche : infos -->
            <div class="contact-infos">

                <h3 class="contact-infos-title">Informations de Contact</h3>

                <div class="contact-info-list">
                    <a id="contact-email-link" href="#" class="contact-info-item">
                        <div class="contact-info-icon">
                        </div>
                        <div>
                            <div class="contact-info-label">Email</div>
                            <div class="contact-info-value" id="contact-email-value"></div>
                        </div>
                    </a>

                    <a id="contact-tel-link" href="#" class="contact-info-item">
                        <div class="contact-info-icon">
                        </div>
                        <div>
                            <div class="contact-info-label">Téléphone</div>
                            <div class="contact-info-value" id="contact-tel-value"></div>
                        </div>
                    </a>

                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                        </div>
                        <div>
                            <div class="contact-info-label">Localisation</div>
                            <div class="contact-info-value" id="contact-ville-value"></div>
                        </div>
                    </div>
                </div>

                <!-- Réseaux sociaux -->
                <div class="contact-social">
                    <h4 class="contact-social-title">Suivez-Nous</h4>
                    <div class="contact-social-links" id="contact-social-links">
                        <!-- Rempli par JS -->
                    </div>
                </div>

            </div>

            <!-- Colonne droite : formulaire -->
            <div class="contact-form-wrapper">
                <form id="contact-form" class="contact-form" novalidate>

                    <div class="contact-field">
                        <label for="contact-name">Nom</label>
                        <input type="text" id="contact-name" name="name" placeholder="Votre nom" required>
                    </div>

                    <div class="contact-field">
                        <label for="contact-email">Email</label>
                        <input type="email" id="contact-email" name="email" placeholder="votre.email@example.com" required>
                    </div>

                    <div class="contact-field">
                        <label for="contact-subject">Sujet</label>
                        <input type="text" id="contact-subject" name="subject" placeholder="Sujet de votre message" required>
                    </div>

                    <div class="contact-field">
                        <label for="contact-message">Message</label>
                        <textarea id="contact-message" name="message" rows="6" maxlength="5000" placeholder="Parlez-nous de votre projet..." required></textarea>
                        <div class="contact-char-count"><span id="contact-char">0</span>/5000</div>
                    </div>

                    <!-- Feedback -->
                    <div id="contact-feedback" class="contact-feedback" style="display:none;"></div>

                    <button type="submit" id="contact-submit" class="contact-submit">
                        Envoyer le Message
                    </button>

                    <!-- Décoration -->
                    <div class="contact-deco">
                        <?php for ( $i = 0; $i < 12; $i++ ) : ?>
                            <div class="contact-deco-bar"></div>
                        <?php endfor; ?>
                    </div>

                </form>
            </div>

        </div>
    </div>
</section>