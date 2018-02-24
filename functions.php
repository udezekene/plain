<?php
/*
 *  Author: Kene Udeze | @udezekene
 *  URL: http://udezekene.com/plain
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    //add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('plain', get_template_directory() . '/languages');

}

/*------------------------------------*\
	Functions
\*------------------------------------*/


// Load Plain Scripts (header.php)
function plain_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        wp_register_script('fontawesome', 'https://use.fontawesome.com/releases/v5.0.2/js/all.js', array(), '4.0'); // fontawesome
        wp_enqueue_script('fontawesome'); // Enqueue it!

    }
}


// Load Plain styles
function plain_styles()
{
    wp_register_style('reboot', get_template_directory_uri() . '/css/bootstrap-reboot.min', array(), '1.0', 'all');
    wp_enqueue_style('reboot'); // Enqueue it!

    wp_register_style('plain-style', get_template_directory_uri() . '/css/style.css', array(), '1.0', 'all');
    wp_enqueue_style('plain-style'); // Enqueue it!
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}


// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more)
{
    global $post;
    return '...';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function plaingravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function plaincomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
    	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment ); ?>
    	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
        <div class="comment-meta commentmetadata">
            <?php printf( __('%1$s'), get_comment_date()) ?>
            
            <?php edit_comment_link(__('(Edit)'),'  ','' ); ?>
        </div>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>



	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }


function plain_featured_image($size = 'full') {
    if (has_post_thumbnail()) {
        $image_id = get_post_thumbnail_id();
        $image_url = wp_get_attachment_image_src($image_id, $size);
        $image_url = $image_url[0];
    } else {
        global $post, $posts;
        $image_url = '';
        ob_start();
        ob_end_clean();

        if ($output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', do_shortcode($post->post_content), $matches)){
           $image_url = $matches [1] [0];
        }
        
        //Defines a default image
        if(empty($image_url)){
            $image_url = false;
        }
    }
    return $image_url;
}




/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'plain_header_scripts'); // Add Custom Scripts to wp_head
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'plain_styles'); // Add Theme Stylesheet
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination
add_action('after_setup_theme', 'add_theme_support'); // Add theme support for customizer

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'plaingravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

/*------------------------------------*\
	Custom Functions
\*------------------------------------*/

function plain_get_f_image_url($size = 'thumbnail'){
    $thumb_id = get_post_thumbnail_id();
    $thumb_url_array = wp_get_attachment_image_src($thumb_id, $size, true);
    $thumb_url = $thumb_url_array[0];
    return $thumb_url;
}

// Compression

class WP_HTML_Compression
{
    // Settings
    protected $compress_css = true;
    protected $compress_js = true;
    protected $info_comment = true;
    protected $remove_comments = true;

    // Variables
    protected $html;
    public function __construct($html)
    {
     if (!empty($html))
     {
         $this->parseHTML($html);
     }
    }
    public function __toString()
    {
     return $this->html;
    }
    protected function bottomComment($raw, $compressed)
    {
     $raw = strlen($raw);
     $compressed = strlen($compressed);
     
     $savings = ($raw-$compressed) / $raw * 100;
     
     $savings = round($savings, 2);
     
     return '<!--HTML compressed, size saved '.$savings.'%. From '.$raw.' bytes, now '.$compressed.' bytes-->';
    }
    protected function minifyHTML($html)
    {
     $pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
     preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
     $overriding = false;
     $raw_tag = false;
     // Variable reused for output
     $html = '';
     foreach ($matches as $token)
     {
         $tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
         
         $content = $token[0];
         
         if (is_null($tag))
         {
             if ( !empty($token['script']) )
             {
                 $strip = $this->compress_js;
             }
             else if ( !empty($token['style']) )
             {
                 $strip = $this->compress_css;
             }
             else if ($content == '<!--wp-html-compression no compression-->')
             {
                 $overriding = !$overriding;
                 
                 // Don't print the comment
                 continue;
             }
             else if ($this->remove_comments)
             {
                 if (!$overriding && $raw_tag != 'textarea')
                 {
                     // Remove any HTML comments, except MSIE conditional comments
                     $content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
                 }
             }
         }
         else
         {
             if ($tag == 'pre' || $tag == 'textarea')
             {
                 $raw_tag = $tag;
             }
             else if ($tag == '/pre' || $tag == '/textarea')
             {
                 $raw_tag = false;
             }
             else
             {
                 if ($raw_tag || $overriding)
                 {
                     $strip = false;
                 }
                 else
                 {
                     $strip = true;
                     
                     // Remove any empty attributes, except:
                     // action, alt, content, src
                     $content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);
                     
                     // Remove any space before the end of self-closing XHTML tags
                     // JavaScript excluded
                     $content = str_replace(' />', '/>', $content);
                 }
             }
         }
         
         if ($strip)
         {
             $content = $this->removeWhiteSpace($content);
         }
         
         $html .= $content;
     }
     
