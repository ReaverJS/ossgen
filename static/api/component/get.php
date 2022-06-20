<?php

global $ossgen;

if (!isset($ossgen->request->code)) {
	$ossgen->error('[code] is required');
}

foreach ($ossgen->components as $component) {
	if ($component->isThis($ossgen->request->code)) {
		$ossgen->response($component);
	}
}

$ossgen->response('component not found');
