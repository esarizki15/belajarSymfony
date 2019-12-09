<?php

namespace App\Services;
use Symfony\Component\DependencyInjection\ContainerInterface;
class Fetcher
{
	private $forbiddenLink;
	private $container;

	public function __construct(ContainerInterface $container, $forbiddenLink)
	{
		$this->forbiddenLink = $forbiddenLink;
		$this->container = $container;
	}

	public function get($url)
	{
		$uploads_dir = $this->container->getParameter('forbiddenLink');
		var_dump($uploads_dir);
		if ($url === $this->forbiddenLink) {
			return false;
		}
		$result = file_get_contents($url);
		return json_decode($result, true);
	}
}