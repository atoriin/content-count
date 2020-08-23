<?php
/**
* @package Content Count
* @version 1.0
*/
/*
Plugin Name: Content Count
Plugin URI: https://webeer.tech/content-count
Description: 管理画面に記事の文字数を表示する
Author: atori
Version: 1.0
Author URI: https://webeer.tech
*/
function lsd_manage_posts_columns( $columns ) {
  
  $columns = array_merge(
              $columns, 
              array( 'content_count' => '文字数' ) 
            );

  return $columns;
}
add_filter( 'manage_posts_columns', 'lsd_manage_posts_columns' );

function lds_manage_posts_custom_column( $column, $post_id ) {

  $c = strip_tags( strip_shortcodes( get_the_content( $post_id ) ) );
  $c = mb_strlen( $c );
  $c = number_format( $c );

  switch ( $column ) {
      case 'content_count' :
          echo $c;
          break;
  }
}
add_action( 'manage_posts_custom_column', 'lds_manage_posts_custom_column', 10, 2 );