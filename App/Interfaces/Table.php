<?php

namespace App\Interfaces;

defined('ABSPATH') || exit;

interface Table {
	public function create();

	public function drop();
}