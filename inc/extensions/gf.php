<?php
/* Put a unique ID on Gravity Form (single form ID) entries.
----------------------------------------------------------------------------------------*/
define('PV_GF_HOJARUTA_FORM_ID', '5');
define('PV_GF_HOJARUTA_TRANSIENT', 'lock_hoja_ruta');

// function pv_actualizar_num_hoja_ruta( $entry, $form ) {
//     // Check for the correct form based on form id
//     if ( $form['id'] != PV_GF_HOJARUTA_FORM_ID ) {
//         return $entry;
//     }

// 	// Lock name based on post ID and meta key
//     $lock_name = PV_GF_HOJARUTA_TRANSIENT;

//     // Try to acquire the lock
//     if (get_transient($lock_name)) {
//         // Unable to acquire lock, maybe try again later
//         return false;
//     }

//     // Set a transient to act as a lock
//     set_transient($lock_name, true, 5); // Lock for 10 seconds

//     // Assuming that the field ID to be updated is 2
//     $field_id = '33';
// 	$entry[$field_id] = pv_obtener_numero_unico_hoja_ruta( $form['id'], $field_id );

//     // Update the entry
//     GFAPI::update_entry_field( $entry['id'], $field_id, $entry[$field_id] );

// 	// Release the lock
//     delete_transient($lock_name);

//     return $entry;
// }
// add_action( 'gform_entry_post_save', 'pv_actualizar_num_hoja_ruta', 10, 2 );

// function validate_lock_transient($validation_result) {
//     $form = $validation_result['form'];
// 	if ( $form['id'] != PV_GF_HOJARUTA_FORM_ID ) {
//         return $validation_result;
//     }

//     $lock_name = PV_GF_HOJARUTA_TRANSIENT;

//     // Check if the lock exists
//     if (get_transient($lock_name)) {
//         // Lock exists, set the form validation to false
//         $validation_result['is_valid'] = false;

//         // Add a general error message to the form
//         $form['validation_message'] = 'Nuestro sistema está con alta concurrencia. Por favor intente nuevamente en unos minutos.';
//     }

//     // Assign our modified $form object back to the validation result
//     $validation_result['form'] = $form;

//     return $validation_result;
// }
// add_filter('gform_validation', 'validate_lock_transient');

// /**
//  * Get the next unique number for a given form and field
//  *
//  * @param int $form_id
//  * @param int $field_id
//  *
//  * @return int
//  */
// function pv_obtener_numero_unico_hoja_ruta($form_id, $field_id) {
//     global $wpdb;

// 	$query = $wpdb->prepare( "SELECT MAX(meta_value) + 1 AS num_hoja_ruta FROM " . $wpdb->prefix . "gf_entry_meta WHERE form_id = %d AND meta_key = %d", $form_id, $field_id );
//     $result = $wpdb->get_var( $query );
//     if( empty($result) ) {
// 		return 200000;
// 	}
//     return $result;
// }
function pv_actualizar_num_hoja_ruta( $entry, $form ) {
    // Check for the correct form based on form id
    if ( $form['id'] != PV_GF_HOJARUTA_FORM_ID ) {
        return $entry;
    }

    // Assuming that the field ID to be updated is 2
    $field_id = '33';
	$entry[$field_id] = pv_guardar_numero_unico_hoja_ruta( $form['id'], $entry['id'], $field_id );

    return $entry;
}
add_action( 'gform_entry_post_save', 'pv_actualizar_num_hoja_ruta', 10, 2 );


/**
	 * Safely generates and assigns a sequential order number to an order.
	 *
	 * @internal
	 *
	 * @since 1.3
	 *
	 * @param int|\WC_Order $order order ID or object
	 * @param string $order_number_meta_name order number meta name, ie _order_number or _order_number_free
	 * @param int $route_number_start order number starting point
	 * @return bool true if a sequential order number was successfully generated and assigned
	 */
	function pv_guardar_numero_unico_hoja_ruta( $form_id, $entry_id, $field_id, $route_number_start = 200000 ) {
		global $wpdb;

		$success      = false;
		$order_number = null;

		for ( $i = 0; $i < 3 && ! $success; $i++ ) {


			// add $order_number_meta_name equal to $route_number_start if there are no existing orders with an $order_number_meta_name meta
			//  or $route_number_start is larger than the max existing $order_number_meta_name meta.  Otherwise, $order_number_meta_name
			//  will be set to the max $order_number_meta_name + 1
			$query = $wpdb->prepare( "
				INSERT INTO " . $wpdb->prefix . "gf_entry_meta (form_id,entry_id,meta_key,meta_value)
				SELECT %d,%d,%s,IF(MAX(CAST(meta_value AS SIGNED)) IS NULL OR MAX(CAST(meta_value AS SIGNED)) < %d, %d, MAX(CAST(meta_value AS SIGNED))+1)
					FROM " . $wpdb->prefix . "gf_entry_meta
					WHERE form_id = '{$form_id}' AND meta_key='{$field_id}'",
				$form_id, $entry_id, $field_id, $route_number_start, $route_number_start );

			$success = $wpdb->query( $query );
			if ( $success ) {
				// on success, get the newly created order number
				$order_number = $wpdb->get_var( $wpdb->prepare( "SELECT meta_value FROM " . $wpdb->prefix . "gf_entry_meta WHERE id = %d", $wpdb->insert_id ) );
				if ( null !== $order_number ) {
					return $order_number;
				}
			}
		}
		return 'n/a';
	}


