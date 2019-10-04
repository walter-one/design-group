<?php

	require_once TT::file_require( get_template_directory().'/framework/classes/class.tgm.plugin.activation.php');
	add_action( 'tgmpa_register', 'themeton_register_required_plugins' );

	function themeton_register_required_plugins() {

		/**
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(
            array(
                'name'              => 'Envato Market',
                'slug'              => 'envato-market',
                'source'            => esc_url('https://github.com/envato/wp-envato-market/archive/master.zip')
            ),
            array(
                'name'                  => 'Visual Composer',
                'slug'                  => 'js_composer',
                'source'                => get_template_directory().'/includes/plugins/js_composer.zip',
                'required'              => true,
                'version'               => '6.0.5',
                'force_activation'      => false,
                'force_deactivation'    => false,
                'external_url'          => '',
            ),
            array(
                'name'                  => 'Revolution Slider',
                'slug'                  => 'revslider',
                'source'                => get_template_directory().'/includes/plugins/revslider.zip',
                'required'              => false,
                'version'               => '6.1.0',
                'force_activation'      => false,
                'force_deactivation'    => false,
                'external_url'          => '',
            ),
            array(
                'name'                  => 'Portfolio Post Type for ThemeTon themes',
                'slug'                  => 'themeton-portfolio',
                'source'                => get_template_directory().'/includes/plugins/themeton-portfolio.zip',
                'required'              => false,
                'version'               => '1.1',
                'force_activation'      => false,
                'force_deactivation'    => false,
                'external_url'          => '',
            )
		);


	$config = array(
        'id'           => 'themeton_tgm',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'install-required-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => esc_html__( 'Install Required Plugins', 'acerola' ),
            'menu_title'                      => esc_html__( 'Install Plugins', 'acerola' ),
            'installing'                      => esc_html__( 'Installing Plugin: %s', 'acerola' ), // %s = plugin name.
            'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'acerola' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'acerola' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'acerola' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'acerola' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'acerola' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'acerola' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'acerola' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'acerola' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'acerola' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'acerola' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'acerola' ),
            'return'                          => esc_html__( 'Return to Required Plugins Installer', 'acerola' ),
            'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'acerola' ),
            'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'acerola' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );
 
    tgmpa( $plugins, $config );
 
}
       



?>