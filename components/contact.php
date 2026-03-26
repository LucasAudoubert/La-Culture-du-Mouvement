<?php
/**
 * Composant : Formulaire de contact et informations
 */
?>
<section class="contact-section">
    <div class="container-contact">
        <div class="contact-grid">

            <div class="contact-infos">
                <div class="contact-info-list">
                    <a href="mailto:coach.laculturemouvement@gmail.com" class="contact-info-item">
                        <div class="contact-info-icon">📧</div>
                        <div class="info-details">
                            <span class="contact-info-label">Email</span>
                            <span class="contact-info-value">coach.laculturemouvement@gmail.com</span>
                        </div>
                    </a>

                    <a href="tel:+33600000000" class="contact-info-item">
                        <div class="contact-info-icon">📞</div>
                        <div class="info-details">
                            <span class="contact-info-label">Téléphone</span>
                            <span class="contact-info-value">+33 6 00 00 00 00</span>
                        </div>
                    </a>

                    <div class="contact-info-item">
                        <div class="contact-info-icon">📍</div>
                        <div class="info-details">
                            <span class="contact-info-label">Localisation</span>
                            <span class="contact-info-value">Nanterre, 92000</span>
                        </div>
                    </div>
                </div>

                <div class="contact-social">
                    <h4 class="contact-social-title">Suivez-Nous</h4>
                    <div class="contact-social-links">
                        <a href="#" class="contact-social-btn" aria-label="Instagram">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                        </a>
                        <a href="#" class="contact-social-btn" aria-label="LinkedIn">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                <rect x="2" y="9" width="4" height="12"></rect>
                                <circle cx="4" cy="4" r="2"></circle>
                            </svg>
                        </a>
                        <a href="#" class="contact-social-btn" aria-label="X">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4l11.733 16h4.267l-11.733 -16z"></path>
                                <path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="contact-form-wrapper">
                <form id="contact-form" class="contact-form" novalidate>

                    <div class="contact-field">
                        <label for="contact-name">Nom *</label>
                        <input type="text" id="contact-name" name="name" placeholder="Votre nom" required>
                    </div>

                    <div class="contact-field">
                        <label for="contact-email">Email *</label>
                        <input type="email" id="contact-email" name="email" placeholder="votre.email@example.com" required>
                    </div>
                    
                    <div class="contact-field">
                        <label for="contact-datetime">Date et heure souhaité</label>
                        <input type="datetime-local" id="contact-datetime" name="datetime">
                    </div>

                    <div class="contact-field">
                        <label for="contact-message">
                            Message *
                            <span style="font-weight:normal;font-size:0.85em;float:right;">
                                <span id="contact-char">0</span> caractères
                            </span>
                        </label>
                        <textarea id="contact-message" name="message" rows="6" placeholder="Parlez-nous de votre projet..." required></textarea>
                    </div>

                    <button type="submit" class="contact-submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m22 2-7 20-4-9-9-4Z"/>
                            <path d="M22 2 11 13"/>
                        </svg>
                        Envoyer le Message
                    </button>

                </form>
            </div>

        </div>
    </div>
</section>