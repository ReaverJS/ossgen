<?php
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class BlocksExtension extends AbstractExtension
{

	public function getFunctions()
	{
		return [
			new TwigFunction('includeBlock', [$this, 'includeBlock'], ['needs_environment' => true]),
			new TwigFunction('includeScripts', [$this, 'includeScripts'], ['needs_environment' => true]),
			new TwigFunction('includeMeta', [$this, 'includeMeta'], ['needs_environment' => true]),
			new TwigFunction('includeStyles', [$this, 'includeStyles'], ['needs_environment' => true]),
		];
	}

	public function includeBlock($env, $path, $params = [])
	{
		global $App;
		$script = "/data/blocks$path/script.js";
		if (file_exists(OSSGEN_PATH . $script)) {
			$App->properties->addScript(OSSGEN_PATH . $script);
		}

		$style = "/data/blocks$path/style.css";
		if (file_exists(OSSGEN_PATH . $style)) {
			$App->properties->addStyle(OSSGEN_PATH . $style);
		}

		$result = [];
		$resultPath = "/data/blocks$path/result.php";
		if (file_exists(OSSGEN_PATH . $resultPath)) {
			include OSSGEN_PATH . $resultPath;
		}
		if (!$params) $params = [];
		$params = array_merge($params, $result);

		$template = '/blocks' . $path . '/template.twig';
		return $env->render($template, $params);
	}

	public function includeScripts()
	{
		global $ossgen;
		$scripts = $ossgen->site->scripts;

		$html = '';
		foreach ($scripts as $script) {
			$html .= '<script src="' . $script . "\"></script>\n";
		}
		return $html;
	}

	public function includeStyles()
	{
		global $ossgen;
		$styles = $ossgen->site->styles;

		$html = '';
		foreach ($styles as $style) {
			$html .= '<link rel="stylesheet" href="' . $style . "\">\n";
		}
		return $html;
	}

	public function includeMeta($env)
	{
		global $App;
		$metas = $App->properties->meta;
		$template = '/blocks/admin/meta/template.twig';

		$html = '';
		foreach ($metas as $name=>$content) {
			$html .= $env->render($template, ['name' => $name, 'content' => $content]);
		}
		return $html;
	}
}

