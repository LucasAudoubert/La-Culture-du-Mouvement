<?php

/**
 * Composant Onglets : Contact / Calendrier
 */
?>
<section class="tabs-section">
    <div class="container-tabs">
        <div class="tabs-nav">
            <button class="tab-btn active" data-target="tab-contact">CONTACT</button>
            <button class="tab-btn" data-target="tab-calendar">PLANNING</button>
        </div>

        <div class="tabs-content">
            <div id="tab-contact" class="tab-pane active">
                <?php get_template_part('components/contact'); ?>
            </div>

            <div id="tab-calendar" class="tab-pane">
                <div class="calendar-wrapper-tab">
                    <?php get_template_part('components/calendar'); ?>
                </div>
            </div>
        </div>
    </div>
</section>