function pv_actualizar_datos_agencia( $entry, $form ) {
    // Check for the correct form based on form id
    if ( $form['id'] != PV_GF_HOJARUTA_FORM_ID || ! get_current_user_id() || ! class_exists( 'GFAPI' ) ) {
        return $entry;
    }

	$current_user = wp_get_current_user();

    // Update the entry
	// Legajo
    GFAPI::update_entry_field( $entry['id'], 37, $current_user->get('user_login') );
	// Nombre de agencia
    GFAPI::update_entry_field( $entry['id'], 38, $current_user->get('display_name') );
	// CUIT
    GFAPI::update_entry_field( $entry['id'], 39, get_user_meta($current_user->ID, 'agencia_cuit', true) );
	// Domicilio
    GFAPI::update_entry_field( $entry['id'], 40, get_user_meta($current_user->ID, 'agencia_domicilio', true) );
	// Localidad
    GFAPI::update_entry_field( $entry['id'], 41, get_user_meta($current_user->ID, 'agencia_ciudad', true) );
	// Provincia
    GFAPI::update_entry_field( $entry['id'], 42, get_user_meta($current_user->ID, 'agencia_provincia', true) );
	// Fecha válida
    GFAPI::update_entry_field( $entry['id'], 48, date('d/m/y', strtotime('+7 days')) );

    return $entry;
}
add_action( 'gform_entry_post_save', 'pv_actualizar_datos_agencia', 10, 2 );

function pv_gf_set_date_range( $input, $field, $value, $lead_id, $form_id ) {

    // Check if the field type is 'date' and the form ID is the one you're targeting
    if ( $field->type == 'date' && $form_id == PV_GF_HOJARUTA_FORM_ID && '6' == $field['id'] ) {
        $min_date =  date('d/m/y'); // Set your desired minimum date
        $max_date =  date('d/m/y', strtotime('+7 days')); // Set your desired maximum date
        // Modify the input to add min and max attributes
        $input = str_replace( '<input', '<input min="' . $min_date . '" max="' . $max_date . '"', $input );
    }

    return $input;
}
// add_filter( 'gform_field_content', 'pv_gf_set_date_range', 10, 5 );


function pv_actualizar_codigo_destino( $entry, $form ) {
    // Check for the correct form based on form id
    if ( $form['id'] != PV_GF_HOJARUTA_FORM_ID || ! get_current_user_id() || ! class_exists( 'GFAPI' ) ) {
        return $entry;
    }
	// 1 es el codigo del campo "Destino"
	switch ( $entry[1] ) {
		case "Península Valdés":
			$iniciales_destino = "APV";
			$codigo_destino = 1;
			break;
		case "Punta Tombo":
			$iniciales_destino = "APT";
			$codigo_destino = 2;
			break;
		case "Punta Loma":
			$iniciales_destino = "APL";
			$codigo_destino = 3;
			break;
		case "Cabo Dos Bahías":
			$iniciales_destino = "ACB";
			$codigo_destino = 4;
			break;
		case "Nant y Fall":
			$iniciales_destino = "ANF";
			$codigo_destino = 5;
			break;
		case "Bosque Petrificado Sarmiento":
			$iniciales_destino = "ABP";
			$codigo_destino = 6;
			break;
		case "Lago Baggilt":
			$iniciales_destino = "ALB";
			$codigo_destino = 7;
			break;
		case "Laguna Aleusco":
			$iniciales_destino = "ALL";
			$codigo_destino = 8;
			break;
		case "Piedra Parada":
			$iniciales_destino = "APP";
			$codigo_destino = 9;
			break;
		case "Punta del Marqués":
			$iniciales_destino = "APM";
			$codigo_destino = 10;
			break;
		case "Punta León":
			$iniciales_destino = "APE";
			$codigo_destino = 11;
			break;
		case "Los Altares":
			$iniciales_destino = "ALA";
			$codigo_destino = 12;
			break;
	}


    // Update the entry
    GFAPI::update_entry_field( $entry['id'], 35, $codigo_destino );
    GFAPI::update_entry_field( $entry['id'], 46, $iniciales_destino );

    return $entry;
}
add_action( 'gform_entry_post_save', 'pv_actualizar_codigo_destino', 10, 2 );
