<?php

namespace App\Controllers;

use App\Models\Subscription;

defined( 'ABSPATH' ) || exit;

class SubscriptionController {
	public static function create( \WP_REST_Request $request ): void {
		if ( ! wp_verify_nonce( $request->get_param( '_wpnonce' ), 'wp_rest' ) ) {
			wp_send_json_error( null, 401 );
		}

		$subscription = new Subscription();

		if ( $subscription::emailExists( $request->get_param( 'email' ) ) ) {
			wp_send_json_error( __( 'E-mail já cadastrado', FUERZA_POST_TYPE ) );
		}

		try {
			$subscription->setName( $request->get_param( 'name' ) );
			$subscription->setEmail( $request->get_param( 'email' ) );
			$subscription->setPostId( $request->get_param( 'post_id' ) );
			$subscription->save();
		} catch ( \Exception $exception ) {
			wp_send_json_error( $exception->getMessage() );
		}

		wp_send_json_success( __( 'Solicitação de inscrição recebida. Logo entraremos em contato', FUERZA_POST_TYPE ) );
	}
}