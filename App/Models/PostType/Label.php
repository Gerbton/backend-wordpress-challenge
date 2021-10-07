<?php

namespace App\Models\PostType;

defined( 'ABSPATH' ) || exit;

class Label {
	private string $name;
	private string $plural;
	private string $singular;

	public function __construct( string $name, string $plural, string $singular ) {
		$this->name     = $name;
		$this->plural   = $plural;
		$this->singular = $singular;
	}

	public function getName(): string {
		return $this->name;
	}

	public function getPlural(): string {
		return $this->plural;
	}

	public function getSingular(): string {
		return $this->singular;
	}
}