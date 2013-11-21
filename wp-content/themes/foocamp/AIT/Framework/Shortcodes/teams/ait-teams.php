<?php
// Member by id
function get_custom_team( $params ) {
    extract( shortcode_atts( array (
        'id' => '',
        'icons' => '1'
    ), $params ) );

    global $teamOptions;
    $result = '';
    $member = get_post($id, OBJECT);
    if(isset($member->ID) && !empty($member->ID)){
        $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($member->ID) );
        $options = $teamOptions->the_meta($member->ID);;
        $result .= '<div class="ait-teams">';
        $result .= '<div class="single-member clearfix clear">';
        $result .= '<div class="cssfeature scale">';
            $result .= '<div class="border-light-thin image-wrap grey-bg">';
                $result .= '<a href="'.$thumbnail.'" class="block cboxElement"><img src="'.AitImageResizer::resize($thumbnail, array('w' => 215, 'h' => 163)).'" alt="'.$member->post_title.'" title="'.$member->post_title.'" class="alignnone block clearmargin size-full"></a>';
                if($icons == "yes"){
                $result .= '<div class="lawyer-buttons social-buttons" style="text-align: center;">';
                    $result .= '<div class="social-holder" style="display: inline-block; margin: 13px 0 8px;">';
                        for($i = 1; $i < 8; $i++){
                            if(isset($options['socialIcon'.$i.'Image']) && !empty($options['socialIcon'.$i.'Image'])){
                                $result .= '<a href="'.$options['socialIcon'.$i.'Link'].'"><img src="'.$options['socialIcon'.$i.'Image'].'" class="social-button inline-block" style="margin: 0 5px 0 5px;" alt=""></a>';
                            }
                        } 
                    $result .= '</div>';
                $result .= '</div>';
                }
            $result .= '</div>';

            $result .= '<div class="member-name" style="text-align: center">';
                $result .= '<h3 style="margin: 10px 0 3px;">'.$member->post_title.'</h3>';
                $result .= '<p><span class="fancyFont" style="font-size: 14px; color: #444;">'.$options['specialization'].'</span></p>';
            $result .= '</div>';
        $result .= '</div>';
        $result .= '</div>';
        $result .= '</div>';
    }

    return $result;
}
add_shortcode( "get_team", "get_custom_team" );

// Latest added members
function get_custom_teams( $params ) {
    extract( shortcode_atts( array (
        'number' => '1',
        'icons' => '1'
    ), $params ) );

    global $teamOptions;
    $result = '';
    $members = query_posts(array('post_type' => 'ait-team', 'orderby' => 'menu_order', 'order' => 'DESC', 'posts_per_page' => $number));

    $counter = 1;
    $result .= '<div class="ait-teams">';
    foreach($members as $member){
        $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($member->ID) );
        $options = $teamOptions->the_meta($member->ID);

        /* RENDER STARTED */
        if(($counter % 3 == 0 && $counter != 0) && ($counter % 2 == 0 && $counter != 0)){
            $result .= '<div class="single-member clearfix second third' . fourth($counter) . '">';
        } else if($counter % 3 == 0 && $counter != 0){
            $result .= '<div class="single-member clearfix third' . fourth($counter) . '">';
        } else if($counter % 2 == 0 && $counter != 0){
            $result .= '<div class="single-member clearfix second' . fourth($counter) . '">';
        } else {
            $result .= '<div class="single-member clearfix' . fourth($counter) . '">';
        }
            $result .= '<div class="cssfeature scale">';
            $result .= '<div class="border-light-thin image-wrap grey-bg">';
                $result .= '<a href="'.$thumbnail.'" class="block cboxElement"><img src="'.AitImageResizer::resize($thumbnail, array('w' => 217, 'h' => 163)).'" alt="'.$member->post_title.'" title="'.$member->post_title.'" class="alignnone block clearmargin size-full"></a>';
                if($icons == "yes"){
                $result .= '<div class="lawyer-buttons social-buttons">';
                    $result .= '<div class="social-holder" style="text-align: center; margin: 13px 0 8px;">';
                        for($i = 1; $i < 8; $i++){
                            if(isset($options['socialIcon'.$i.'Image']) && !empty($options['socialIcon'.$i.'Image'])){
                                $result .= '<a href="'.$options['socialIcon'.$i.'Link'].'"><img src="'.$options['socialIcon'.$i.'Image'].'" class="social-button inline-block" style="margin: 0 5px 0 5px;" alt=""></a>';
                            }
                        }
                    $result .= '</div>';
                $result .= '</div>';
                }
            $result .= '</div>';

            $result .= '<div class="member-name" style="text-align: center">';
                $result .= '<h3 style="margin: 10px 0 3px;">'.$member->post_title.'</h3>';
                $result .= '<p><span class="fancyFont" style="font-size: 14px; color: #444;">'.$options['specialization'].'</span></p>';
            $result .= '</div>';
        $result .= '</div>';
        $result .= '</div>';
        /* RENDER ENDED */

        $counter++;
    }
    $result .= '</div>';
    wp_reset_query();

    return $result;
}
add_shortcode( "get_teams", "get_custom_teams" );

