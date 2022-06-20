<?php

class Site
{
	public string $name;
	public string $url;
	public string $version;
	public array $pages = [];
	public array $styles = [];
	public array $scripts = [];

	function __construct()
	{
		if (file_exists(SITE_CONFIG_PATH)) {
			$jsonString = file_get_contents(SITE_CONFIG_PATH);
			$jsonObject = json_decode($jsonString);

			$this->name = $jsonObject->name;
			$this->url = $jsonObject->url;
			$this->version = $jsonObject->version;

			foreach ($jsonObject->pages as $page) {
				$this->pages[] = new Page($page);
			}
		}
	}

	function save()
	{
		if (file_exists(SITE_CONFIG_PATH)) {
			file_put_contents(SITE_CONFIG_PATH, json_encode($this, JSON_UNESCAPED_UNICODE));
		}
	}
}
