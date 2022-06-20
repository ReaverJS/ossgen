<?php

global $ossgen;

if (!isset($ossgen->request->url)) {
	$ossgen->error('[url] is required');
}

foreach ($ossgen->site->pages as $page) {
	if ($page->isThis($ossgen->request->url)) {
		$ossgen->response($page);
	}
}

$ossgen->response('page not found');
