<?php
/**
 * Twenty Eleven functions and definitions
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Vestride
 * @since Vestride 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 980;

/**
 * Tell WordPress to run vestride_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'vestride_setup' );

if ( ! function_exists( 'vestride_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override vestride_setup() in a child theme, add your own vestride_setup to your child theme's
 * functions.php file.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To style the visual editor.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links, and Post Formats.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Eleven 1.0
 */
function vestride_setup() {
	load_theme_textdomain( 'vestride', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
            require_once( $locale_file );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Load up our theme options page and related code.
	require( dirname( __FILE__ ) . '/inc/theme-options.php' );

	// Grab Twenty Eleven's Ephemera widget.
	//require( dirname( __FILE__ ) . '/inc/widgets.php' );

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	//register_nav_menu( 'primary', __( 'Primary Menu', 'vestride' ) );

	// Add support for a variety of post formats
	add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	add_theme_support( 'post-thumbnails' );
	
}
endif; // vestride_setup


// CUSTOM ADMIN LOGIN HEADER LOGO  

function my_custom_login_logo() {
    echo '
    <style> 
        h1 a {
            background-image:url(' . get_bloginfo('template_directory') . '/img/logo.png) !important;
            height: 159px !important;
            width: auto;
        }    
    </style>';
}

add_action('login_head', 'my_custom_login_logo');

/**
 * Sets the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function vestride_excerpt_length( $length ) {
    return 40;
}
add_filter( 'excerpt_length', 'vestride_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 */
function vestride_continue_reading_link() {
    return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'vestride' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and vestride_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function vestride_auto_excerpt_more( $more ) {
    return ' &hellip;' . vestride_continue_reading_link();
}
add_filter( 'excerpt_more', 'vestride_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function vestride_custom_excerpt_more($output) {
    if (has_excerpt() && !is_attachment()) {
        $output .= vestride_continue_reading_link();
    }
    return $output;
}
add_filter( 'get_the_excerpt', 'vestride_custom_excerpt_more' );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function vestride_page_menu_args($args) {
    $args['show_home'] = true;
    return $args;
}
add_filter( 'wp_page_menu_args', 'vestride_page_menu_args' );


/**
 * Display navigation to next/previous pages when applicable
 */
function vestride_content_nav( $nav_id ) {
    global $wp_query;

    if ( $wp_query->max_num_pages > 1 ) : ?>
        <nav id="<?php echo $nav_id; ?>">
            <h3 class="ir"><?php _e( 'Post navigation', 'vestride' ); ?></h3>
            <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'vestride' ) ); ?></div>
            <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'vestride' ) ); ?></div>
        </nav><!-- #nav-above -->
    <?php endif;
}

function vestride_nav_single() {
    ?>
    <nav id="nav-single" class="clearfix">
        <h3 class="ir"><?php _e('Post navigation', 'vestride'); ?></h3>
        <span class="nav-next rfloat"><?php next_post_link('%link'); ?></span>
        <span class="nav-previous"><?php previous_post_link('%link'); ?></span>
    </nav><!-- #nav-single -->
<?php
}

/**
 * Return the URL for the first link found in the post content.
 *
 * @since Twenty Eleven 1.0
 * @return string|bool URL or false when no link is present.
 */
function vestride_url_grabber() {
    if (!preg_match('/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches))
        return false;

    return esc_url_raw($matches[1]);
}

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 */
function vestride_footer_sidebar_class() {
    $count = 0;

    if (is_active_sidebar('sidebar-3'))
        $count++;

    if (is_active_sidebar('sidebar-4'))
        $count++;

    if (is_active_sidebar('sidebar-5'))
        $count++;

    $class = '';

    switch ($count) {
        case '1':
            $class = 'one';
            break;
        case '2':
            $class = 'two';
            break;
        case '3':
            $class = 'three';
            break;
    }

    if ($class)
        echo 'class="' . $class . '"';
}

if ( ! function_exists( 'vestride_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own vestride_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Eleven 1.0
 */
function vestride_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    switch ($comment->comment_type) :
        case 'pingback' :
        case 'trackback' :
    ?>
    <li class="post pingback">
        <p><?php _e( 'Pingback:', 'vestride' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'vestride' ), '<span class="edit-link">', '</span>' ); ?></p>
    <?php
            break;
        default :
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment">
            <div class="comment-meta">
                <div class="comment-author vcard">
                    <?php
                        $avatar_size = 68;
                        if ( '0' != $comment->comment_parent )
                            $avatar_size = 39;

                        echo get_avatar( $comment, $avatar_size );

                        /* translators: 1: comment author, 2: date and time */
                        printf( __( '%1$s on %2$s <span class="says">said:</span>', 'vestride' ),
                                sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
                                sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
                                        esc_url( get_comment_link( $comment->comment_ID ) ),
                                        get_comment_time( 'c' ),
                                        /* translators: 1: date, 2: time */
                                        sprintf( __( '%1$s at %2$s', 'vestride' ), get_comment_date(), get_comment_time() )
                                )
                        );
                    ?>

                    <?php edit_comment_link( __( 'Edit', 'vestride' ), '<span class="edit-link">', '</span>' ); ?>
                </div><!-- .comment-author .vcard -->

                <?php if ( $comment->comment_approved == '0' ) : ?>
                    <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'vestride' ); ?></em>
                    <br />
                <?php endif; ?>

            </div>

            <div class="comment-content"><?php comment_text(); ?></div>

            <div class="reply">
                <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'vestride' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div><!-- .reply -->
        </article><!-- #comment-## -->

	<?php
            break;
    endswitch;
}
endif; // ends check for vestride_comment()

