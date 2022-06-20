<?php

class Page
{
	public string $url;
	public string $title;
	public stdClass $props;
	public array $blocks = [];

	function __construct($stdObject)
	{
		$this->url = $stdObject->url ?? null;
		$this->title = $stdObject->title ?? null;
		$this->props = $stdObject->props ?? new stdClass();

		if (!isset($stdObject->blocks)) $stdObject->blocks = new stdClass();
		foreach ($stdObject->blocks as $block) {
			$this->blocks[] = new Block($block);
		}
	}

	function isThis($url): bool
	{
		return $this->url === $url;
	}

	function update($page)
	{
		foreach ($page as $name=>$value) {
			if ($name === 'blocks') {
				$blocks = [];
				foreach ($page->$name as $block) {
					$blocks[] = new Block($block);
				}
				$this->blocks = $blocks;
			} else {
				$this->$name = $value;
			}
		}
	}

	function render()
	{
		foreach ($this->blocks as $block) {
			echo $block->render();
		}
		die();
	}
}
