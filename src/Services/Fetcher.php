<?php

namespace App\Services;

class Fetcher
{
	public function get($url)
	{
		return "Get from API : " . $url;
	}
}