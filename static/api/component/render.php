<?php

global $ossgen;

if (!isset($ossgen->request->code)) {
	$ossgen->error('[code] is required');
}

foreach ($ossgen->components as $component) {
	if ($component->isThis($ossgen->request->code)) {

		$params = $ossgen->request->params ?? [];
		$params = (array) $params;

		echo $component->render($params);
		die();
	}
}

$ossgen->response('component not found');
