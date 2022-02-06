<?php
/*-----------------------------------------------------------------------------------*/
/* Enqueue css files to tweak zuki styles
/*-----------------------------------------------------------------------------------*/
add_action('wp_enqueue_scripts', 'zuki_child_theme_enqueue_styles');

function zuki_child_theme_enqueue_styles()
{
    wp_enqueue_style('zuki-style', get_template_directory_uri() . '/style.css', array(), '20140630');
    wp_enqueue_style('child-style', get_stylesheet_uri(),
      array('zuki-style'),
      '20201118'
    );
}


/*-----------------------------------------------------------------------------------*/
/* Function is intendend to overwrite custom_excerpt_length in parent theme.
/*-----------------------------------------------------------------------------------*/
add_filter('excerpt_length', 'custom_excerpt_length_child', 1000);

function custom_excerpt_length_child($length)
{
    return 20;
}

/*-----------------------------------------------------------------------------------*/
/* Create a new sidebar for single pages
/*-----------------------------------------------------------------------------------*/
add_action('widgets_init', 'custom_widgets_init');

function custom_widgets_init()
{
    register_sidebar(array(
      'name' => __('Single page - Sidebar', 'zuki'),
      'id' => 'single-sidebar',
      'description' => __('Widgets appear in a right-aligned sidebar on single posts.', 'zuki'),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => "</aside>",
      'before_title' => '<h3 class="widget-title">',
      'after_title' => '</h3>',
    ));
}

/*-----------------------------------------------------------------------------------*/
/* Add a shortcode for showing custom taxonomies in sidebar widgets
/*-----------------------------------------------------------------------------------*/
add_shortcode('facetwp-display', 'register_facetwp_display_shortcode');

/**
 * Register shortcodes
 */
function register_facetwp_display_shortcode($atts)
{
    global $post;
    $output = '';
    if (isset($atts['facet'])) {
        $facet = get_the_term_list($post->ID, $atts['facet'], ' ', ', ', ' ');
        $title = $atts['title'];

        if ($facet) {
            if ($title) {
                $output .= '<h3 class="widget-title">' . $title . '</h3>';
            }
            $output .= '<div class="facetwp-facet">' . $facet . '</div>';
        }
    }
    return $output;
}

/*-----------------------------------------------------------------------------------*/
/* Filter to replace author with custom field guest-author (if present)
/*-----------------------------------------------------------------------------------*/
add_filter('the_author', 'guest_author_name');
add_filter('get_the_author_display_name', 'guest_author_name');

function guest_author_name($name)
{
    global $post;

    $author = get_post_meta($post->ID, 'guest-author', true);

    if ($author) {
        $name = $author;
    }
    return $name;
}

/*-----------------------------------------------------------------------------------*/
/* Override content navigation function from zuki theme
/*-----------------------------------------------------------------------------------*/
if (!function_exists('zuki_content_nav')) :
    function zuki_content_nav($nav_id)
    {
        global $wp_query;
        if ($wp_query->max_num_pages > 1) : ?>
					<div class="nav-wrap cf">
						<nav id="<?php echo $nav_id; ?>">
                <?php next_posts_link(__('<button class="nav-next"><span>Äldre artiklar</span></button>', 'zuki')); ?>
                <?php previous_posts_link(__('<button class="nav-previous"><span>Nyare artiklar</span></button>', 'zuki')); ?>
						</nav>
					</div><!-- end .nav-wrap -->
        <?php endif;
    }
endif; // zuki_content_nav

/*-----------------------------------------------------------------------------------*/
/* Filter to rewrite permalinks with custom taxonomy
/*-----------------------------------------------------------------------------------*/
add_filter('post_link', 'nummer_permalink', 10, 3);
function nummer_permalink($permalink, $post_id, $leavename)
{
    if (strpos($permalink, '%nummer%') === false) {
        return $permalink;
    }

    // Get post
    $post = get_post($post_id);
    if (!$post) {
        return $permalink;
    }

    // Get taxonomy terms
    $terms = wp_get_object_terms($post->ID, 'nummer');
    if (!is_wp_error($terms) && !empty($terms) && is_object($terms[0])) {
        $taxonomy_slug = $terms[0]->slug;
    } else {
        $taxonomy_slug = 'saknar-nummer';
    }

    return str_replace('%nummer%', $taxonomy_slug, $permalink);
}


add_filter( 'document_title_parts', function( $title_parts_array ) {
    if (is_single()) {
        $terms = strip_tags(get_the_term_list($post->ID, 'artiklar', ' ', ' | ', ' '));
        $title_parts_array['title'] = $title_parts_array['title'].' – '.$terms;    
    }
    if (is_tax( 'forfattare' )) {
        $title_parts_array['title'] = 'Alla artiklar av '.$title_parts_array['title']; 
    }
    if (is_tax( 'artiklar' )) {
        $term = get_queried_object();
        $title_parts_array['title'] = 'Alla '.get_field('plural', $term);
    }
    if (is_tax( 'nummer' )) {
        $title_parts_array['title'] = 'Alla artiklar i '.$title_parts_array['title'];
    }
    if (is_tax( 'amnen') || is_tax( 'museer' ) || is_tax( 'platser' ) || is_tax( 'lander' ) || is_tax( 'utstallningar' )) {
        $title_parts_array['title'] = 'Allt om '.$title_parts_array['title'];
    }
    return $title_parts_array;
} );


/*-----------------------------------------------------------------------------------*/
/* Filter to remove empty rules to avoid 404s on pages
/*-----------------------------------------------------------------------------------*/
add_filter('rewrite_rules_array', 'pages_remove_nummer_folder_rule');
function pages_remove_nummer_folder_rule($rules)
{
    unset($rules['([^/]+)/?$']);
    return $rules;
}


// Load translation files from your child theme instead of the parent theme
function my_child_theme_locale() {
    load_child_theme_textdomain( 'zuki', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'my_child_theme_locale' );
