<?php

global $ossgen;

if (!isset($ossgen->request->url)) {
	$ossgen->request = new stdClass();
	$ossgen->request->url = '/';
	//$ossgen->error('[url] is required');
}

foreach ($ossgen->site->pages as $page) {
	if ($page->isThis($ossgen->request->url)) {
		if (isset($ossgen->request->blocks)) {
			$page->update($ossgen->request);
		}
		$page->render();
	}
}

$ossgen->response('page not found');
