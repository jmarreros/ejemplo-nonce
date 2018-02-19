<?php

	global $wpdb;

	if ( isset($_REQUEST['title']) ){

		// check_admin_referer( 'ejemplo-nonce', 'nonce' );

		if ( ! wp_verify_nonce(  $_REQUEST['nonce'], 'ejemplo-nonce' ) ) {
			wp_die("Error - Verificación nonce no válida ✋");
		}

		$data['title'] = $_REQUEST['title'];
		$data['description'] = $_REQUEST['description'];

		$wpdb->insert( 'wp_ejemplo_nonce' , $data );
	}
?>
<p>
	<strong>Ejemplo Nonce Formulario: </strong>
</p>

<form id="ejemplo-form" method="post" action="<?php echo admin_url('options-general.php?page=dcms_ejemplo_nonce'); ?>">
		
		<table class="form-table">
		<tbody>
			<tr>
				<th scope="row"><label for="title">Titulo</label></th>
				<td><input name="title" id="title" value="" class="regular-text" type="text" required> * </td>
			</tr>
			<tr>
				<th scope="row"><label for="description">Descripción</label></th>
				<td><input name="description" id="description" value="" class="regular-text" type="text" ></td>
			</tr>
		</tbody>
		</table>

		<p class="submit">
			<?php wp_nonce_field( 'ejemplo-nonce', 'nonce' ); ?>	
			<input type="submit" name="submit" value="Enviar" id="submit" class="button button-primary">
		</p>

	</form>

<br>
<hr>
<br>

<p>
	<strong>Ejemplo Nonce URL: </strong>

	<?php 
		$url = add_query_arg( array ('title' => 'Titulo prueba url', 
									 'description' => 'descripcion prueba url') );
		$url = wp_nonce_url( $url, 'ejemplo-nonce', 'nonce');
	?>

	<a href="<?php echo esc_url($url) ?>" >Agregar registro</a>
</p>


<br>
<hr>
<br>

<p>
	<strong>Ejemplo Nonce Ajax: </strong> 
	<a id="link-ajax" href="#" class="button button-primary">Enviar Form</a>
</p>