if ( ! function_exists( 'vestride_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own vestride_posted_on to override in a child theme
 *
 * @since Twenty Eleven 1.0
 */
function vestride_posted_on() {
    printf( __( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a>', 'vestride' ),
        esc_url( get_permalink() ),
        esc_attr( get_the_time() ),
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() ),
        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
        sprintf( esc_attr__( 'View all posts by %s', 'vestride' ), get_the_author() ),
        esc_html( get_the_author() )
    );
}
endif;

/**
 * Adds two classes to the array of body classes.
 * The first is if the site has only had one author with published posts.
 * The second is if a singular post being displayed
 *
 * @since Twenty Eleven 1.0
 */
function vestride_body_classes($classes) {
    if (!is_multi_author()) {
        $classes[] = 'single-author';
    }

    if (is_singular() && !is_home() && !is_page_template('showcase.php') && !is_page_template('sidebar-page.php'))
        $classes[] = 'singular';

    return $classes;
}
add_filter( 'body_class', 'vestride_body_classes' );


function create_project_post_type() {
    $labels = array(
        'name' => __('Projects'),
        'singular_name' => __('Project'),
        'menu_name' => __('Projects'),
        'add_new' => __('Add New'),
        'add_new_item' => __('Add New Project'),
        'edit' => __('Edit'),
        'edit_item' => __('Edit Project'),
        'new_item' => __('New Project'),
        'view' => __('View Project'),
        'view_item' => __('View Project'),
        'search_items' => __('Search Projects'),
        'not_found' => __('No projects found'),
        'not_found_in_trash' => __('No projects found in Trash'),
        'parent' => __('Parent Project')
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 6,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'taxonomies' => array('type', 'post_tag')
    );
    register_post_type('project', $args);
}
add_action('init', 'create_project_post_type');

add_filter('pre_get_posts', 'query_post_type');
function query_post_type($query) {
  if(is_category() || is_tag()) {
    $post_type = get_query_var('post_type');
	if(!$post_type)
	    $post_type = array('post','project'); // replace cpt to your custom post type
    $query->set('post_type',$post_type);
	return $query;
    }
}

function vestride_icons() {
                ?>
        <style type="text/css" media="screen">
            #menu-posts-project .wp-menu-image {
                background: url('<?php bloginfo('template_url'); ?>/img/television.png') no-repeat 6px -17px !important;
                opacity: 0.6;
            }
            #menu-posts-project:hover .wp-menu-image,
            #menu-posts-project.wp-has-current-submenu .wp-menu-image {
                background-position: 6px 7px !important;
                opacity: 1.0;
            }
        </style>
<?php
}
add_action('admin_head', 'vestride_icons');

function create_project_taxonomies() {
    
    // Type taxonomy
    $labels = array(
        'name' => _x('Types', 'taxonomy general name'),
        'singular_name' => _x('Type', 'taxonomy singular name'),
        'search_items' => __('Search Types'),
        'all_items' => __('All Type'),
        'edit_item' => __('Edit Type'),
        'update_item' => __('Update Type'),
        'add_new_item' => __('Add New Type'),
        'new_item_name' => __('New Type Name'),
        'menu_name' => __('Types'),
    );

    register_taxonomy('type', array('project'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'type'),
    ));
}
add_action('init', 'create_project_taxonomies', 0);

function add_project_columns($columns) {
    return array(
        'cb' => '<input type="checkbox" />',
        'title' => __('Title'),
        'featured' => __('Featured'),
        'types' => __('Types'),
        'tags' => __('Tags'),
        'date' => __('Date')
    );
}
add_filter('manage_project_posts_columns' , 'add_project_columns');

