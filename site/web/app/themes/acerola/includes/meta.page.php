<?php

if( !class_exists('CurrentThemePageMetas')) {
class CurrentThemePageMetas extends TTRenderMeta{

    function __construct(){
        $this->items = $this->items();
        add_action('admin_enqueue_scripts', array($this, 'print_admin_scripts'));
        add_action('add_meta_boxes', array($this, 'add_custom_meta'), 1);
        add_action('edit_post', array($this, 'save_post'), 99);
    }

    public function items(){
        global $post;

        define('ADMIN_IMAGES', get_template_directory_uri().'/framework/admin-assets/images/');

        $tmp_arr = array(
            'page' => array(
                'label' => 'Page Options',
                'post_type' => 'page',
                'items' => array(
                    array(
                        'type' => 'checkbox',
                        'name' => 'one_page_menu',
                        'label' => 'Page Menu by defined sections',
                        'default' => '0',
                        'desc' => 'Please edit the Visual Composer rows and set properties that need to be a section of your page. And page menu presents by them when you turned this option On.'
                    ),
                    array(
                        'type' => 'checkbox',
                        'name' => 'header_only_logo',
                        'label' => 'Header: Only show logo. Menu show when scroll page',
                        'default' => '0'
                    ),
                    array(
                        'name' => 'page_layout',
                        'type' => 'thumbs',
                        'label' => 'Page Layout',
                        'default' => 'full',
                        'option' => array(
                            'full' => ADMIN_IMAGES . '1col.png',
                            'right' => ADMIN_IMAGES . '2cr.png',
                            'left' => ADMIN_IMAGES . '2cl.png'
                        ),
                        'desc' => 'Select Page Layout (Fullwidth | Right Sidebar | Left Sidebar)'
                    ),
                    array(
                        'type' => 'checkbox',
                        'name' => 'title_show',
                        'label' => 'Title On Single',
                        'default' => '1',
                        'desc' => 'If your title image is so beautiful and you don\'t wanna put someting on that, you should turn this OFF and hide post title.'
                    ),
                    /* Start title options group
                    ===================================*/
                    array(
                        'type' => 'start_group',
                        'name' => 'title_options',
                        'visible' => true
                    ),
                    array(
                        'name' => 'page_title_height',
                        'type' => 'text',
                        'label' => 'Page Title Height',
                        'default' => '',
                        'desc' => 'Custom Page Title Sections height (px)'
                    ),
                    array(
                        'type' => 'background',
                        'name' => 'title_bg',
                        'label' => 'Title Background Image',
                        'default' => '',
                        'desc' => 'Custom Background image. If you want to show your title area beautiful, this option exactly you need.'
                    ),
                    array(
                        'name' => 'title_options',
                        'type' => 'end_group'
                    )
                    /* End title options group
                    ===================================*/
                )
            ),
            'portfolio' => array(
                'label' => 'Portfolio Options',
                'post_type' => 'portfolio',
                'items' => array(
                    array(
                        'type' => 'checkbox',
                        'name' => 'title_show',
                        'label' => 'Title On Single',
                        'default' => '1',
                        'desc' => 'If your title image is so beautiful and you don\'t wanna put someting on that, you should turn this OFF and hide post title.'
                    ),
                    array(
                        'name' => 'page_title_height',
                        'type' => 'text',
                        'label' => 'Page Title Height',
                        'default' => '',
                        'desc' => 'Page Title Sections height (px)'
                    ),
                    array(
                        'type' => 'background',
                        'name' => 'title_bg',
                        'label' => 'Title Background Image',
                        'default' => '',
                        'desc' => 'If you want to show your title area beautiful, this option exactly you need.'
                    ),
                    array(
                        'name' => 'title_options',
                        'type' => 'end_group'
                    )
                    /* End title options group
                    ===================================*/
                )
            ),
        );

        return $tmp_arr;
    }
    
}
}
new CurrentThemePageMetas();