<?php 
/*
Plugin Name: Ejemplo Nonce
Description: Plugin para mostrar cómo funciona el Nonce de WordPress
Version:     1.0
Author:      Jhon Marreros Guzmán
Author URI:  http://decodecms.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

include_once 'partials/activar-desactivar.php';


//Activación y desactivación del plugin
register_activation_hook( __FILE__, 'dcms_activar' );
register_deactivation_hook( __FILE__, 'dcms_desactivar' );




// Creación del menú
add_action( 'admin_menu', 'dcms_plugin_menu' );

function dcms_plugin_menu() {
	add_options_page( 'Formulario Plugin', 'Ejemplo Nonce', 'manage_options', 'dcms_ejemplo_nonce', 'dcm_plugin_form' );
}


function dcm_plugin_form() {
	include_once 'partials/ejemplo-nonce-view.php';
}






// Funcionalidad Ajax

add_action('admin_enqueue_scripts', 'dcms_insertar_js');

function dcms_insertar_js(){

	wp_register_script('dcms_miscript', plugin_dir_url( __FILE__ ) . '/js/script.js', array('jquery'), '1', true );
	wp_enqueue_script('dcms_miscript');

	wp_localize_script('dcms_miscript','dcms_vars',[ 'ajaxurl' => admin_url('admin-ajax.php'),
													 'nonce' => wp_create_nonce('ejemplo-nonce') ]);
}


add_action('wp_ajax_dcms_ajax_insertar','dcms_insertar_contenido');
function dcms_insertar_contenido()
{
	global $wpdb;

	if ( isset($_REQUEST['title']) ){

		// check_ajax_referer( 'ejemplo-nonce', 'nonce');

		if ( ! wp_verify_nonce(  $_REQUEST['nonce'], 'ejemplo-nonce' ) ) {
			echo "Error - Verificación nonce no válida ✋";
			wp_die();
		}

		$data['title'] = $_REQUEST['title'];
		$data['description'] = $_REQUEST['description'];
		$wpdb->insert( 'wp_ejemplo_nonce' , $data );
	}

	echo "Se insertó correctamente";
	wp_die();
}






