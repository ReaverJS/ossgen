<?php

class Component
{
	public string $code;
	public array $params = [];

	function __construct($stdObject)
	{
		$this->code = $stdObject->code ? $stdObject->code : null;

		foreach ($stdObject->params as $name=>$value) {
			$this->params[$name] = $value;
		}
	}

	function isThis($code) : bool
	{
		return $this->code === $code;
	}

	function render($params = []) {
		global $ossgen;

		$code = $this->code;
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

		foreach ($this->params as $name=>$value) {
			$params[$name] = $params[$name] ?? $value->default;
		}

		$params = array_merge($params, $result);

		$html = $ossgen->twig->render($template, $params);
		$template = $ossgen->twig->createTemplate($html);

		return $template->render();
	}
}
