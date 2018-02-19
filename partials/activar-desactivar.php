<?php

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );


// Activación del plugin
function dcms_activar() {
	global $wpdb;
	$sql = "";

	// creamos la tabla de ejemplo
	if( $wpdb->get_var("SHOW TABLES LIKE 'wp_ejemplo_nonce'") != 'wp_ejemplo_nonce' ) {
			$sql = "CREATE TABLE wp_ejemplo_nonce (
	  					id int(11) NOT NULL AUTO_INCREMENT,
	  					title varchar(100) NOT NULL,
	  					description varchar(200) DEFAULT NULL,
	  					PRIMARY KEY (id)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;";
		}

	if ( ! empty( $sql) ) dbDelta( $sql );
		
}


// Desactivación del plugin
function dcms_desactivar() {
	global $wpdb;
	
	//Eliminamos la tabla de ejemplo
	$sql = "DROP TABLE IF EXISTS wp_ejemplo_nonce;";
	$wpdb->query($sql);
}