     return $html;
    }
     
    public function parseHTML($html)
    {
     $this->html = $this->minifyHTML($html);
     
     if ($this->info_comment)
     {
         $this->html .= "\n" . $this->bottomComment($html, $this->html);
     }
    }
    
    protected function removeWhiteSpace($str)
    {
     $str = str_replace("\t", ' ', $str);
     $str = str_replace("\n",  '', $str);
     $str = str_replace("\r",  '', $str);
     
     while (stristr($str, '  '))
     {
         $str = str_replace('  ', ' ', $str);
     }
     
     return $str;
    }
}

function wp_html_compression_finish($html)
{
    return new WP_HTML_Compression($html);
}

function wp_html_compression_start()
{
    ob_start('wp_html_compression_finish');
}
add_action('get_header', 'wp_html_compression_start');

       
//** DEFER THE LOADING OF SOME JS FILES SO AS TO IMPROVE LOAD SPEEED */    

/*function to add async to all scripts*/
function js_async_attr($tag){

# Do not add async to these scripts
$scripts_to_exclude = array('ubermenu.min.js', 'analytics.js', 'script-name3.js');
 
foreach($scripts_to_exclude as $exclude_script){
    if(true == strpos($tag, $exclude_script ) )
    return $tag;    
}

# Add async to all remaining scripts
return str_replace( ' src', ' async="async" src', $tag );
}
add_filter( 'script_loader_tag', 'js_async_attr', 10 );

// Remove WP Version From Styles    
add_filter( 'style_loader_src', 'sdt_remove_ver_css_js', 9999 );
// Remove WP Version From Scripts
add_filter( 'script_loader_src', 'sdt_remove_ver_css_js', 9999 );

// Function to remove version numbers
function sdt_remove_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}


/**
 * Modify the comment date of the current comment.
 *
 * @param string          $d          Optional. The format of the date. Default user's setting.
 * @param int|WP_Comment  $comment_ID WP_Comment or ID of the comment for which to get the date.
 *                                    Default current comment.
 * @return string The comment's date.
 */
function pressfore_comment_time_output($date, $d, $comment){
    return sprintf( _x( '%s ago', '%s = human-readable time difference', 'your-text-domain' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) );
}
add_filter('get_comment_date', 'pressfore_comment_time_output', 10, 3);


//Remove Author link from the URL 
add_filter( 'get_comment_author_link', 'remove_html_link_tag_from_comment_author_link' );

function remove_html_link_tag_from_comment_author_link ( $link ) {
    if( !in_the_loop() ) $link = preg_replace('/<a href=[\",\'](.*?)[\",\']>(.*?)<\/a>/', "\\2", $link);
    return $link;
}

// Remove URL from the box.

add_filter('comment_form_default_fields', 'website_remove');

function website_remove($fields) {
    if(isset($fields['url']))
    unset($fields['url']);
    return $fields;
}



/*
 * Change the comment reply link to use 'Reply to &lt;Author First Name'
 */

function add_comment_author_to_reply_link($link, $args, $comment){

    $comment = get_comment( $comment );

    // If no comment author is blank, use 'Anonymous'
    if ( empty($comment->comment_author) ) {
        if (!empty($comment->user_id)){
            $user=get_userdata($comment->user_id);
            $author=$user->user_login;
        } else {
            $author = __('Anonymous');
        }
    } else {
        $author = $comment->comment_author;
    }

    // If the user provided more than a first name, use only first name
    if(strpos($author, ' ')){
        $author = substr($author, 0, strpos($author, ' '));
    }

    // Replace Reply Link with "Reply to &lt;Author First Name>"
    $reply_link_text = $args['reply_text'];
    $link = str_replace($reply_link_text, 'Reply to ' . $author, $link);

    return $link;
}
add_filter('comment_reply_link', 'add_comment_author_to_reply_link', 10, 3);

/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

/**
 * Include the Customizer.
 */

require get_template_directory() . '/inc/customizer.php';


// Pagination

function plain_paging_nav() {
    // Don't print empty markup if there's only one page.
    if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
        return;
    }

    $paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
    $pagenum_link = html_entity_decode( get_pagenum_link() );
    $query_args   = array();
    $url_parts    = explode( '?', $pagenum_link );

    if ( isset( $url_parts[1] ) ) {
        wp_parse_str( $url_parts[1], $query_args );
    }

    $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
    $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

    $format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
    $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

    // Set up paginated links.
    $links = paginate_links( array(
        'base'     => $pagenum_link,
        'format'   => $format,
        'total'    => $GLOBALS['wp_query']->max_num_pages,
        'current'  => $paged,
        'mid_size' => 3,
        'add_args' => array_map( 'urlencode', $query_args ),
        'prev_text' => __( '&larr; Previous', 'plain' ),
        'next_text' => __( 'Next &rarr;', 'plain' ),
        'type'      => 'list',
    ) );

    return $links;
}



?>