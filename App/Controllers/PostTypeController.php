<?php

namespace App\Controllers;

use App\Models\Asset;
use App\Models\PostType\Post;
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

	public static function singular(): void {
		$asset = new Asset();
		$asset->registerStyles();
		$asset->registerScripts();

		add_action( 'loop_start', [ __CLASS__, 'showContentHeader' ] );
		add_action( 'loop_end', [ __CLASS__, 'showContentFooter' ] );
	}

	public static function showContentHeader(): void {
		$post = new Post( get_post() );
		include FUERZA_PLUGIN_DIR . "/Views/Public/Single/content-header.php";
	}

	public static function showContentFooter(): void {
		include FUERZA_PLUGIN_DIR . "/Views/Public/Single/content-footer.php";
	}

	public static function showFields( \WP_Post $post ): void {
		include FUERZA_PLUGIN_DIR . "/Views/Admin/fields.php";
	}

	public static function showAdminSubscriptions( \WP_Post $post ): void {
		include FUERZA_PLUGIN_DIR . "/Views/Admin/subscriptions.php";
	}
}