<?php


namespace App\Models;


class Asset {

	public function registerStyles(): void {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueueStyles' ] );
	}

	public function enqueueStyles(): void {
		wp_enqueue_style(
			'Fuerza',
			FUERZA_PLUGIN_URL . "/assets/css/fuerza.css",
			[],
			FUERZA_PLUGIN_VERSION
		);
	}
}