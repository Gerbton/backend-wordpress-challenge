<?php

namespace App\Providers;

class HelperProvider {

	public static function run(): void {
		self::addThumbnailSupport();
	}

	private static function addThumbnailSupport(): void {
		add_action( 'after_setup_theme', static function () {
			add_theme_support( 'post-thumbnails' );
		} );
	}

	public static function registerNonce( string $label ): void {
		$action = "fc_{$label}";
		$name   = "fc_{$label}_nonce";

		wp_nonce_field( $action, $name );
	}

	public static function checkNonce( string $label ): bool {
		$action = "fc_$label";
		$name   = "fc_{$label}_nonce";

		if ( ! isset( $_POST[ $name ] ) ) {
			return false;
		}

		return wp_verify_nonce( $_POST[ $name ], $action );
	}

	public static function sanitizeDate( string $date ): string {
		return ( new \DateTime( str_replace( '/', '-', $date ) ) )->format( 'Y-m-d' );
	}
}
