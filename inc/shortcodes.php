<?php
// Shortcode Bouton Hexfit
function bouton_reservation_hexfit()
{
    $lien_reservation = 'https://app.myhexfit.com/#/public-appointment?secret=816d7206-3d79-4f5a-a655-57caebaf8354';
    return '<div style="text-align:center; margin: 30px 0;"><a href="' . $lien_reservation . '" target="_blank" style="background-color:#000; color:white; padding:15px 30px; text-decoration:none; border-radius:8px; font-weight:bold; font-family:sans-serif; display:inline-block;">RÉSERVER UNE SÉANCE</a></div>';
}
add_shortcode('bouton_hexfit', 'bouton_reservation_hexfit');

// Shortcode Calendrier
function afficher_dashboard_calendrier_hexfit()
{
    ob_start(); ?>
    <div class="planning-wrapper">
        <div class="planning-header">
            <h1>Planning Global</h1>
        </div>
        <div class="main-content">
            <div id="calendar-design"></div>
        </div>
    </div>
<?php return ob_get_clean();
}
add_shortcode('calendrier_dashboard', 'afficher_dashboard_calendrier_hexfit');
