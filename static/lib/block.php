<?php

class Block
{
	public string $id;
	public string $component;
	public array $params;

	function __construct($stdObject)
	{
		$this->id = $stdObject->id ? $stdObject->id : null;
		$this->component = $stdObject->component ? $stdObject->component : null;

		foreach ($stdObject->params as $name=>$value) {
			$this->params[$name] = $value;
		}
	}

	function isThis($id) : bool
	{
		return $this->id === $id;
	}

	function render() {
		global $ossgen;

		$code = $this->component;
		$path = OSSGEN_PATH . '/data/components/' . $code;

		$template = "/$code/template.twig";

		$script = "$path/script.js";
		$scriptPath = OSSGEN_URL . '/data/components/' . $code . '/script.js';
		if (file_exists($script)) {
			$ossgen->site->scripts[] = $scriptPath;
		}

		$style = "$path/style.css";
		$stylePath = OSSGEN_URL . '/data/components/' . $code . '/style.css';
		if (file_exists($style)) {
			$ossgen->site->styles[] = $stylePath;
		}

		$result = [];
		$resultPath = "$path/result.php";
		if (file_exists($resultPath)) {
			include $resultPath;
		}

		$params = $this->params;

		$params = array_merge($params, $result);

		$html = $ossgen->twig->render($template, $params);
		$template = $ossgen->twig->createTemplate($html);

		return $template->render();
	}
}
