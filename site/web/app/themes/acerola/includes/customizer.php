<?php

if (!function_exists('tt_customizer_options')):

    function tt_customizer_options() {
        global $tt_sidebars;

        $template_uri = get_template_directory_uri();

        $pages = array();
        $all_pages = get_pages();
        foreach ($all_pages as $page) {
            $pages[$page->ID] = $page->post_title;
        }

        $option = array(
            // General
            array(
                'type' => 'section',
                'id' => 'section_general',
                'label' => 'General',
                'desc' => '',
                'controls' => array(
                    array(
                        'type' => 'font',
                        'id' => 'font-title',
                        'label' => 'Font: Titles and Metas',
                        'default' => getLessValue('font-title'),
                        'desc' => 'Titles, and meta texts.'
                    ),
                    array(
                        'type' => 'font',
                        'id' => 'font-text',
                        'label' => 'Font: Content text',
                        'default' => getLessValue('font-text'),
                        'desc' => 'Content text and small titles.'
                    ),
                    array(
                        'type' => 'color',
                        'id' => 'body-bg-color',
                        'label' => 'Background Color',
                        'default' => getLessValue('body-bg-color')
                    ),
                    array(
                        'type' => 'color',
                        'id' => 'header-bg-color',
                        'label' => 'Header background color',
                        'default' => getLessValue('header-bg-color')
                    ),
                    array(
                        'type' => 'color',
                        'id' => 'logo-color',
                        'label' => 'Logo color',
                        'default' => getLessValue('logo-color')
                    ),
                    array(
                        'type' => 'color',
                        'id' => 'menu-color',
                        'label' => 'Menu color',
                        'default' => getLessValue('menu-color')
                    ),
                    array(
                        'type' => 'color',
                        'id' => 'menu-hover-color',
                        'label' => 'Menu hover color',
                        'default' => getLessValue('menu-hover-color')
                    )

                )
            ),// end General
             // Fonts
            array(
                'type' => 'section',
                'id' => 'font',
                'label' => 'Font',
                'desc' => '',
                'controls' => array(
                    
                    array(
                        'type' => 'font',
                        'id' => 'font-title',
                        'label' => 'Title Font',
                        'default' => getLessValue('font-title')
                    ),
                    array(
                        'type' => 'font',
                        'id' => 'font-text',
                        'label' => 'Text Font',
                        'default' => getLessValue('font-text')
                    ),
                    array(
                        'type' => 'font',
                        'id' => 'menu-font',
                        'label' => 'Menu Font',
                        'default' => getLessValue('menu-font')
                    ),
                    
                )
            ),
            // Branding & Logo
            array(
                'type' => 'section',
                'id' => 'section_header_style',
                'label' => 'Brand Logo',
                'desc' => '',
                'controls' => array(
                    array(
                        'type' => 'image',
                        'id' => 'logo',
                        'label' => 'Logo Image',
                        'default' => ''
                    ),

                    array(
                        'id' => 'favicon',
                        'label' => 'Favicon',
                        'desc' => '16x16 pixel, PNG/ICO/JPG',
                        'default' => $template_uri . "/img/favicon.ico",
                        'type' => 'image'
                    ),
                    array(
                        'type' => 'image',
                        'id' => 'logo_admin',
                        'label' => 'Login Page Logo',
                        'desc' => 'Up to 274x95px',
                        'default' => ''
                    ),
                )
            ),// end Branding
            
            
            // Page Title
            array(
                'type' => 'section',
                'id' => 'page_title',
                'label' => 'Page Title',
                'controls' => array(
                    array(
                        'id' => 'page_title_height',
                        'label' => 'Title Height',
                        'default' => '200',
                        'type' => 'pixel'
                    ),
                    array(
                        'id' => 'page_title_image',
                        'label' => 'Background Image',
                        'default' => '',
                        'type' => 'bg_image'
                    )
                ),
            ), //end Page Title
            
            // Footer
            array(
                'type' => 'section',
                'id' => 'section_footer',
                'label' => 'Footer',
                'controls' => array(
                    array(
                        'id' => 'footer',
                        'label' => 'Enable Footer',
                        'default' => '1',
                        'type' => 'switch'
                    ),
                    array(
                        'id' => 'footer_widget_num',
                        'label' => 'Footer Widget Style',
                        'default' => '4',
                        'type' => 'select',
                        'choices' => array('1' => 'Full', '2' => '2 Columns', '3' => '3 Columns', '4' => '4 Columns', '5' => '1/2 + 1/4 + 1/4', '6' => '1/4 + 1/4 + 1/2')
                    ),
                    array(
                        'id' => 'footer-text-color',
                        'label' => 'Footer Text Color',
                        'default' => getLessValue('footer-text-color'),
                        'type' => 'color'
                    ),
                    array(
                        'id' => 'footer-link-color',
                        'label' => 'Footer Link Color',
                        'default' => getLessValue('footer-link-color'),
                        'desc' => '10% darker for Hover color',
                        'type' => 'color'
                    ),
                    array(
                        'id' => 'copyright_content',
                        'label' => 'CopyRight Content',
                        'default' => '<span>&copy; 2015 <b>Acerola Theme</b> All right reserved.<br>Template by <a href="http://demo.themeton.com/acerola/">Themeton</a></span>',
                        'desc' => '',
                        'type' => 'textarea'
                    ),
                ),
            ), // end Footer


            // Post Types
            array(
                'id' => 'panel_options',
                'label' => 'Post Types',
                'desc' => 'You can customize here mostly post type options including singular pages options.',
                'sections' => array(
                    // Post
                    array(
                        'id' => 'section_post',
                        'label' => 'Post',
                        'controls' => array(
                            array(
                                'id' => 'post_comment',
                                'label' => 'Post Comment',
                                'default' => 1,
                                'type' => 'switch'
                            ),
                            array(
                                'id' => 'post_nextprev',
                                'label' => 'Next/Prev links',
                                'default' => 1,
                                'type' => 'switch'
                            ),
                        ),
                    ),// end Post
                    // Page
                    array(
                        'id' => 'section_page',
                        'label' => 'Page',
                        'controls' => array(
                            array(
                                'id' => 'page_nextprev',
                                'label' => 'Next/Prev links',
                                'default' => 1,
                                'type' => 'switch'
                            ),
                        ),
                    ),// end Page

                    // Portfolio
                    array(
                        'id' => 'section_portfolio',
                        'label' => 'Portfolio',
                        'controls' => array(
                            array(
                                'id' => 'portfolio_label',
                                'label' => 'Portfolio Label',
                                'default' => 'Portfolio',
                                'type' => 'input'
                            ),
                            array(
                                'id' => 'portfolio_slug',
                                'label' => 'Portfolio Slug',
                                'default' => 'portfolio-item',
                                'type' => 'input'
                            ),
                            array(
                                'id' => 'portfolio_sbar',
                                'label' => 'Layout',
                                'default' => 'full',
                                'type' => 'select',
                                'choices' => array('full' => 'No sidebar', 'left' => 'Left sidebar', 'right' => 'Right sidebar')
                            ),
                            
                            array(
                                'id' => 'sub_portfolio_single',
                                'type' => 'sub_title',
                                'label' => 'Single Post Options',
                                'default' => ''
                            ),
                            array(
                                'id' => 'portfolio_related',
                                'label' => 'Related Posts',
                                'default' => 1,
                                'type' => 'switch'
                            ),
                            array(
                                'id' => 'portfolio_comment',
                                'label' => 'Comment',
                                'default' => 0,
                                'type' => 'switch'
                            ),
                            array(
                                'id' => 'portfolio_nextprev',
                                'label' => 'Next/Prev links',
                                'default' => 1,
                                'type' => 'switch'
                            ),
                            array(
                                'id' => 'portfolio_page',
                                'label' => 'Portfolio Main Page',
                                'default' => 'pages',
                                'type' => 'select',
                                'choices' => array('0' => "Choose your page:") + $pages
                            ),
                        ),
                    )// end Portfolio
                )
            ),// end Post Types
            // Extras
            array(
                'id' => 'panel_extra',
                'label' => 'Extras',
                'desc' => 'Export Import and Custom CSS.',
                'sections' => array(
                    // Backup
                    array(
                        'type' => 'section',
                        'id' => 'section_backup',
                        'label' => 'Export/Import',
                        'desc' => '',
                        'controls' => array(
                            array(
                                'id' => 'backup_settings',
                                'label' => 'Export Data',
                                'desc' => 'Copy to Customizer Data',
                                'default' => '',
                                'type' => 'backup'
                            ),
                            array(
                                'id' => 'import_settings',
                                'label' => 'Import Data',
                                'desc' => 'Import Customizer Exported Data',
                                'default' => '',
                                'type' => 'import'
                            )
                        )
                    ), // end backup
                    // Custom
                    array(
                        'type' => 'section',
                        'id' => 'section_custom_css',
                        'label' => 'Custom CSS',
                        'desc' => '',
                        'controls' => array(
                            array(
                                'id' => 'custom_css',
                                'label' => 'Custom CSS (general)',
                                'default' => '',
                                'type' => 'textarea'
                            ),
                            array(
                                'id' => 'custom_css_tablet',
                                'label' => 'Tablet CSS',
                                'default' => '',
                                'type' => 'textarea',
                                'desc' => 'Screen width between 768px and 991px.'
                            ),
                            array(
                                'id' => 'custom_css_widephone',
                                'label' => 'Wide Phone CSS',
                                'default' => '',
                                'type' => 'textarea',
                                'desc' => 'Screen width between 481px and 767px. Ex: iPhone landscape.'
                            ),
                            array(
                                'id' => 'custom_css_phone',
                                'label' => 'Phone CSS',
                                'default' => '',
                                'type' => 'textarea',
                                'desc' => 'Screen width up to 480px. Ex: iPhone portrait.'
                            ),
                        )
                    ) // end Custom
                )
            ) // end Extras
        );

        return $option;
    }

endif;

// create instance of TT Theme Customizer
new TT_Theme_Customizer();
