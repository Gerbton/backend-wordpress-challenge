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

		foreach ( $fields as $key => $value ) {
			update_post_meta( $postID, $key, $value );
		}
	}
}