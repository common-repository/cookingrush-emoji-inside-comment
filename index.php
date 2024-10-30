<?php
/**
 * CookingRush emoji inside comment 2023
 * @package           CookingRush emoji inside comment
 * @author            Jafar Naghizadeh
 * @copyright         2023 Cookingrush.net
 * @license           GPL-2.0-or-later
 * @wordpress-plugin
 * Plugin Name:       CookingRush emoji inside comment
 * Plugin URI:        https://cookingrush.net
 * Description:       Add emoji inside comment with just one touch. Developed by Jafar Naghizadeh with 💜 for wordpress ;) 2023.
 * Version:           1.2
 * Requires at least: 4.7
 * Requires PHP:      7.2
 * Author:            Jafar Naghizadeh
 * Author URI:        https://matisweb.com
 * Text Domain:       Cookingrushnet
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $cookingrush_matisweb_jafar_comment_db_version;
$cookingrush_matisweb_jafar_comment_db_version = '1.0';

include_once "includes/functions.php";
use cookingrush_net_comment_emoji\cookingrush_matisweb_jafar_comment_emoji as cookingrush_net_comment;

if (!function_exists('cookingrush_matisweb_comment_form_field_comment')) {
    function cookingrush_matisweb_comment_form_field_comment( $field ){

        $cookingrush_cssname = "cr".md5(rand(0,99).rand(0,99).rand(0,99).rand(0,99));
        $matisweb_jafar_cookingrush_comment = new cookingrush_net_comment( $cookingrush_cssname, '🍭' );

        $list = $matisweb_jafar_cookingrush_comment->cookingrush_emojilist();
        $btn = $matisweb_jafar_cookingrush_comment->cookingrush_btn();
        $field = str_replace( "<textarea ", "{$list}{$btn}<textarea ","$field" );
        $field = str_replace( "</textarea>","</textarea></span>","$field" );
        $comment_field = "{$field}";

        cookingrush_matisweb_comment_form_add_js_css( $matisweb_jafar_cookingrush_comment );

        return $comment_field;
    }

    add_filter( 'comment_form_field_comment', 
        'cookingrush_matisweb_comment_form_field_comment', 99, 1 );
}

if (!function_exists('cookingrush_matisweb_comment_form_add_js_css')) {
    function cookingrush_matisweb_comment_form_add_js_css( $matisweb_jafar_cookingrush_comment ){
        wp_register_script( 'cookingrush_matisweb_comment_form_js', '');
        wp_enqueue_script( 'cookingrush_matisweb_comment_form_js' );
        wp_add_inline_script( 'cookingrush_matisweb_comment_form_js', 
            $matisweb_jafar_cookingrush_comment->cookingrush_js() );

        wp_register_style( 'cookingrush_matisweb_comment_form_css', false );
        wp_enqueue_style( 'cookingrush_matisweb_comment_form_css' );
        wp_add_inline_style( 'cookingrush_matisweb_comment_form_css', 
            $matisweb_jafar_cookingrush_comment->cookingrush_css() );
    }
}


if (!function_exists('cookingrush_matisweb_jafar_comment_Deactivate')) {
    function cookingrush_matisweb_jafar_comment_Deactivate() {
        delete_option( 'cookingrush_matisweb_jafar_comment_db_version' );
    }
    register_deactivation_hook( __FILE__, 'cookingrush_matisweb_jafar_comment_Deactivate' );
}

if (!function_exists('cookingrush_matisweb_jafar_comment_install')) {
    function cookingrush_matisweb_jafar_comment_install() {
        global $cookingrush_matisweb_jafar_comment_db_version;
        add_option( 'cookingrush_matisweb_jafar_comment_db_version', $cookingrush_matisweb_jafar_comment_db_version );
    }
    register_activation_hook( __FILE__, 'cookingrush_matisweb_jafar_comment_install' );
}

