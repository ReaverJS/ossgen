<?php

use \Twig\Environment;
use \Twig\Loader\FilesystemLoader;

class Ossgen
{
	public Environment $twig;
	public FilesystemLoader $twigLoader;
	public Site $site;
	public array $components = [];
	public $request;

	function __construct()
	{
		$this->twigLoader = new FilesystemLoader(OSSGEN_PATH . '/data/components/');
		$this->twig = new Environment($this->twigLoader, [
			'autoescape' => false,
			'cache' => false
		]);
		$this->twig->addExtension(new BlocksExtension());

		$this->getRequest();
		$this->site = new Site();
		$this->components = $this->getComponents();
	}

	function getComponents() : array
	{
		$componentsRoot = OSSGEN_PATH . '/data/components';
		$componentsPaths = scandir($componentsRoot);
		$componentsPaths = array_diff($componentsPaths, ['.', '..']);
		sort($componentsPaths);

		$components = [];
		foreach ($componentsPaths as $code) {
			$folder = '/' . $code;
			if (file_exists($componentsRoot . $folder . '/template.twig')
				&& file_exists($componentsRoot . $folder . '/params.json')) {

				$jsonString = file_get_contents($componentsRoot . $folder . '/params.json');
				$params = json_decode($jsonString);
				$params->code = $code;
				$components[] = new Component($params);
			}
		}

		return $components;
	}

	function getRequest()
	{
		$this->request = json_decode(file_get_contents('php://input'));
	}

	function response($data)
	{
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode([
			'status' => 'success',
			'result' => $data
		]);
		die();
	}

	function error($data)
	{
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode([
			'status' => 'failure',
			'result' => $data
		]);
		die();
	}

	function render($path, $params = [], $return = false)
	{
		if (is_object($params)) $params = (array)$params;

		$style = "/data/blocks$path/style.css";
		if (file_exists(OSSGEN_PATH . $style)) {
			$this->properties->addStyle(OSSGEN_PATH . $style);
		}

		$html = $this->twig->render($path, $params);
		$template = $this->twig->createTemplate($html);

		if ($return) return $template->render();
		else echo $template->render();
	}
}
