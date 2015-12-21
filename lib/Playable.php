<?php

namespace Mochix\Go;

interface Playable
{
	public function input($board, $turn);
	public function isSame();
}