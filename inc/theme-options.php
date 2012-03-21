<?php
add_action('admin_init', 'vestride_theme_options_init');
add_action('admin_menu', 'vestride_theme_options_add_page');

/**
 * Init plugin options to white list our options
 */
function vestride_theme_options_init() {
    // If we have no options in the database, let's add them now.
    if ( false === vestride_get_theme_options() )
        add_option( 'vestride_theme_options', vestride_get_default_theme_options() );
    
    register_setting(
        'vestride_options',
        'vestride_theme_options', 
        'vestride_theme_options_validate'
    );
}

/**
 * Load up the menu page
 */
function vestride_theme_options_add_page() {
    add_theme_page(
        __('Theme Options', 'vestride'),
        __('Theme Options', 'vestride'),
        'edit_theme_options',
        'theme_options',
        'vestride_theme_options_do_page'
    );
}

function vestride_get_default_theme_options() {
    return array(
        'featured' => 'no'
    );
}

function vestride_get_theme_options() {
    return get_option( 'vestride_theme_options', vestride_get_default_theme_options() );
}

/**
 * Create the options page
 */
function vestride_theme_options_do_page() {

    if (!isset($_REQUEST['settings-updated']))
        $_REQUEST['settings-updated'] = false;
    ?>
    <div class="wrap">
    <?php screen_icon();
    echo "<h2>" . get_current_theme() . __(' Theme Options', 'vestride') . "</h2>"; ?>

        <?php if (false !== $_REQUEST['settings-updated']) : ?>
            <div class="updated fade"><p><strong><?php _e('Options saved', 'vestride'); ?></strong></p></div>
        <?php endif; ?>

        <form method="post" action="options.php">
            <?php settings_fields('vestride_options'); ?>
            <?php $options = get_option('vestride_theme_options'); ?>
            
            <table class="form-table">
            
                <tr valign="top"><th scope="row"><?php _e('Google Analytics', 'jt'); ?></th>
                    <td>
                        <input id="jt_theme_options[ga]" name="jt_theme_options[ga]" type="text" value="<?php echo $options['ga']; ?>" placeholder="UA-XXXXX-X" />
                        <label class="description" for="jt_theme_options[ga]"></label>
                    </td>
                </tr>
                
            </table>
            
            <p><em><?php _e('Up to six social networks can be used at once.'); ?></em></p>
            <table class="form-table">
                
                <tr valign="top"><th scope="row"><?php _e('Twitter Username', 'vestride'); ?></th>
                    <td>
                        <input id="vestride_theme_options[twitter]" name="vestride_theme_options[twitter]" type="text" value="<?php echo $options['twitter']; ?>" />
                        <label class="description" for="vestride_theme_options[twitter]"></label>
                        <input id="vestride_theme_options[use_twitter]" name="vestride_theme_options[use_twitter]" type="checkbox" value="1" <?php checked('yes', $options['use_twitter']); ?> />
                        <label class="description" for="vestride_theme_options[use_twitter]"><?php _e('Use Twitter', 'vestride'); ?></label>
                    </td>
                </tr>
                
                <tr valign="top"><th scope="row"><?php _e('Facebook Username', 'vestride'); ?></th>
                    <td>
                        <input id="vestride_theme_options[facebook]" name="vestride_theme_options[facebook]" type="text" value="<?php echo $options['facebook']; ?>" />
                        <label class="description" for="vestride_theme_options[facebook]"></label>
                        <input id="vestride_theme_options[use_facebook]" name="vestride_theme_options[use_facebook]" type="checkbox" value="1" <?php checked('yes', $options['use_facebook']); ?> />
                        <label class="description" for="vestride_theme_options[use_facebook]"><?php _e('Use Facebook', 'vestride'); ?></label>
                    </td>
                </tr>
                
                <tr valign="top"><th scope="row"><?php _e('Vimeo Username', 'vestride'); ?></th>
                    <td>
                        <input id="vestride_theme_options[vimeo]" name="vestride_theme_options[vimeo]" type="text" value="<?php echo $options['vimeo']; ?>" />
                        <label class="description" for="vestride_theme_options[vimeo]"></label>
                        <input id="vestride_theme_options[use_vimeo]" name="vestride_theme_options[use_vimeo]" type="checkbox" value="1" <?php checked('yes', $options['use_vimeo']); ?> />
                        <label class="description" for="vestride_theme_options[use_vimeo]"><?php _e('Use Vimeo', 'vestride'); ?></label>
                    </td>
                </tr>
                
                <tr valign="top"><th scope="row"><?php _e('Dribbble Username', 'vestride'); ?></th>
                    <td>
                        <input id="vestride_theme_options[dribbble]" name="vestride_theme_options[dribbble]" type="text" value="<?php echo $options['dribbble']; ?>" />
                        <label class="description" for="vestride_theme_options[dribbble]"></label>
                        <input id="vestride_theme_options[use_dribbble]" name="vestride_theme_options[use_dribbble]" type="checkbox" value="1" <?php checked('yes', $options['use_dribbble']); ?> />
                        <label class="description" for="vestride_theme_options[use_dribbble]"><?php _e('Use Dribbble', 'vestride'); ?></label>
                    </td>
                </tr>
                
                <tr valign="top"><th scope="row"><?php _e('Flickr Username', 'vestride'); ?></th>
                    <td>
                        <input id="vestride_theme_options[flickr]" name="vestride_theme_options[flickr]" type="text" value="<?php echo $options['flickr']; ?>" />
                        <label class="description" for="vestride_theme_options[flickr]"></label>
                        <input id="vestride_theme_options[use_flickr]" name="vestride_theme_options[use_flickr]" type="checkbox" value="1" <?php checked('yes', $options['use_flickr']); ?> />
                        <label class="description" for="vestride_theme_options[use_flickr]"><?php _e('Use Flickr', 'vestride'); ?></label>
                    </td>
                </tr>
                
                <tr valign="top"><th scope="row"><?php _e('Google Plus Username', 'vestride'); ?></th>
                    <td>
                        <input id="vestride_theme_options[googleplus]" name="vestride_theme_options[googleplus]" type="text" value="<?php echo $options['googleplus']; ?>" />
                        <label class="description" for="vestride_theme_options[googleplus]"></label>
                        <input id="vestride_theme_options[use_googleplus]" name="vestride_theme_options[use_googleplus]" type="checkbox" value="1" <?php checked('yes', $options['use_googleplus']); ?> />
                        <label class="description" for="vestride_theme_options[use_googleplus]"><?php _e('Use Google+', 'vestride'); ?></label>
                    </td>
                </tr>
                
                <tr valign="top"><th scope="row"><?php _e('YouTube Username', 'vestride'); ?></th>
                    <td>
                        <input id="vestride_theme_options[youtube]" name="vestride_theme_options[youtube]" type="text" value="<?php echo $options['youtube']; ?>" />
                        <label class="description" for="vestride_theme_options[youtube]"></label>
                        <input id="vestride_theme_options[use_youtube]" name="vestride_theme_options[use_youtube]" type="checkbox" value="1" <?php checked('yes', $options['use_youtube']); ?> />
                        <label class="description" for="vestride_theme_options[use_youtube]"><?php _e('Use YouTube', 'vestride'); ?></label>
                    </td>
                </tr>
                
                <tr valign="top"><th scope="row"><?php _e('LinkedIn Username', 'vestride'); ?></th>
                    <td>
                        <input id="vestride_theme_options[linkedin]" name="vestride_theme_options[linkedin]" type="text" value="<?php echo $options['linkedin']; ?>" />
                        <label class="description" for="vestride_theme_options[linkedin]"></label>
                        <input id="vestride_theme_options[use_linkedin]" name="vestride_theme_options[use_linkedin]" type="checkbox" value="1" <?php checked('yes', $options['use_linkedin']); ?> />
                        <label class="description" for="vestride_theme_options[use_linkedin]"><?php _e('Use LinkedIn', 'vestride'); ?></label>
                    </td>
                </tr>
                
                <tr valign="top"><th scope="row"><?php _e('GitHub Username', 'vestride'); ?></th>
                    <td>
                        <input id="vestride_theme_options[github]" name="vestride_theme_options[github]" type="text" value="<?php echo $options['github']; ?>" />
                        <label class="description" for="vestride_theme_options[github]"></label>
                        <input id="vestride_theme_options[use_github]" name="vestride_theme_options[use_github]" type="checkbox" value="1" <?php checked('yes', $options['use_github']); ?> />
                        <label class="description" for="vestride_theme_options[use_github]"><?php _e('Use GitHub', 'vestride'); ?></label>
                    </td>
                </tr>
                
                <tr valign="top"><th scope="row"><?php _e('Xbox LIVE Gamertag', 'vestride'); ?></th>
                    <td>
                        <input id="vestride_theme_options[gamertag]" name="vestride_theme_options[gamertag]" type="text" value="<?php echo $options['gamertag']; ?>" />
                        <label class="description" for="vestride_theme_options[gamertag]"></label>
                        <input id="vestride_theme_options[use_gamertag]" name="vestride_theme_options[use_gamertag]" type="checkbox" value="1" <?php checked('yes', $options['use_gamertag']); ?> />
                        <label class="description" for="vestride_theme_options[use_gamertag]"><?php _e('Use Xbox LIVE', 'vestride'); ?></label>
                    </td>
                </tr>

            </table>

            <p class="submit">
                <input type="submit" class="button-primary" value="<?php _e('Save Options', 'vestride'); ?>" />
            </p>
        </form>
    </div>
    <?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function vestride_theme_options_validate($input) {
    // Our checkbox value is either 0 or 1
//    if (!isset($input['use_twitter']))
//        $input['use_twitter'] = null;
    $input['use_twitter'] = ($input['use_twitter'] == '1') ? 'yes' : 'no';
    $input['use_facebook'] = ($input['use_facebook'] == '1') ? 'yes' : 'no';
    $input['use_vimeo'] = ($input['use_vimeo'] == '1') ? 'yes' : 'no';
    $input['use_dribbble'] = ($input['use_dribbble'] == '1') ? 'yes' : 'no';
    $input['use_flickr'] = ($input['use_flickr'] == '1') ? 'yes' : 'no';
    $input['use_googleplus'] = ($input['use_googleplus'] == '1') ? 'yes' : 'no';
    $input['use_youtube'] = ($input['use_youtube'] == '1') ? 'yes' : 'no';
    $input['use_linkedin'] = ($input['use_linkedin'] == '1') ? 'yes' : 'no';
    $input['use_github'] = ($input['use_github'] == '1') ? 'yes' : 'no';
    $input['use_gamertag'] = ($input['use_gamertag'] == '1') ? 'yes' : 'no';

    // Say our text option must be safe text with no HTML tags
    $input['twitter'] = wp_filter_nohtml_kses($input['twitter']);
    $input['facebook'] = wp_filter_nohtml_kses($input['facebook']);
    $input['vimeo'] = wp_filter_nohtml_kses($input['vimeo']);
    $input['youtube'] = wp_filter_nohtml_kses($input['youtube']);
    $input['googleplus'] = wp_filter_nohtml_kses($input['googleplus']);
    $input['dribbble'] = wp_filter_nohtml_kses($input['dribbble']);
    $input['flickr'] = wp_filter_nohtml_kses($input['flickr']);
    $input['github'] = wp_filter_nohtml_kses($input['github']);
    $input['gamertag'] = wp_filter_nohtml_kses($input['gamertag']);
    $input['linkedin'] = wp_filter_nohtml_kses($input['linkedin']);
    $input['ga'] = wp_filter_nohtml_kses($input['ga']);
    
    //  105688492908876684797

    // Our select option must actually be in our array of select options
    /*if (!array_key_exists($input['selectinput'], $select_options))
        $input['selectinput'] = null;

    // Our radio option must actually be in our array of radio options
    if (!isset($input['radioinput']))
        $input['radioinput'] = null;
    if (!array_key_exists($input['radioinput'], $radio_options))
        $input['radioinput'] = null;

    // Say our textarea option must be safe text with the allowed tags for posts
    $input['sometextarea'] = wp_filter_post_kses($input['sometextarea']);
    */
    return $input;
}

// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/