<?php

class TT_VC_Templates{

    function __construct(){
        add_filter( 'vc_load_default_templates', array($this, 'custom_template_for_vc') );
    }

    public function custom_template_for_vc($templates){
        $data               = array();
        $data['name']       = esc_html__( '01: Portfolio Single Layout', 'acerola' );
        $data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri()."/images/blocks/vc-folio.png" );
        $data['custom_class'] = 'tt_vc_templates-1';
        $data['content'] = <<<CONTENT
[vc_row full_width="" parallax="" parallax_image="" one_page_section="no" one_page_label="" one_page_slug=""][vc_column width="2/3" horizontal_align="none" vertical_align="none"][vc_gallery type="flexslider_slide" interval="3" images="1515,1516" onclick="link_image" custom_links_target="_self" img_size="760x390"][vc_column_text]
<h4>DESCRIPTION</h4>
Donec blandit lorem vitae eros sollicitudin, a imperdiet tortor bibendum. Quisque sodales nisl a ante auctor tristique. Ut at elit aliquam ligula eleifend commodo. Sed id fermentum nibh. Pellentesque suscipit lectus risus, in blandit ante congue laoreet. Suspendisse potenti. Aliquam non arcu imperdiet, pulvinar libero eleifend, vulputate nunc.

Nulla sodales quam eu nulla vestibulum, vitae tincidunt felis pellentesque. Integer iaculis placerat quam, eu aliquam diam commodo nec. Aliquam sodales ultrices tortor vitae imperdiet. Donec tincidunt purus id sem lacinia ultrices. Donec eget vulputate enim, eget blandit arcu. Sed euismod sem eget ante tincidunt ornare. Nunc nibh nisl, bibendum non leo at.
<h4>PROJECT GOAL</h4>
Phasellus id dapibus justo. Donec non nunc pharetra orci dapibus hendrerit in quis magna. Vestibulum erat dolor, rhoncus eu euismod tempus, ultrices pellentesque mi. Sed lorem mi, finibus et augue quis, lacinia ultrices magna. Duis velit neque, hendrerit in varius sit amet, aliquet id justo. Etiam semper nisi vel mattis venenatis.

<i>Curabitur ligula quam, aliquam id tempor et, placerat eget erat. Praesent blandit erat eleifend, aliquet ex in, dapibus arcu. In eu quam eget arcu condimentum interdum.</i>[/vc_column_text][/vc_column][vc_column width="1/3" horizontal_align="none" vertical_align="none"][vc_column_text]
<h4>About Project</h4>
Phasellus at tincidunt lacus. Fusce luctus vulputate augue sed viverra. Integer vitae dolor ex. Morbi non dui viverra, ullamcorper tortor sed, sodales sem. Cras varius sit amet libero eget facilisis. Morbi at laoreet sem, a condimentum.
<h4>Project Info</h4>
Client:                  <strong>Bryan Keith</strong>
Location:             <strong>Melbourne, VIC</strong>
Start date:           <strong>Feb 12th, 2015</strong>
Finish date:        <strong>Mar 27th, 2015</strong>
Surface area:      <strong>100 m2</strong>
Value:                  <strong>Private</strong>[/vc_column_text][/vc_column][/vc_row]
CONTENT;

        array_unshift( $templates, $data );

        return $templates;

    }

}

if( function_exists('vc_map') )
    new TT_VC_Templates();