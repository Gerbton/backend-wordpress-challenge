<?php

namespace App\Controllers;

use App\Providers\HelperProvider;

defined( 'ABSPATH' ) || exit;

class PostTypeController {
	public static function save( $postID ): void {
		$post = get_post( $postID );

		if ( ! HelperProvider::checkNonce( $post->post_type ) ) {
			return;
		}

		$fields = $_POST['fuerza'] ?? [];

		if ( isset( $fields['fc_deadline'] ) ) {
			$fields['fc_deadline'] = HelperProvider::sanitizeDate( $fields['fc_deadline'] );
		}

		foreach ( $fields as $key => $value ) {
			$key   = sanitize_key( $key );
			$value = sanitize_text_field( $value );

			update_post_meta( $postID, $key, $value );
		}
	}
}