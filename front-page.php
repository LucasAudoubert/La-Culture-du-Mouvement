<?php
/**
 * La page d'accueil personnalisée (One Page) - Version épurée
 * @package culture_mouvement
 */

get_header(); ?>

<main id="primary" class="site-main">

    <section id="hero" class="home-section">
        <div class="container">
            <h1>Bienvenue chez Culture Mouvement</h1>
        </div>
    </section>

    <section id="programme" class="home-section">
        <div class="container">
            <h2>Notre Programme</h2>
            <div class="section-content">
                <?php /* Ton contenu ici */ ?>
            </div>
        </div>
    </section>

    <?php get_template_part( 'template-parts/components/map');?>
    <?php get_template_part( 'template-parts/components/contact');?>

    <section id="a-propos" class="home-section">
        <div class="container">
            <h2>À propos</h2>
            <div class="section-content">
                <?php /* Ton contenu ici */ ?>
            </div>
        </div>
    </section>

    <section id="avis" class="home-section">
        <div class="container">
            <h2>Avis de nos membres</h2>
            <div class="reviews-grid">
                <blockquote>"Super expérience !" - Jean D.</blockquote>
                <blockquote>"Des profs géniaux." - Sarah L.</blockquote>
            </div>
        </div>
    </section>

    <section id="faq" class="home-section">
        <div class="container">
            <h2>F.A.Q</h2>
            <div class="faq-list">
                <details>
                    <summary>Comment s'inscrire ?</summary>
                    <p>Via notre formulaire de contact ou directement sur place.</p>
                </details>
                <details>
                    <summary>Quels sont les tarifs ?</summary>
                    <p>Nous proposons plusieurs formules adaptées à vos besoins.</p>
                </details>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();