add_action('manage_posts_custom_column', 'custom_columns', 10, 2);
function custom_columns($column, $post_id) {
    switch ($column) {
        case 'types':
            $terms = get_the_term_list($post_id, 'type', '', ', ', '');
            if (is_string($terms)) {
                echo $terms;
            } else {
                echo 'Unable to get work type(s)';
            }
            break;
        case 'featured':
            echo get_post_meta($post_id, 'featured', true) == 'featured' ? 'Yes' : 'No';
            break;
        case 'position':
            echo get_post_meta($post_id, 'position', true);
            break;
    }
}

function project_init() {
    add_meta_box("year_completed_meta", "Year Completed", "year_completed", "project", "side", "low");
    add_meta_box("credits_meta", "Additional Info", "add_info_meta", "project", "normal", "low");
}
add_action("admin_init", "project_init");

function year_completed() {
    global $post;
    $custom = get_post_custom($post->ID);
    $year_completed = $custom["year_completed"][0];
    ?>
        <label>Year:</label>
        <input name="year_completed" value="<?php echo $year_completed; ?>" />
    <?php
}

function add_info_meta() {
    global $post;
    $custom = get_post_custom($post->ID);
    $featured = $custom["featured"][0];
    $video = $custom["video"][0];
    $external = $custom["external"][0];
    /*$programs = $custom["programs"][0];
    $programs = maybe_unserialize($programs);
    if (empty($programs)) {
        $programs = array();
    }
    $programs = array_flip($programs);
    */
    ?>
        <p>
            <strong>Use in featured projects</strong>
            <br />
            <label>
                <input type="checkbox" name="featured" value="featured" <? echo $featured === 'featured' ? 'checked' : ''; ?> />
                Featured
            </label>
            
        </p>
        <p>
            <label for="external_meta"><strong>External Link:</strong></label>
            <br />
            <input id="external_meta" name="external" value="<?php echo $external; ?>" placeholder="http://www.example.com" style="width:300px;" />
        </p>
        <p>
            <label for="video_meta"><strong>Video embed code:</strong></label>
            <br />
            <em>The video should be embedded with a width of 980 pixels.</em>
            <br />
            <textarea id="video_meta" name="video" style="width:400px;height:100px;"><?php echo $video; ?></textarea>
        </p>
        <?php /*
        <p>
            <strong>Programs used:</strong>
            <br />
            <label>
                <input type="checkbox" name="programs[]" value="photoshop" <?php echo array_key_exists('photoshop', $programs) ? 'checked' : ''; ?> />
                Photoshop
            </label>
            <br />
            <label>
                <input type="checkbox" name="programs[]" value="illustrator" <?php echo array_key_exists('illustrator', $programs) ? 'checked' : ''; ?> />
                Illustrator
            </label>
            <br />
            <label>
                <input type="checkbox" name="programs[]" value="cinema4d" <?php echo array_key_exists('cinema4d', $programs) ? 'checked' : ''; ?> />
                Cinema4D
            </label>
            <br />
            <label>
                <input type="checkbox" name="programs[]" value="aftereffects" <?php echo array_key_exists('aftereffects', $programs) ? 'checked' : ''; ?> />
                After Effects
            </label>
            
        </p>
        */
}



function save_details($post_id) {
    $post = get_post($post_id);
    if (!wp_is_post_revision($post_id)) {
        if ($post->post_type === 'project') {
            update_post_meta($post_id, "year_completed", $_POST["year_completed"]);
            update_post_meta($post_id, "featured", $_POST["featured"]);
            update_post_meta($post_id, "video", esc_html($_POST["video"]));
            update_post_meta($post_id, "external", $_POST["external"]);
            //update_post_meta($post_id, "programs", $_POST["programs"]);
        }
    }
}
add_action('save_post', 'save_details');

/**
 *
 * @param int $posts_per_page number of posts to get. Default = null
 * @param string $img_size size of the thumbnail. Default = 'work-thumb'
 * @param bool $onlyFeatured only retrieve projects that are 'featured'. Default = false.
 */
function vestride_get_project_posts($posts_per_page = null, $img_size = 'work-thumb', $onlyFeatured = false) {
    if (is_null($posts_per_page)) {
        $posts_per_page = -1;
    }
    $args = array(
        'post_type' => 'project',
        'numberposts' => $posts_per_page
    );
    
    if ($onlyFeatured) {
        $args['meta_key'] = 'featured';
        $args['meta_value'] = 'featured';
    }
    
    $projects = get_posts($args);
    
    
    foreach ($projects as &$project) {
        $terms = get_the_terms($project->ID, 'type');
        $term_names = array();
        $term_slugs = array();
        foreach ($terms as $term) {
            $term_names[] = $term->name;
            $term_slugs[] = $term->slug;
        }

        $project->terms = $term_names;
        $project->term_slugs = $term_slugs;
        $project->img = get_the_post_thumbnail($project->ID, $img_size);
        $project->permalink = get_permalink($project->ID);
    }
    unset($project);
    return $projects;
}

