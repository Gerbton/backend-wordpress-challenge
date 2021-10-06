<?php

namespace App\Interfaces;

interface Table {
	public function create();

	public function drop();
}