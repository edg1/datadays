<?php
function getOneFaq($params)
{
    extract(shortcode_atts(array(
            'id' => '',
        ), $params
    ));

    return renderFaqs(array(get_post($id, OBJECT)));
}
add_shortcode("get_faq", "getOneFaq");


function getLastestFaqs($params)
{
    extract(shortcode_atts(array(
            'number' => '1',
        ), $params
    ));

    return renderFaqs(query_posts(array(
            'post_type' => 'ait-faq',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => $number
        )
    ));
}
add_shortcode("get_faqs", "getLastestFaqs");


function getFaqsByCategory($params)
{
    extract(shortcode_atts(array(
            'category'    => '1',
            'number' => '1'
        ), $params
    ));

    if($category == 0){
        $cats = get_terms('ait-faq-category');
        $result = '';

        foreach($cats as $cat){
            $posts = query_posts(array(
                'post_type' => 'ait-faq',
                'orderby' => 'menu_order',
                'order' => 'ASC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'ait-faq-category',
                        'field' => 'id',
                        'terms' => $cat
                    )),
                'posts_per_page' => $number
            ));
            $result .= renderFaqs($posts, $cat->name, $cat->description);
        }

        return $result;
    } else {
        $cat = get_term($category, 'ait-faq-category');

        return renderFaqs(query_posts(array(
            'post_type' => 'ait-faq',
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'ait-faq-category',
                    'field' => 'id',
                    'terms' => $category
                )),
            'posts_per_page' => $number
            )
        ), $cat->name, $cat->description);
    }


}
add_shortcode("get_faqs_category", "getFaqsByCategory");


function renderFaqs(array $faqs, $heading = null, $catDescription = null)
{
    $result = '';

    $result .= '<div class="ait-faqs">';

        $result .= $heading !== null ? '<h3 class="faq-category-title">' . $heading . '</h3>' : '';
        $result .= $catDescription !== null ? '<div class="faq-category-description"><p>' . $catDescription . '</p></div>' : '';

        $result .= '<div class="faqs-container">';
            foreach ($faqs as $faq) {
                $result .= '<div class="one-faq">';
                    $result .= '<div class="faq-header">' . '<span class="q">Q:&nbsp;</span><h4 class="faq-title">' . $faq->post_title . '</h4></div>';
                    $result .= '<div class="faq-content">' . $faq->post_content . '</div>';
                $result .= '</div>';        // /.one-faq
            }
        $result .= '</div>';                // /.faqs-container

    $result .= '</div>';                    // /.ait-faqs
    return $result;
}
