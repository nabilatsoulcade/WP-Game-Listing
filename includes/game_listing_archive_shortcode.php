<?php

//Event Viewer Function
function game_listing_archive_display($atts){
$returnvalue = "";

//Get Games Custom Post type
$args = array(
  'post_type'   => 'game'
);
$games = get_posts($args);

// Check if there are any games and if so, display them
if( !empty($games) ){
    $returnvalue .= '<div class="game-listing-archive">';
    foreach( $games as $game ){
        //Get Game Listing Info
        $post_id = $game->ID;
        $game_featured_image = get_the_post_thumbnail($post_id, array( 300, 200));
        $game_title = get_the_title($post_id);
        $game_excerpt = get_post_meta($post_id, "excerpt_32125", true);
        $game_url = get_permalink($post_id);

        $windows_link = game_listing_to_icon('https://windows.com', 'Windows');
        $macos_link = game_listing_to_icon(get_post_meta($post_id, "macos_32147", true), "MacOs");
        $linux_link = game_listing_to_icon(get_post_meta($post_id, "linux_18351", true), "Linux");
        $xbox_one_link = game_listing_to_icon(get_post_meta($post_id, "xboxone_45137", true), "Xbox One");
        $playstation4_link = game_listing_to_icon(get_post_meta($post_id, "playstation4_94115", true), "PlayStation 4");
        $nintendo_switch_link = game_listing_to_icon(get_post_meta($post_id, "nintendoswitch_65714", true), "Nintendo Switch");
        $xbox_360_link = game_listing_to_icon(get_post_meta($post_id, "xbox361_49697", true), "Xbox 360");
        $playstation_3_link = game_listing_to_icon(get_post_meta($post_id, "playstation3_62445", true), "PlayStation 3");
        $nintendo_wii_link = game_listing_to_icon(get_post_meta($post_id, "nintendowii_52498", true), "Nintendo Wii");
        $nintendo_ds_link = game_listing_to_icon(get_post_meta($post_id, "nintendods_23911", true), "Nintendo DS");
        $playstation_vita_link = game_listing_to_icon(get_post_meta($post_id, "playstationvita_52129", true), "PlayStation Vita");
        $android_link = game_listing_to_icon(get_post_meta($post_id, "android_52129", true), "Android");
        $iphone_link = game_listing_to_icon(get_post_meta($post_id, "iphone_52129", true), "Ios");

        //var_dump($windows_link);
        //var_dump(game_listing_to_icon(get_post_meta($post_id, "xboxone_45137", true), "Xbox One"));
        $platform_links_with_icons = $windows_link . $macos_link . $linux_link . $xbox_one_link . $playstation4_link . $nintendo_switch_link . $xbox_360_link . $playstation_3_link . $nintendo_wii_link . $nintendo_ds_link . $playstation_vita_link . $iphone_link . $android_link;
        //Print each listing
        $returnvalue .= '<div class="game-listing-element">';
        //Left Column
            $returnvalue .= '<div class="game-listing-thumbnail" style="float:left; width:20%;">';
                //Print Game Featured Image
                $returnvalue .= '<a href="' . $game_url . '">' . $game_featured_image . '</a>';
            $returnvalue .= '</div>';
        //Right Column
            $returnvalue .= '<div class="game-listing-info" style="float:left; width:78.5%;padding-left:2.5%;">';
                //Print Game Title
                $returnvalue .= '<a href="' . $game_url . '">' . '<h2 class="game-listing-title">' . $game_title . '</h2></a>';
                //Print Game Platforms with Icons
                $returnvalue .= '<div class="game-listing-platforms">' . $platform_links_with_icons . '</div>';
                //Print Game Description
                $returnvalue .= '<p class="game-listing-excerpt">' . $game_excerpt .'</p>';
            $returnvalue .= '</div>';

        $returnvalue .= '</div>';
    }
    $returnvalue .= '</div>';
}
return $returnvalue;
}
//Add Shortcode to Wordpress
add_shortcode('game_archive', 'game_listing_archive_display');
?>