// Members from specific team
function get_category_teams( $params ) {
    extract( shortcode_atts( array (
        'category' => '1',
        'number' => '1',
        'icons' => 'yes'
    ), $params ) );

    global $teamOptions;
    $result = '';
    $members = query_posts(array('post_type' => 'ait-team', 'orderby' => 'menu_order', 'order' => 'ASC', 'posts_per_page' => $number, 'tax_query' => array(array( 'taxonomy' => 'ait-team-category', 'field' => 'id', 'terms' => $category))));

    $counter = 1;
    $result .= '<div class="ait-teams">';
    foreach($members as $member){
        $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($member->ID) );
        $options = $teamOptions->the_meta($member->ID);

        /* RENDER STARTED */
        if(($counter % 3 == 0 && $counter != 0) && ($counter % 2 == 0 && $counter != 0)){
            $result .= '<div class="single-member clearfix second third' . fourth($counter) . '">';
        } else if($counter % 3 == 0 && $counter != 0){
            $result .= '<div class="single-member clearfix third' . fourth($counter) . '">';
        } else if($counter % 2 == 0 && $counter != 0){
            $result .= '<div class="single-member clearfix second' . fourth($counter) . '">';
        } else {
            $result .= '<div class="single-member clearfix' . fourth($counter) . '">';
        }
        $result .= '<div class="cssfeature scale">';
            $result .= '<div class="border-light-thin image-wrap grey-bg">';
                if(isset($options['link'])){
                    $result .= '<a href="'.$options['link'].'" class="block cboxElement"><img src="'.AitImageResizer::resize($thumbnail, array('w' => 217, 'h' => 163)).'" alt="'.$member->post_title.'" title="'.$member->post_title.'" class="alignnone block clearmargin size-full"></a>';
                } else {
                    $result .= '<a href="'.$thumbnail.'" class="block cboxElement"><img src="'.AitImageResizer::resize($thumbnail, array('w' => 217, 'h' => 163)).'" alt="'.$member->post_title.'" title="'.$member->post_title.'" class="alignnone block clearmargin size-full"></a>';
                }
                if($icons == "yes"){
                $result .= '<div class="lawyer-buttons social-buttons">';
                    $result .= '<div class="social-holder" style="text-align: center; margin: 13px 0 8px;">';
                        for($i = 1; $i < 8; $i++){
                            if(isset($options['socialIcon'.$i.'Image']) && !empty($options['socialIcon'.$i.'Image'])){
                                $result .= '<a href="'.$options['socialIcon'.$i.'Link'].'"><img src="'.$options['socialIcon'.$i.'Image'].'" class="social-button inline-block" style="margin: 0 5px 0 5px;" alt=""></a>';
                            }
                        }
                    $result .= '</div>';
                $result .= '</div>';
                }
            $result .= '</div>';

            $result .= '<div class="member-name" style="text-align: center">';
                $result .= '<h3 style="margin: 10px 0 3px;">'.$member->post_title.'</h3>';
                $result .= '<p><span class="fancyFont" style="font-size: 14px; color: #444;">'.$options['specialization'].'</span></p>';
            $result .= '</div>';
        $result .= '</div>';
        $result .= '</div>';
        /* RENDER ENDED */

        $counter++;
    }
    $result .= '</div>';
    wp_reset_query();

    return $result;
}

function fourth($counter) {
    $result = '';
    if($counter % 4 == 0 && $counter != 0) {
        $result = ' fourth';
    }
    return $result;
}

add_shortcode( "get_teams_category", "get_category_teams" );