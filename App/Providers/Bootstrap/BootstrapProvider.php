<?php

namespace App\Providers\Bootstrap;

defined( 'ABSPATH' ) || exit;

class BootstrapProvider {
	private string $screen;
	private bool $registerStyles;
	private bool $registerScripts;
	private string $assetsPathURL;

	public function __construct( string $screen, bool $registerStyles = true, bool $registerScripts = false ) {
		$this->screen          = $screen;
		$this->registerStyles  = $registerStyles;
		$this->registerScripts = $registerScripts;
		$this->assetsPathURL   = FUERZA_PLUGIN_URL . "/App/Providers/Bootstrap/assets";
	}

	public function registerAssets(): void {
		add_action( 'current_screen', function ( $currentScreen ) {
			if ( $this->screen !== $currentScreen->id ) {
				return;
			}

			if ( $this->registerStyles ) {
				$this->enqueueStyles();
			}

			if ( $this->registerScripts ) {
				$this->enqueueScripts();
			}
		}, 0 );
	}

	private function enqueueStyles(): void {
		wp_enqueue_style(
			'bootstrap-4',
			"$this->assetsPathURL/css/bootstrap.min.css",
			[],
			'4.1.3'
		);

		wp_enqueue_style(
			'bootstrap-normalize',
			"$this->assetsPathURL/css/bootstrap-normalize.css",
			[ 'bootstrap-4' ],
			'1.0.0'
		);

		wp_enqueue_style(
			'bootstrap-datepicker',
			"$this->assetsPathURL/css/bootstrap-datepicker.min.css",
			[ 'bootstrap-4' ],
			'1.9.0'
		);

		wp_enqueue_style(
			'FontAwesome',
			"$this->assetsPathURL/css/fontawesome/all.css",
			[],
			'5.8.1'
		);
	}

	private function enqueueScripts(): void {
		wp_enqueue_script(
			'bootstrap-4',
			"$this->assetsPathURL/js/bootstrap.min.js",
			[ 'jquery' ],
			'4.1.3',
			true
		);

		wp_enqueue_script(
			'popper',
			"$this->assetsPathURL/js/popper.min.js",
			[ 'jquery' ],
			'1.0.0',
			true
		);

		wp_enqueue_script(
			'BootstrapController',
			"$this->assetsPathURL/js/BootstrapController.js",
			[ 'bootstrap-4' ],
			'4.1.3',
			true
		);

		wp_enqueue_script(
			'BootstrapDatepicker',
			"$this->assetsPathURL/js/bootstrap-datepicker.min.js",
			[ 'bootstrap-4' ],
			'1.9.0',
			true
		);

		wp_enqueue_script(
			'BootstrapDatepickerPTBR',
			"$this->assetsPathURL/js/bootstrap-datepicker.pt-BR.min.js",
			[ 'BootstrapDatepicker' ],
			'1.9.0',
			true
		);
	}
}
