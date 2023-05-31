<?php
/*
Plugin Name: Categoria
Description: Plugin personalizado para cambiar el estilo del título
Version: 1.0
Author: Enrique Chavez Rosas
License: GPL2
*/

function cambiar_estilo_titulo($title, $post_id) {
    if (is_admin()) {
        return $title;
    }

    $categories = wp_get_post_categories($post_id);
    $category_id = !empty($categories) ? $categories[0] : 0;

    if ($category_id) {
        $category = get_category($category_id);
        $category_slug = $category->slug;

        $category_colors = array(
            'nacional' => array(
                'background' => '#00B049',
                'color' => '#FFFFFF',
            ),
            'entretenimiento' => array(
                'background' => '#FFC915',
                'color' => '#FFFFFF',
            ),
            'tecnologia' => array(
                'background' => '#00D3F8',
                'color' => '#FFFFFF',
            ),
            'mascotas' => array(
                'background' => '#90456D',
                'color' => '#FFFFFF',
            ),
            'deportes' => array(
                'background' => '#FF372C',
                'color' => '#FFFFFF',
            ),
        );

        if (array_key_exists($category_slug, $category_colors)) {
            $background = $category_colors[$category_slug]['background'];
            $color = $category_colors[$category_slug]['color'];

            $title = '<span style="background: ' . $background . '; color: ' . $color . ';">' . $title . '</span>';
        }
    }

    return $title;
}

add_filter('the_title', 'cambiar_estilo_titulo', 10, 2);

?>