function vestride_get_featured_project_posts() {
    return vestride_get_project_posts(null, 'featured', true);
}


function get_the_categories($delimiter = ' ', $post_id = false) {
    $thelist = '';
    $categories = get_the_category($post_id);
    for ($i = 0; $i < count($categories); $i++) {
        if ($i != 0) {
            $thelist .= $delimiter;
        }
        $thelist .= $categories[$i]->cat_name;
    }
    return $thelist;
}

function vestride_header($page = 'home') {
    
    ?>
            <header>
                <nav id="nav" role="navigation">
                    <div class="nav-inside clearfix">
                        <div class="logo"><a href="<?php bloginfo('url'); ?>"><img src="<?= get_template_directory_uri(); ?>/img/logo.svg" alt="logo" width="20" /><strong>Glen</strong> <span class="main-color">Cheney</span></a></div>
                        <ul>
                            <li><?= vestride_header_link('Home', '#main', 'home', $page) ?></li>
                            <li><?= vestride_header_link('About', '#about', 'about', $page); ?></li>
                            <li><?= vestride_header_link('Work', '#work', 'work', $page); ?></li>
                            <li><?= vestride_header_link('Contact', '#contact', 'contact', $page); ?></li>
                        <li><a href="<?php bloginfo('url'); ?>/blog"<?php echo $page == 'blog' ? ' class="in"' : ''; ?> id="a-blog">Blog</a></li>
                        </ul>
                    </div>
                    <div class="nav-view">
                        <div class="sidebar-nav-button"><div class="sprite sprite-lines"></div></div>
                        <p class="nav-title"><?php wp_title('', true, 'right'); ?></p>
                    </div>
                </nav>
            </header>
<?
}

function vestride_header_link($title, $href, $id, $page = '') {
    $class = '';
    if ($id == $page) {
        $class = ' class="in"';
    }
    return "<a href=\"" . get_bloginfo('url') . "/$href\" id=\"a-$id\"$class>$title</a>";
}


function vestride_is_ajax() {
    return isset($_GET['ajax']);
}


function vestride_end() {
    ?></body>
    </html><?
}

add_image_size('work-promo', 640, 9999);
add_image_size('work-thumb', 9999, 221);
add_image_size('featured', 980, 9999);

/**
 *
 * Converts character to html entities (aka from < to &lt;)
 * replaces anything found in the $blacklist array with nothing
 * pads quotes with \
 * trims the string
 * @param $str string to sanitize
 * @param $convertQuotes bool [optional] makes quotes html entities instead of escaping them
 * @param $fwdSlashOk bool [optional] allow '/' in the string
 * @return string safe string
 */
function vestride_sanitize_string($str, $convertQuotes = true, $fwdSlashOk = false) {
    $blacklist = array("/`/", "/</", "/>/", "/%/", "/\\\/", "/\|/");
    if (!$fwdSlashOk) {
        $blacklist[] = "/\//";
    }
    $str = trim($str);
    if ($convertQuotes) {
        $str = htmlentities($str, ENT_QUOTES);
    } else {
        $str = htmlentities($str, ENT_NOQUOTES);
        $str = str_replace('"', '\"', $str);
        $str = str_replace("'", "\'", $str);
    }
    $str = preg_replace($blacklist, "", $str);
    return $str;
}

function vestride_validate_contact_form($message) {
    $errors = array();

    if (!empty($message->name)) {
        $errors[] = "The name field is hidden and should have been blank!";
    }

    if (empty($message->actual_name)) {
        $errors[] = "You must entera value for Name";
    }

    // Validate email address is not empty or invalid
    if (empty($message->email)) {
        $errors[] = "You have not entered an email address";
    } elseif (!filter_var($message->email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "You have not entered a valid email address";
    }

    if (empty($message->message)) {
        $errors[] = "Please enter a message.";
    }

    return $errors;
}

function vestride_send_contact_message($message) {
    $to = array(
        get_option('admin_email')
    );
    $headers = "From: {$message->email}" . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $emailbody = "<p>You have recieved a new message from the enquiries form on your website.</p>";

    $message->name = $message->actual_name;
    unset($message->actual_name);
    foreach ($message as $field => $value) {
        $emailbody .= "<p><strong>" . ucfirst($field) . ": </strong> " . nl2br($value) . "</p>";
    }

    $subject = $message->subject != '' ? $message->subject : 'New Inquiry at eighfoldstudios.com';

    $allGood = true;
    foreach ($to as $addr) {
        if (!mail($addr, $subject, $emailbody, $headers)) {
            $allGood = false;
        }
    }

    return $allGood;
}