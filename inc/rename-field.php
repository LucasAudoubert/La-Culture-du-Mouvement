<?php

function renommer_menu_posts($labels)
{
    $labels->name = 'Articles';
    $labels->singular_name = 'Article';
    $labels->menu_name = 'Articles';
    $labels->all_items = 'Tous les articles';
    $labels->add_new = 'Ajouter';
    $labels->add_new_item = 'Ajouter un article';
    $labels->edit_item = 'Modifier l\'article';
    $labels->new_item = 'Nouvel article';
    $labels->view_item = 'Voir l\'article';
    $labels->search_items = 'Rechercher';
    $labels->not_found = 'Aucun article trouvé';
    $labels->not_found_in_trash = 'Aucun article dans la corbeille';
    return $labels;
}
add_filter('post_type_labels_post', 'renommer_menu_posts');
