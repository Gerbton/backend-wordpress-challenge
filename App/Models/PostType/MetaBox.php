<?php

namespace App\Models\PostType;

defined( 'ABSPATH' ) || exit;

class MetaBox {
	private string $postType;
	private string $id;
	private string $title;
	private $callback;
	private string $context;
	private string $priority;

	public function __construct( string $postType, string $id, string $title, callable $callback, string $context, string $priority ) {
		$this->postType = $postType;
		$this->id       = $id;
		$this->title    = $title;
		$this->callback = $callback;
		$this->context  = $context;
		$this->priority = $priority;
	}

	public function register(): void {
		add_meta_box(
			$this->id,
			$this->title,
			$this->callback,
			$this->postType,
			$this->context,
			$this->priority
		);
	}
}