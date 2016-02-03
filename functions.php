<?php
/*------------ AGREGADOS EXTRAS -----------*/

/*ELIMINAR NOTIFICACION DE ACTUALIZACION PARA NO ADM*/
global $user_login;
get_currentuserinfo();
if ($user_login !== "admin") {
add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );}

//ELIMINAR EJECUCION DE CODIGO HTML EN COMMENTS
add_filter('pre_comment_content', 'wp_specialchars');

// Cambiar el pie de pagina del panel de Administración
function change_footer_admin() {echo '&copy;2016 Copyright EL INFORMADOR. Todos los derechos reservados - Web creada por <a href="http://www.elinformador.com.ve">El Informador</a>';}
add_filter('admin_footer_text', 'change_footer_admin');

// REMOVER GENERADOR DE META
remove_action('wp_head', 'wp_generator');
//remove_action('wp_head', 'rsd_link');
//remove_action('wp_head', 'wlwmanifest_link');
//remove_action('wp_head', 'index_rel_link');
//remove_action('wp_head', 'parent_post_rel_link', 10, 0);
//remove_action('wp_head', 'start_post_rel_link', 10, 0);
//remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

// ACTUALIZAR GITHUB
function github_check_update( $transient ) {
$usergithub=farkbarn;
$ramastable=master;
    if ( empty( $transient->checked ) ) {
        return $transient;
    }
    $theme_data = wp_get_theme(wp_get_theme()->template);
    $theme_slug = $theme_data->get_template();
    $theme_uri_slug = preg_replace('/-'.$ramastable.'$/', '', $theme_slug);
   $remote_version = '0.0.0';
   $style_css = wp_remote_get("https://raw.githubusercontent.com/".$usergithub."/".$theme_uri_slug."/".$ramastable."/style.css")['body'];
   if ( preg_match( '/^[ \t\/*#@]*' . preg_quote( 'Version', '/' ) . ':(.*)$/mi', $style_css, $match ) && $match[1] )
       $remote_version = _cleanup_header_comment( $match[1] );
   if (version_compare($theme_data->version, $remote_version, '<')) {
       $transient->response[$theme_slug] = array(
           'theme'       => $theme_slug,
           'new_version' => $remote_version,
           'url'         => 'https://github.com/'.$usergithub.'/'.$theme_uri_slug,
           'package'     => 'https://github.com/'.$usergithub.'/'.$theme_uri_slug.'/archive/'.$ramastable.'.zip',
       );
   }
   return $transient;
}
add_filter( 'pre_set_site_transient_update_themes', 'github_check_update' );

?>
