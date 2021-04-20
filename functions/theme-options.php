<?php
    
    global $template_parts;


    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "clippingpath_options";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }

    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();
    
    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        //'display_name'         => $theme->get( 'Name' ),
        'display_name'         => 'Mos Academy',
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'Theme Options', 'redux-framework-demo' ),
        'page_title'           => __( 'Theme Options', 'redux-framework-demo' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null, //number or null 0 te dashboard er upore
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => 'dashicons-smiley', //dash icon or directly image link
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    $args['admin_bar_links'][] = array(
        'id'    => 'redux-docs',
        'href'  => 'http://docs.reduxframework.com/',
        'title' => __( 'Documentation', 'redux-framework-demo' ),
    );

    $args['admin_bar_links'][] = array(
        //'id'    => 'redux-support',
        'href'  => 'https://github.com/ReduxFramework/redux-framework/issues',
        'title' => __( 'Support', 'redux-framework-demo' ),
    );

    $args['admin_bar_links'][] = array(
        'id'    => 'redux-extensions',
        'href'  => 'reduxframework.com/extensions',
        'title' => __( 'Extensions', 'redux-framework-demo' ),
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://github.com/mostak-shahid/',
        'title' => 'Visit us on GitHub',
        'icon'  => 'el el-github'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/mosacademy/',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'https://twitter.com/mostak_shahid',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.linkedin.com/in/mdmostakshahid/',
        'title' => 'Find us on LinkedIn',
        'icon'  => 'el el-linkedin'
    );

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( __( '', 'redux-framework-demo' ), $v );
    } else {
        $args['intro_text'] = __( '', 'redux-framework-demo' );
    }

    // Add content after the form.
    $args['footer_text'] = __( '', 'redux-framework-demo' );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */




    // -> Add options here

    
    //Logo Settings
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Logo Settings', 'redux-framework-demo' ),
        'id'               => 'logo-settings',
        'desc' => "<div class='redux-info-field'><h3>".__('Welcome to Mos Academy Options', 'redux-framework-demo')."</h3>
        <p>".__('This theme was developed by', 'redux-framework-demo')." <a href=\"http://mostak.belocal.today/\" target=\"_blank\">Md. Mostak Shahid</a></p></div>",
        'customizer_width' => '400px',
        'icon'             => 'dashicons dashicons-dashboard',
        'fields'     => array(
            array(
                'id'       => 'logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Logo', 'redux-framework-demo' ),
                'compiler' => 'true',
                'subtitle' => __( 'Upload your logo here.', 'redux-framework-demo' ),
                'default'  => array( 'url' => get_template_directory_uri().'/images/logo.png' ),
            ),
            array(
                'id'       => 'logo-option',
                'type'     => 'radio',
                'title'    => __( 'Logo option for large devices', 'redux-framework-demo' ),
                'options'  => array(
                    'logo' => 'Logo',
                    'title' => 'Title and Description'
                ),
                'default'  => 'title'
            )
        )
    ) );
    //Logo Settings
    //Basic Styling
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Basic Styling', 'redux-framework-demo' ),
        'id'               => 'basic-styling',
        //'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '400px',
        'icon'             => 'dashicons dashicons-art',
        'fields'     => array(            
            array(
                'id'       => 'basic-styling-stylesheet',
                'type'     => 'select',
                'title'    => __( 'Theme Skin Stylesheet', 'redux-framework-demo' ),
                'subtitle' => __( 'Note* changes made in options panel will override this stylesheet. Example: Colors set in typography.', 'redux-framework-demo' ),
                'options'  => array( 
                    'default' => 'default.css', 
                    'orange' => 'orange.css', 
                    'red' => 'red.css', 
                    'green' => 'green.css', 
                ),
                'default'  => 'default',
            ),
            array(
                'id'       => 'basic-styling-link-color',
                'type'     => 'link_color',
                'title'    => __( 'Links Color', 'redux-framework-demo' ),
                'output'   => array('a'),
            ),            
            array(
                'id'       => 'basic-styling-bgcolor',
                'type'     => 'color_rgba',
                'mode'     => 'background-color',
                'title'    => __( 'Theme Background Color', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'output'   => array( '.bg-theme' ),
            ),
        )
    ) );
    //Basic Styling     
    //General Page  
    Redux::setSection( $opt_name, array(
        'title'            => __( 'General Page', 'redux-framework-demo' ),
        'id'               => 'general-page',
        //'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '400px',
        'icon'             => 'dashicons dashicons-admin-page',
        'fields'     => array(
            array(
                'id'       => 'general-page-sections',
                'type'     => 'sorter',
                'title'    => 'General Page Sections',
                'subtitle' => 'You can add multiple drop areas or columns.',
                'compiler' => 'true',
                'options'  => array(
                    'Enabled'  => $template_parts['Enabled'],
                    'Disabled' => $template_parts['Disabled'],
                ),
            ),
        )
    ) );
    //General Page 
    //Archive Page  
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Archive Page', 'redux-framework-demo' ),
        'id'               => 'archive-page',
        //'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '400px',
        'icon'             => 'dashicons dashicons-admin-page',
        'fields'     => array(
            array(
                'id'       => 'archive-page-sections',
                'type'     => 'sorter',
                'title'    => 'Archive Page Sections',
                'subtitle' => 'You can add multiple drop areas or columns.',
                'compiler' => 'true',
                'options'  => array(
                    'Enabled'  => $template_parts['Enabled'],
                    'Disabled' => $template_parts['Disabled'],
                ),
            ),
        )
    ) );
    //Archive Page      
    //Contact Info   
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Contact Info', 'redux-framework-demo' ),
        'id'               => 'contact-section',
        'desc'             => '',
        'customizer_width' => '400px',
        'icon'             => 'fa fa-address-card',
        'fields'     => array(
            array(
                'id'        => 'contact-phone',
                'type'      => 'multi_text',
                'title'     => __( 'Phone', 'redux-framework-demo' ),
                'desc'      => __( '<b>Example:</b> 00 0000 0000', 'redux-framework-demo' ),                
                'validate' => 'no_html',
            ),
            array(
                'id'        => 'contact-fax',
                'type'      => 'multi_text',
                'title'     => __( 'Fax', 'redux-framework-demo' ),
                'desc'      => __( '<b>Example:</b> 00 0000 0000', 'redux-framework-demo' ),                
                'validate' => 'no_html',
            ),
            array(
                'id'        => 'contact-email',
                'type'      => 'multi_text',
                'title'     => __( 'Email', 'redux-framework-demo' ),
                'default'   => '',
                'desc'     => '<b>Example:</b> example@domain.com',
                'validate' => 'no_html',
            ),
            array(
                'id'       => 'contact-hour',
                'type'     => 'multi_text',
                'title'    => __( 'Business Hours', 'redux-framework-demo' ),
                'subtitle'       => __( 'You can use span tag ( &lt;span&gt;&lt;/span&gt; ) here.', 'redux-framework-demo' ),
                'desc'     => __( '<b>Example:</b> 6.30am - 6pm <span>(Mon-Fri)</span>', 'redux-framework-demo' ),
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                )
            ),
            array(
                'id'          => 'contact-address',
                'type'        => 'mos_address',
                'title'       => __( 'Contact Address', 'redux-framework-demo' ),           
                'show' => array(
                    'title' => true,
                    'description' => true,
                    'map_link' => true,
                    'embeded_link' => true,
                    'review_link' => false,
                    'review_link_img' => false,
                    'review_link_img_h' => false,
                    'target' => false,
                )
            ),
            array(
                'id'          => 'contact-social',
                'type'        => 'mos_social',
                //'type'        => 'kad_icons',
                'title'       => __( 'Social Media', 'redux-framework-demo' ),             
                'show' => array(
                    'title' => true,
                    'basic_icon' => true,
                    'hover_icon' => true,
                    'link_url' => true,
                    'embeded_link' => true,
                )
            ),
        )
    ) );
    //Contact Section
    //Misc Settings
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Misc Settings', 'redux-framework-demo' ),
        'id'               => 'misc-settings',
        //'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '400px',
        'icon'             => 'el el-css',
    ) );
    //Scripting
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Scripting', 'redux-framework-demo' ),
        'id'               => 'misc-scripting',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(
            array(
                'id'       => 'misc-settings-css',
                'type'     => 'ace_editor',
                'title'    => __( 'CSS Code', 'redux-framework-demo' ),
                'subtitle' => __( 'Paste your CSS code here.', 'redux-framework-demo' ),
                'mode'     => 'css',
                'theme'    => 'monokai',
                //'desc'     => 'Possible modes can be found at <a href="' . 'http://' . 'ace.c9.io" target="_clippingpath">' . 'http://' . 'ace.c9.io/</a>.',
                //'default'  => "body{\n   margin: 0 auto;\n}"
            ),
            array(
                'id'       => 'misc-settings-js',
                'type'     => 'ace_editor',
                'title'    => __( 'JS Code', 'redux-framework-demo' ),
                'subtitle' => __( 'Paste your JS code here.', 'redux-framework-demo' ),
                'mode'     => 'javascript',
                'theme'    => 'chrome',
                //'desc'     => 'Possible modes can be found at <a href="' . 'http://' . 'ace.c9.io" target="_clippingpath">' . 'http://' . 'ace.c9.io/</a>.',
                //'default'  => "jQuery(document).ready(function(){\n\n});"
            ),
        )
    ) );
    //Page Loader
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Page Loader', 'redux-framework-demo' ),
        'id'               => 'misc-loader',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(
            array(
                'id'       => 'misc-page-loader',
                'type'     => 'switch',
                'title'    => __( 'Page Loader Option', 'redux-framework-demo' ),
                'subtitle' => __( 'Do you want to use the page loader', 'redux-framework-demo' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'misc-page-loader-image',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Page Loader image', 'redux-framework-demo' ),
                'compiler' => 'true'
            ),
            array(
                'id'       => 'misc-page-loader-background-rgba',
                'type'     => 'color_rgba',
                'mode'     => 'background-color',
                'title'    => __( 'Page Loader Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'output'   => array( '.se-pre-con' ),
            ),
        )
    ) );
    //Back to Top
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Back to Top', 'redux-framework-demo' ),
        'id'               => 'misc-btt',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(
            array(
                'id'       => 'misc-back-top',
                'type'     => 'switch',
                'title'    => __( 'Back to Top Option', 'redux-framework-demo' ),
                'subtitle' => __( 'Do you want to use the back to top', 'redux-framework-demo' ),
                'default'  => 1,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
        )
    ) );
	//MISC
    //Page Sections
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Page Sections', 'redux-framework-demo' ),
        'id'               => 'sections',
        'desc'             => '',
        'customizer_width' => '400px',
        'icon'             => 'el el-adjust-alt'
    ) );
    //Topbar Section 
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Topbar Section', 'redux-framework-demo' ),
        'id'               => 'topbar-section',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(
            array(
                'id'             => 'sections-topbar-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-topbar .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ),
            array(
                'id'             => 'sections-topbar-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-topbar .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),
            array(
                'id'       => 'sections-topbar-border',
                'type'     => 'border',
                'title'    => __( 'Section Border', 'redux-framework-demo' ),
                'output'   => array( '#section-topbar .content-wrap' ),
                'all'      => false,
            ),
            array(
                'id'       => 'sections-topbar-class',
                'type'     => 'text',
                'title'    => __( 'Section CSS Class', 'redux-framework-demo' ),
                'desc'     => 'You can add additional css class here.',
                'validate'     => 'no_html',
            ),
            array(
                'id'       => 'sections-topbar-color-type',
                'type'     => 'button_set',
                'title'    => __( 'Section text color', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Default Colors',
                    '2' => 'Custom Colors'
                ),
                'default'  => '1',
            ),
            array(
                'id'       => 'sections-topbar-color',
                'type'     => 'select',
                'title'    => __( 'Select Color', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    "text-primary" => 'Text primary',
                    "text-secondary" => 'Text secondary',
                    "text-success" => 'Text success',
                    "text-danger" => 'Text danger',
                    "text-warning" => 'Text warning',
                    "text-info" => 'Text info',
                    "text-light" => 'Text light',
                    "text-dark" => 'Text dark',
                    "text-body" => 'Text body',
                    "text-muted" => 'Text muted',
                    "text-white" => 'Text white',
                    "text-black-50" => 'Text black-50',
                    "text-white-50" => 'Text white-50',
                ),
                'required' => array( 'sections-topbar-color-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-topbar-color-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Select Color', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-topbar-color-type', '=', '2' ),
                'output'         => array( '#section-topbar' ),
                'mode'     => 'color',
            ),
            array(
                'id'       => 'sections-topbar-link-color',
                'type'     => 'link_color',
                'title'    => __('Links Color Option', 'redux-framework-demo'),
                'validate' => 'color',
                'output'         => array( '#section-topbar a' ),
            ),
            array(
                'id'       => 'sections-topbar-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Section Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Default Colors',
                    '2' => 'Custom Colors'
                ),
                'default'  => '1',
            ),
            array(
                'id'       => 'sections-topbar-background',
                'type'     => 'select',
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'bg-primary' => 'Primary Background',
                    'bg-secondary' => 'Secondary Background',
                    'bg-success' => 'Success Background',
                    'bg-danger' => 'Danger Background',
                    'bg-warning' => 'Warning Background',
                    'bg-info' => 'Info Background',
                    'bg-light' => 'Light Background',
                    'bg-dark' => 'Dark Background',
                    'bg-white' => 'White Background',
                    'bg-transparent' => 'Transparent Background',
                ),
                // 'default'  => 'bg-dark',
                'required' => array( 'sections-topbar-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-topbar-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-topbar-background-type', '=', '2' ),
                'output'         => array( '#section-topbar' ),
                'mode'     => 'background-color',
            ),
            array(
                'id'       => 'sections-topbar-bg',
                'type'     => 'background',
                'output'   => array( '#section-topbar' ),
                'title'    => __( 'Default Background Image', 'redux-framework-demo' ),
                'background-color' => false
            ),
        )
    ) ); 
    //Header Section 
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Header Section', 'redux-framework-demo' ),
        'id'               => 'header-section',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(
            array(
                'id'             => 'sections-header-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#main-header .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ),
            array(
                'id'             => 'sections-header-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#main-header .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),
            array(
                'id'       => 'sections-header-border',
                'type'     => 'border',
                'title'    => __( 'Section Border', 'redux-framework-demo' ),
                'output'   => array( '#main-header .content-wrap' ),
                'all'      => false,
            ),
            array(
                'id'       => 'sections-header-class',
                'type'     => 'text',
                'title'    => __( 'Section CSS Class', 'redux-framework-demo' ),
                'desc'     => 'You can add additional css class here.',
                'validate'     => 'no_html',
            ),
            array(
                'id'       => 'sections-header-color-type',
                'type'     => 'button_set',
                'title'    => __( 'Section text color', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Default Colors',
                    '2' => 'Custom Colors'
                ),
                'default'  => '1',
            ),
            array(
                'id'       => 'sections-header-color',
                'type'     => 'select',
                'title'    => __( 'Select Color', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    "text-primary" => 'Text primary',
                    "text-secondary" => 'Text secondary',
                    "text-success" => 'Text success',
                    "text-danger" => 'Text danger',
                    "text-warning" => 'Text warning',
                    "text-info" => 'Text info',
                    "text-light" => 'Text light',
                    "text-dark" => 'Text dark',
                    "text-body" => 'Text body',
                    "text-muted" => 'Text muted',
                    "text-white" => 'Text white',
                    "text-black-50" => 'Text black-50',
                    "text-white-50" => 'Text white-50',
                ),
                'required' => array( 'sections-header-color-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-header-color-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Select Color', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-header-color-type', '=', '2' ),
                'output'         => array( '#main-header' ),
                'mode'     => 'color',
            ),
            array(
                'id'       => 'sections-header-link-color',
                'type'     => 'link_color',
                'title'    => __('Links Color Option', 'redux-framework-demo'),
                'validate' => 'color',
                'output'         => array( '#main-header a' ),
            ),
            array(
                'id'       => 'sections-header-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Section Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Default Colors',
                    '2' => 'Custom Colors'
                ),
                'default'  => '1',
            ),
            array(
                'id'       => 'sections-header-background',
                'type'     => 'select',
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'bg-primary' => 'Primary Background',
                    'bg-secondary' => 'Secondary Background',
                    'bg-success' => 'Success Background',
                    'bg-danger' => 'Danger Background',
                    'bg-warning' => 'Warning Background',
                    'bg-info' => 'Info Background',
                    'bg-light' => 'Light Background',
                    'bg-dark' => 'Dark Background',
                    'bg-white' => 'White Background',
                    'bg-transparent' => 'Transparent Background',
                ),
                'default'  => 'bg-dark',
                'required' => array( 'sections-header-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-header-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-header-background-type', '=', '2' ),
                'output'         => array( '#main-header' ),
                'mode'     => 'background-color',
            ),
            array(
                'id'       => 'sections-header-bg',
                'type'     => 'background',
                'output'   => array( '#main-header' ),
                'title'    => __( 'Default Background Image', 'redux-framework-demo' ),
                'background-color' => false
            ),
        )
    ) );    
    //Page Title Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Page Title Section', 'redux-framework-demo' ),
        'id'               => 'sections-title',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(  
            array(
                'id'             => 'sections-title-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#page-title .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ), 
            array(
                'id'             => 'sections-title-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#page-title .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),         
            array(
                'id'       => 'sections-title-border',
                'type'     => 'border',
                'title'    => __( 'Section Border', 'redux-framework-demo' ),
                'output'   => array( '#page-title .content-wrap' ),
                'all'      => false,
            ), 
            array(
                'id'       => 'sections-title-class',
                'type'     => 'text',
                'title'    => __( 'Section CSS Class', 'redux-framework-demo' ),
                'desc'     => 'You can add additional css class here.',
                'validate'     => 'no_html',
            ),
            array(
                'id'       => 'sections-title-color-type',
                'type'     => 'button_set',
                'title'    => __( 'Section text color', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Default Colors',
                    '2' => 'Custom Colors'
                ),
                'default'  => '1',
            ),
            array(
                'id'       => 'sections-title-color',
                'type'     => 'select',
                'title'    => __( 'Select Color', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    "text-primary" => 'Text primary',
                    "text-secondary" => 'Text secondary',
                    "text-success" => 'Text success',
                    "text-danger" => 'Text danger',
                    "text-warning" => 'Text warning',
                    "text-info" => 'Text info',
                    "text-light" => 'Text light',
                    "text-dark" => 'Text dark',
                    "text-body" => 'Text body',
                    "text-muted" => 'Text muted',
                    "text-white" => 'Text white',
                    "text-black-50" => 'Text black-50',
                    "text-white-50" => 'Text white-50',
                ),
                'required' => array( 'sections-title-color-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-title-color-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Select Color', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-title-color-type', '=', '2' ),
                'output'         => array( '#page-title' ),
                'mode'     => 'color',
            ),
            array(
                'id'       => 'sections-title-link-color',
                'type'     => 'link_color',
                'title'    => __('Links Color Option', 'redux-framework-demo'),
                'validate' => 'color',
                'output'         => array( '#page-title a' ),
            ),
            array(
                'id'       => 'sections-title-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Section Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Default Colors',
                    '2' => 'Custom Colors'
                ),
                'default'  => '1',
            ),
            array(
                'id'       => 'sections-title-background',
                'type'     => 'select',
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'bg-primary' => 'Primary Background',
                    'bg-secondary' => 'Secondary Background',
                    'bg-success' => 'Success Background',
                    'bg-danger' => 'Danger Background',
                    'bg-warning' => 'Warning Background',
                    'bg-info' => 'Info Background',
                    'bg-light' => 'Light Background',
                    'bg-dark' => 'Dark Background',
                    'bg-white' => 'White Background',
                    'bg-transparent' => 'Transparent Background',
                ),
                'default'  => 'bg-dark',
                'required' => array( 'sections-title-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-title-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-title-background-type', '=', '2' ),
                'output'         => array( '#page-title' ),
                'mode'     => 'background-color',
            ),
            array(
                'id'       => 'sections-title-bg',
                'type'     => 'background',
                'output'   => array( '#page-title' ),
                'title'    => __( 'Default Background', 'redux-framework-demo' ),
                'background-color' => false
            ),
        )
    ) );
    //Breadcrumbs Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Breadcrumbs Section', 'redux-framework-demo' ),
        'id'               => 'sections-breadcrumbs',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(
            array(
                'id'             => 'sections-breadcrumbs-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-breadcrumbs .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
                'default'        => array(
                    'padding-top' => '12px', 
                    'padding-right' => '', 
                    'padding-bottom' => '12px', 
                    'padding-left' => '', 
                )
            ), 
            array(
                'id'             => 'sections-breadcrumbs-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-breadcrumbs .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),        
            array(
                'id'       => 'sections-breadcrumbs-border',
                'type'     => 'border',
                'title'    => __( 'Section Border', 'redux-framework-demo' ),
                'output'   => array( '#section-breadcrumbs .content-wrap' ),
                'all'      => false,
            ),
            array(
                'id'       => 'sections-breadcrumbs-class',
                'type'     => 'text',
                'title'    => __( 'Section CSS Class', 'redux-framework-demo' ),
                'desc'     => 'You can add additional css class here.',
                'validate'     => 'no_html',
            ),
            array(
                'id'       => 'sections-breadcrumbs-title',
                'type'     => 'text',
                'title'    => __( 'Section Title', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br /&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),
                    
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                )
            ),
            array(
                'id'      => 'sections-breadcrumbs-content',
                'type'    => 'editor',
                'title'   => __( 'Section Content', 'redux-framework-demo' ),
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    //'tabindex' => 1,
                    //'editor_css' => '',
                    'teeny'         => false,
                    //'tinymce' => array(),
                    //'quicktags'     => false,
                )
            ),
            
            /*array(
                'id'       => 'sections-breadcrumbs-option',
                'type'     => 'switch',
                'title'    => __( 'Breadcrumbs', 'redux-framework-demo' ),
                //'options' => array('on', 'off'),
                'default'  => false,
            ),*/

            array(
                'id'       => 'sections-breadcrumbs-color-type',
                'type'     => 'button_set',
                'title'    => __( 'Section text color', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Default Colors',
                    '2' => 'Custom Colors'
                ),
                'default'  => '1',
            ),
            array(
                'id'       => 'sections-breadcrumbs-color',
                'type'     => 'select',
                'title'    => __( 'Select Color', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    "text-primary" => 'Text primary',
                    "text-secondary" => 'Text secondary',
                    "text-success" => 'Text success',
                    "text-danger" => 'Text danger',
                    "text-warning" => 'Text warning',
                    "text-info" => 'Text info',
                    "text-light" => 'Text light',
                    "text-dark" => 'Text dark',
                    "text-body" => 'Text body',
                    "text-muted" => 'Text muted',
                    "text-white" => 'Text white',
                    "text-black-50" => 'Text black-50',
                    "text-white-50" => 'Text white-50',
                ),
                'required' => array( 'sections-breadcrumbs-color-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-breadcrumbs-color-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Select Color', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-title-color-type', '=', '2' ),
                'output'         => array( '#section-breadcrumbs' ),
                'mode'     => 'color',
            ),
            array(
                'id'       => 'sections-breadcrumbs-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Section Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Default Colors',
                    '2' => 'Custom Colors'
                ),
                'default'  => '1',
            ),
            array(
                'id'       => 'sections-breadcrumbs-background',
                'type'     => 'select',
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'bg-primary text-white' => 'Primary Background',
                    'bg-secondary text-white' => 'Secondary Background',
                    'bg-success text-white' => 'Success Background',
                    'bg-danger text-white' => 'Danger Background',
                    'bg-warning text-white' => 'Warning Background',
                    'bg-info text-white' => 'Info Background',
                    'bg-light text-dark' => 'Light Background',
                    'bg-dark text-white' => 'Dark Background',
                    'bg-white text-dark' => 'White Background',
                    'bg-transparent text-dark' => 'Transparent Background',
                ),
                'required' => array( 'sections-breadcrumbs-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-breadcrumbs-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-breadcrumbs-background-type', '=', '2' ),
                'output'         => array( '#section-breadcrumbs' ),
                'mode'     => 'background-color',
            ),
            array(
                'id'       => 'sections-breadcrumbs-bg',
                'type'     => 'background',
                'output'   => array( '#section-breadcrumbs' ),
                'title'    => __( 'Default Background Image', 'redux-framework-demo' ),
                'background-color' => false
            ),
        )
    ) );  
    //Baner Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Banner Section', 'redux-framework-demo' ),
        'id'               => 'sections-banner',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(  
            array(
                'id'       => 'sections-banner-select',
                'type'     => 'select',
                'title'    => __( 'Choose a Home Image Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'If you don\'t want an image slider on your home page choose none.', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'banner' => 'Banner',
                    'carousel' => 'Carousel Slider',
                    'shortcode' => 'From Shortcode',
                ),
                'default'  => 'banner'
            ),
            array(
                'id'          => 'sections-banner-details',
                'type'        => 'mos_slides',
                'title'       => __( 'Slider Images', 'redux-framework-demo' ),
                'subtitle'    => __( 'Use large images (Max Width 1920px) for best results.', 'redux-framework-demo' ),              
                'show' => array(
                    'title' => true,
                    'description' => true,
                    'link_title' => true,
                    'link_url' => true,
                    'target' => true,
                ),
                'placeholder' => array(
                    'title'       => __( 'This is a title', 'redux-framework-demo' ),
                    'description' => __( 'Description Here', 'redux-framework-demo' ),
                    'link_title'         => __( 'Link Title', 'redux-framework-demo' ),
                    'url'         => __( 'Give us a link!', 'redux-framework-demo' ),
                ),
                'required' => array( 'sections-banner-select', '!=', 'shortcode' ),
            ),            
            array(
                'id'       => 'sections-banner-shortcode',
                'type'     => 'text',
                'title'    => __( 'Shortcode', 'redux-framework-demo' ),
                'subtitle' => __( 'All HTML will be stripped', 'redux-framework-demo' ),
                'validate' => 'no_html',
                'default'  => 'No HTML is allowed in here.',
                'required' => array( 'sections-banner-select', '=', 'shortcode' ),
            ),
        )
    ) );    
    //Content Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Content Section', 'redux-framework-demo' ),
        'id'               => 'sections-content',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(  
            array(
                'id'             => 'sections-content-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '.page-content .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ),
            array(
                'id'             => 'sections-content-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '.page-content .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),         
            array(
                'id'       => 'sections-content-border',
                'type'     => 'border',
                'title'    => __( 'Section Border', 'redux-framework-demo' ),
                'output'   => array( '.page-content .content-wrap' ),
                'all'      => false,
            ), 
            array(
                'id'       => 'sections-content-class',
                'type'     => 'text',
                'title'    => __( 'Section CSS Class', 'redux-framework-demo' ),
                'desc'     => 'You can add additional css class here.',
                'validate'     => 'no_html',
            ),

            array(
                'id'       => 'sections-content-color-type',
                'type'     => 'button_set',
                'title'    => __( 'Section text color', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Default Colors',
                    '2' => 'Custom Colors'
                ),
                'default'  => '1',
            ),
            array(
                'id'       => 'sections-content-color',
                'type'     => 'select',
                'title'    => __( 'Select Color', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    "text-primary" => 'Text primary',
                    "text-secondary" => 'Text secondary',
                    "text-success" => 'Text success',
                    "text-danger" => 'Text danger',
                    "text-warning" => 'Text warning',
                    "text-info" => 'Text info',
                    "text-light" => 'Text light',
                    "text-dark" => 'Text dark',
                    "text-body" => 'Text body',
                    "text-muted" => 'Text muted',
                    "text-white" => 'Text white',
                    "text-black-50" => 'Text black-50',
                    "text-white-50" => 'Text white-50',
                ),
                'required' => array( 'sections-content-color-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-content-color-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Select Color', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-content-color-type', '=', '2' ),
                'output'         => array( '.page-content' ),
                'mode'     => 'color',
            ),
            array(
                'id'       => 'sections-content-link-color',
                'type'     => 'link_color',
                'title'    => __('Links Color Option', 'redux-framework-demo'),
                'validate' => 'color',
                'output'         => array( '.page-content a' ),
            ),
            array(
                'id'       => 'sections-content-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Section Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Default Colors',
                    '2' => 'Custom Colors'
                ),
                'default'  => '1',
            ),
            array(
                'id'       => 'sections-content-background',
                'type'     => 'select',
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'bg-primary' => 'Primary Background',
                    'bg-secondary' => 'Secondary Background',
                    'bg-success' => 'Success Background',
                    'bg-danger' => 'Danger Background',
                    'bg-warning' => 'Warning Background',
                    'bg-info' => 'Info Background',
                    'bg-light' => 'Light Background',
                    'bg-dark' => 'Dark Background',
                    'bg-white' => 'White Background',
                    'bg-transparent' => 'Transparent Background',
                ),
                'required' => array( 'sections-content-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-content-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-content-background-type', '=', '2' ),
                'output'         => array( '.page-content' ),
                'mode'     => 'background-color',
            ),
            array(
                'id'       => 'sections-content-bg',
                'type'     => 'background',
                'output'   => array( '.page-content' ),
                'title'    => __( 'Default Background', 'redux-framework-demo' ),
                'background-color' => false
            ),
        )
    ) );
    //About Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'About Section', 'redux-framework-demo' ),
        'id'               => 'sections-about',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(
            array(
                'id'             => 'sections-about-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-about .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ),  
            array(
                'id'             => 'sections-about-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-about .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),        
            array(
                'id'       => 'sections-about-border',
                'type'     => 'border',
                'title'    => __( 'Section Border', 'redux-framework-demo' ),
                'output'   => array( '#section-about .content-wrap' ),
                'all'      => false,
            ),
            array(
                'id'       => 'sections-about-class',
                'type'     => 'text',
                'title'    => __( 'Section CSS Class', 'redux-framework-demo' ),
                'desc'     => 'You can add additional css class here.',
                'validate'     => 'no_html',
            ),
            array(
                'id'       => 'sections-about-title',
                'type'     => 'text',
                'title'    => __( 'Section Title', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br /&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),
                    
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                )
            ),
            array(
                'id'       => 'sections-about-subtitle',
                'type'     => 'text',
                'title'    => __( 'Section Subtitle', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br /&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),
                    
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                )
            ),
            array(
                'id'      => 'sections-about-content',
                'type'    => 'editor',
                'title'   => __( 'Section Content', 'redux-framework-demo' ),
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    //'tabindex' => 1,
                    //'editor_css' => '',
                    'teeny'         => false,
                    //'tinymce' => array(),
                    //'quicktags'     => false,
                )
            ),
            array(
                'id'          => 'sections-about-slides',
                'type'        => 'mos_slides',
                'title'       => __( 'Section Details', 'redux-framework-demo' ),              
                'show' => array(
                    'title' => true,
                    'description' => true,
                    'link_title' => true,
                    'link_url' => true,
                    'target' => false,
                ),
                'placeholder' => array(
                    'title'       => __( 'This is a title', 'redux-framework-demo' ),
                    'description' => __( 'Description Here', 'redux-framework-demo' ),
                    'link_title'         => __( 'Link Title', 'redux-framework-demo' ),
                    'link_url'         => __( 'Give us a link!', 'redux-framework-demo' ),
                )
            ),
            array(
                'id'       => 'sections-about-media',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Section Image', 'redux-framework-demo' ),
                'compiler' => 'true',
            ),
            array(
                'id'       => 'sections-about-color-type',
                'type'     => 'button_set',
                'title'    => __( 'Section text color', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Default Colors',
                    '2' => 'Custom Colors'
                ),
                'default'  => '1',
            ),
            array(
                'id'       => 'sections-about-color',
                'type'     => 'select',
                'title'    => __( 'Select Color', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    "text-primary" => 'Text primary',
                    "text-secondary" => 'Text secondary',
                    "text-success" => 'Text success',
                    "text-danger" => 'Text danger',
                    "text-warning" => 'Text warning',
                    "text-info" => 'Text info',
                    "text-light" => 'Text light',
                    "text-dark" => 'Text dark',
                    "text-body" => 'Text body',
                    "text-muted" => 'Text muted',
                    "text-white" => 'Text white',
                    "text-black-50" => 'Text black-50',
                    "text-white-50" => 'Text white-50',
                ),
                'required' => array( 'sections-about-color-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-about-color-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Select Color', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-about-color-type', '=', '2' ),
                'output'         => array( '#section-about' ),
                'mode'     => 'color',
            ),
            array(
                'id'       => 'sections-about-link-color',
                'type'     => 'link_color',
                'title'    => __('Links Color Option', 'redux-framework-demo'),
                'validate' => 'color',
                'output'         => array( '#section-about a' ),
            ),
            array(
                'id'       => 'sections-about-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Section Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Default Colors',
                    '2' => 'Custom Colors'
                ),
                'default'  => '1',
            ),
            array(
                'id'       => 'sections-about-background',
                'type'     => 'select',
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'bg-primary' => 'Primary Background',
                    'bg-secondary' => 'Secondary Background',
                    'bg-success' => 'Success Background',
                    'bg-danger' => 'Danger Background',
                    'bg-warning' => 'Warning Background',
                    'bg-info' => 'Info Background',
                    'bg-light' => 'Light Background',
                    'bg-dark' => 'Dark Background',
                    'bg-white' => 'White Background',
                    'bg-transparent' => 'Transparent Background',
                ),
                'required' => array( 'sections-about-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-about-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-about-background-type', '=', '2' ),
                'output'         => array( '#section-about' ),
                'mode'     => 'background-color',
            ),
            array(
                'id'       => 'sections-about-bg',
                'type'     => 'background',
                'output'   => array( '#section-about' ),
                'title'    => __( 'Default Background', 'redux-framework-demo' ),
                'background-color' => false
            ),
        )
    ) ); 


    //Blank
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Blank', 'redux-framework-demo' ),
        'id'               => 'sections-blank',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(
            array(
                'id'             => 'sections-blank-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-blank .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ),  
            array(
                'id'             => 'sections-blank-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-blank .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),        
            array(
                'id'       => 'sections-blank-border',
                'type'     => 'border',
                'title'    => __( 'Section Border', 'redux-framework-demo' ),
                'output'   => array( '#section-blank .content-wrap' ),
                'all'      => false,
            ),
            array(
                'id'       => 'sections-blank-class',
                'type'     => 'text',
                'title'    => __( 'Section CSS Class', 'redux-framework-demo' ),
                'desc'     => 'You can add additional css class here.',
                'validate'     => 'no_html',
            ),
            array(
                'id'       => 'sections-blank-title',
                'type'     => 'text',
                'title'    => __( 'Section Title', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br /&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),
                    
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                )
            ),
            array(
                'id'       => 'sections-blank-subtitle',
                'type'     => 'text',
                'title'    => __( 'Section Subtitle', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br /&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),
                    
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                )
            ),
            array(
                'id'      => 'sections-blank-content',
                'type'    => 'editor',
                'title'   => __( 'Section Content', 'redux-framework-demo' ),
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    //'tabindex' => 1,
                    //'editor_css' => '',
                    'teeny'         => false,
                    //'tinymce' => array(),
                    //'quicktags'     => false,
                )
            ),
            array(
                'id'          => 'sections-blank-slides',
                'type'        => 'mos_slides',
                'title'       => __( 'Section Details', 'redux-framework-demo' ),              
                'show' => array(
                    'title' => true,
                    'description' => true,
                    'link_title' => true,
                    'link_url' => true,
                    'target' => false,
                ),
                'placeholder' => array(
                    'title'       => __( 'This is a title', 'redux-framework-demo' ),
                    'description' => __( 'Description Here', 'redux-framework-demo' ),
                    'link_title'         => __( 'Link Title', 'redux-framework-demo' ),
                    'link_url'         => __( 'Give us a link!', 'redux-framework-demo' ),
                )
            ),
            array(
                'id'       => 'sections-blank-media',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Section Image', 'redux-framework-demo' ),
                'compiler' => 'true',
            ),
            array(
                'id'       => 'sections-blank-link',
                'type'     => 'mos_group',                
                'title'    => 'Section Link',
                'show' => array (
                    'text_field_1' => true,
                    'text_field_2' => true,
                ),
                'placeholder' => array(
                   'text_field_1' => 'Link Title',
                   'text_field_2' => 'Link URL',
                )
            ),
            array(
                'id'       => 'sections-blank-color-type',
                'type'     => 'button_set',
                'title'    => __( 'Section text color', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Default Colors',
                    '2' => 'Custom Colors'
                ),
                'default'  => '1',
            ),
            array(
                'id'       => 'sections-blank-color',
                'type'     => 'select',
                'title'    => __( 'Select Color', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    "text-primary" => 'Text primary',
                    "text-secondary" => 'Text secondary',
                    "text-success" => 'Text success',
                    "text-danger" => 'Text danger',
                    "text-warning" => 'Text warning',
                    "text-info" => 'Text info',
                    "text-light" => 'Text light',
                    "text-dark" => 'Text dark',
                    "text-body" => 'Text body',
                    "text-muted" => 'Text muted',
                    "text-white" => 'Text white',
                    "text-black-50" => 'Text black-50',
                    "text-white-50" => 'Text white-50',
                ),
                'required' => array( 'sections-blank-color-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-blank-color-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Select Color', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-blank-color-type', '=', '2' ),
                'output'         => array( '#section-blank' ),
                'mode'     => 'color',
            ),
            array(
                'id'       => 'sections-blank-link-color',
                'type'     => 'link_color',
                'title'    => __('Links Color Option', 'redux-framework-demo'),
                'validate' => 'color',
                'output'         => array( '#section-blank a' ),
            ),
            array(
                'id'       => 'sections-blank-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Section Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Default Colors',
                    '2' => 'Custom Colors'
                ),
                'default'  => '1',
            ),
            array(
                'id'       => 'sections-blank-background',
                'type'     => 'select',
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'bg-primary' => 'Primary Background',
                    'bg-secondary' => 'Secondary Background',
                    'bg-success' => 'Success Background',
                    'bg-danger' => 'Danger Background',
                    'bg-warning' => 'Warning Background',
                    'bg-info' => 'Info Background',
                    'bg-light' => 'Light Background',
                    'bg-dark' => 'Dark Background',
                    'bg-white' => 'White Background',
                    'bg-transparent' => 'Transparent Background',
                ),
                'required' => array( 'sections-blank-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-blank-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-blank-background-type', '=', '2' ),
                'output'         => array( '#section-blank' ),
                'mode'     => 'background-color',
            ),
            array(
                'id'       => 'sections-blank-bg',
                'type'     => 'background',
                'output'   => array( '#section-blank' ),
                'title'    => __( 'Default Background', 'redux-framework-demo' ),
                'background-color' => false
            ),
        )
    ) );  
    //Widgets Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Widgets Section', 'redux-framework-demo' ),
        'id'               => 'sections-widgets',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(  
            array(
                'id'             => 'sections-widgets-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-widgets .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ), 
            array(
                'id'             => 'sections-widgets-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-widgets .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),       
            array(
                'id'       => 'sections-widgets-border',
                'type'     => 'border',
                'title'    => __( 'Section Border', 'redux-framework-demo' ),
                'output'   => array( '#section-widgets .content-wrap' ),
                'all'      => false,
            ),
            array(
                'id'       => 'sections-widgets-class',
                'type'     => 'text',
                'title'    => __( 'Section CSS Class', 'redux-framework-demo' ),
                'desc'     => 'You can add additional css class here.',
                'validate'     => 'no_html',
            ),
            array(
                'id'       => 'sections-widgets-title',
                'type'     => 'text',
                'title'    => __( 'Section Title', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br&gt;&lt;/br&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                )
            ),
            array(
                'id'      => 'sections-widgets-content',
                'type'    => 'editor',
                'title'   => __( 'Section Content', 'redux-framework-demo' ),
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    //'tabindex' => 1,
                    //'editor_css' => '',
                    'teeny'         => false,
                    //'tinymce' => array(),
                    //'quicktags'     => false,
                )
            ),
            array(
                'id'       => 'sections-widgets-layout',
                'type'     => 'image_select',
                'title'    => __( 'Widgets Layout', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => array(
                        'alt' => 'One Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1-col-portfolio.png'
                    ),
                    '2' => array(
                        'alt' => 'Two Columns',
                        'img' => ReduxFramework::$_url . 'assets/img/2-col-portfolio.png'
                    ),
                    '3' => array(
                        'alt' => 'Three Columns',
                        'img' => ReduxFramework::$_url . 'assets/img/3-col-portfolio.png'
                    ),
                    '4' => array(
                        'alt' => 'Four Columns',
                        'img' => ReduxFramework::$_url . 'assets/img/4-col-portfolio.png'
                    )
                ),
                'default'  => '3'
            ),           

            array(
                'id'       => 'sections-widgets-color-type',
                'type'     => 'button_set',
                'title'    => __( 'Section text color', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Default Colors',
                    '2' => 'Custom Colors'
                ),
                'default'  => '1',
            ),
            array(
                'id'       => 'sections-widgets-color',
                'type'     => 'select',
                'title'    => __( 'Select Color', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    "text-primary" => 'Text primary',
                    "text-secondary" => 'Text secondary',
                    "text-success" => 'Text success',
                    "text-danger" => 'Text danger',
                    "text-warning" => 'Text warning',
                    "text-info" => 'Text info',
                    "text-light" => 'Text light',
                    "text-dark" => 'Text dark',
                    "text-body" => 'Text body',
                    "text-muted" => 'Text muted',
                    "text-white" => 'Text white',
                    "text-black-50" => 'Text black-50',
                    "text-white-50" => 'Text white-50',
                ),
                'required' => array( 'sections-widgets-color-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-widgets-color-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Select Color', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-widgets-color-type', '=', '2' ),
                'output'         => array( '#section-widgets' ),
                'mode'     => 'color',
            ),
            array(
                'id'       => 'sections-widgets-link-color',
                'type'     => 'link_color',
                'title'    => __('Links Color Option', 'redux-framework-demo'),
                'validate' => 'color',
                'output'         => array( '#section-widgets a' ),
            ),
            array(
                'id'       => 'sections-widgets-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Section Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Default Colors',
                    '2' => 'Custom Colors'
                ),
                'default'  => '1',
            ),
            array(
                'id'       => 'sections-widgets-background',
                'type'     => 'select',
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'bg-primary' => 'Primary Background',
                    'bg-secondary' => 'Secondary Background',
                    'bg-success' => 'Success Background',
                    'bg-danger' => 'Danger Background',
                    'bg-warning' => 'Warning Background',
                    'bg-info' => 'Info Background',
                    'bg-light' => 'Light Background',
                    'bg-dark' => 'Dark Background',
                    'bg-white' => 'White Background',
                    'bg-transparent' => 'Transparent Background',
                ),
                'required' => array( 'sections-widgets-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-widgets-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-widgets-background-type', '=', '2' ),
                'output'         => array( '#section-widgets' ),
                'mode'     => 'background-color',
            ),
            array(
                'id'       => 'sections-widgets-bg',
                'type'     => 'background',
                'output'   => array( '#section-widgets' ),
                'title'    => __( 'Default Background', 'redux-framework-demo' ),
                'background-color' => false
            ),
        )
    ) ); 
    //Footer Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Footer Section', 'redux-framework-demo' ),
        'id'               => 'sections-footer',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array( 
            array(
                'id'             => 'sections-footer-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#footer .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ), 
            array(
                'id'             => 'sections-footer-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#footer .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),        
            array(
                'id'       => 'sections-footer-border',
                'type'     => 'border',
                'title'    => __( 'Section Border', 'redux-framework-demo' ),
                'output'   => array( '#footer .content-wrap' ),
                'all'      => false,
            ),
            array(
                'id'       => 'sections-footer-class',
                'type'     => 'text',
                'title'    => __( 'Section CSS Class', 'redux-framework-demo' ),
                'desc'     => 'You can add additional css class here.',
                'validate'     => 'no_html',
            ), 
            array(
                'id'       => 'sections-footer-title',
                'type'     => 'text',
                'title'    => __( 'Section Title', 'redux-framework-demo' ),
                //'subtitle' => __( 'All HTML will be stripped', 'redux-framework-demo' ),
                'desc'     => __( 'All HTML will be stripped.', 'redux-framework-demo' ),
                'validate' => 'no_html',
            ),
            array(
                'id'      => 'sections-footer-content',
                'type'    => 'editor',
                'title'   => __( 'Section Content', 'redux-framework-demo' ),
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    //'tabindex' => 1,
                    //'editor_css' => '',
                    'teeny'         => false,
                    //'tinymce' => array(),
                    //'quicktags'     => false,
                )
            ),

            array(
                'id'       => 'sections-footer-color-type',
                'type'     => 'button_set',
                'title'    => __( 'Section text color', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Default Colors',
                    '2' => 'Custom Colors'
                ),
                'default'  => '1',
            ),
            array(
                'id'       => 'sections-footer-color',
                'type'     => 'select',
                'title'    => __( 'Select Color', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    "text-primary" => 'Text primary',
                    "text-secondary" => 'Text secondary',
                    "text-success" => 'Text success',
                    "text-danger" => 'Text danger',
                    "text-warning" => 'Text warning',
                    "text-info" => 'Text info',
                    "text-light" => 'Text light',
                    "text-dark" => 'Text dark',
                    "text-body" => 'Text body',
                    "text-muted" => 'Text muted',
                    "text-white" => 'Text white',
                    "text-black-50" => 'Text black-50',
                    "text-white-50" => 'Text white-50',
                ),
                'required' => array( 'sections-footer-color-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-footer-color-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Select Color', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-footer-color-type', '=', '2' ),
                'output'         => array( '#footer' ),
                'mode'     => 'color',
            ),
            array(
                'id'       => 'sections-footer-link-color',
                'type'     => 'link_color',
                'title'    => __('Links Color Option', 'redux-framework-demo'),
                'validate' => 'color',
                'output'         => array( '#footer a' ),
            ),
            array(
                'id'       => 'sections-footer-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Section Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Default Colors',
                    '2' => 'Custom Colors'
                ),
                'default'  => '1',
            ),
            array(
                'id'       => 'sections-footer-background',
                'type'     => 'select',
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'bg-primary' => 'Primary Background',
                    'bg-secondary' => 'Secondary Background',
                    'bg-success' => 'Success Background',
                    'bg-danger' => 'Danger Background',
                    'bg-warning' => 'Warning Background',
                    'bg-info' => 'Info Background',
                    'bg-light' => 'Light Background',
                    'bg-dark' => 'Dark Background',
                    'bg-white' => 'White Background',
                    'bg-transparent' => 'Transparent Background',
                ),
                'required' => array( 'sections-footer-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-footer-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-footer-background-type', '=', '2' ),
                'output'         => array( '#footer' ),
                'mode'     => 'background-color',
            ),
            array(
                'id'       => 'sections-footer-bg',
                'type'     => 'background',
                'output'   => array( '#footer' ),
                'title'    => __( 'Default Background', 'redux-framework-demo' ),
                'background-color' => false
            ),
        )
    ) );     	

	/*
    if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
        $section = array(
            'icon'   => 'el el-list-alt',
            'title'  => __( 'Documentation', 'redux-framework-demo' ),
            'fields' => array(
                array(
                    'id'       => '17',
                    'type'     => 'raw',
                    'markdown' => true,
                    'content_path' => dirname( __FILE__ ) . '/../README.md', // FULL PATH, not relative please
                    //'content' => 'Raw content here',
                ),
            ),
        );
        Redux::setSection( $opt_name, $section );
    }
	*/
    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /*
    *
    * --> Action hook examples
    *
    */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $field['msg']    = 'your custom error message';
                $return['error'] = $field;
            }

            if ( $warning == true ) {
                $field['msg']      = 'your custom warning message';
                $return['warning'] = $field;
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => __( 'Section via hook', 'redux-framework-demo' ),
                'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a clippingpath section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }

    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
/*    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }*/

