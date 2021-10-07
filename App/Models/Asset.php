<?php

namespace App\Models;

defined( 'ABSPATH' ) || exit;

class Asset {

	public function registerStyles(): void {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueueStyles' ] );
	}

	public function registerScripts(): void {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueueScripts' ] );
	}

	public function enqueueStyles(): void {
		wp_enqueue_style(
			'Fuerza',
			FUERZA_PLUGIN_URL . "/assets/css/fuerza.css",
			[],
			FUERZA_PLUGIN_VERSION
		);
	}

	public function enqueueScripts(): void {
		wp_enqueue_script(
			'FCSubscription',
			FUERZA_PLUGIN_URL . "/assets/js/Subscription.js",
			[ 'jquery' ],
			FUERZA_PLUGIN_VERSION,
			true
		);

		wp_localize_script(
			'FCSubscription',
			'subscribeData',
			[
				'endpoints' => [
					'create' => [
						'url'    => rest_url( FUERZA_POST_TYPE . '/v1/subscribe' ),
						'method' => 'POST'
					]
				]
			]
		);
	}
}