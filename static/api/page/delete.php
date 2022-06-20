<?php

global $ossgen;

if (!isset($ossgen->request->url)) {
	$ossgen->error('[url] is required');
}

foreach ($ossgen->site->pages as $index=>$page) {
	if ($page->isThis($ossgen->request->url)) {
		unset($ossgen->site->pages[$index]);
		sort($ossgen->site->pages);
		$ossgen->site->save();
		$ossgen->response($page);
	}
}

$ossgen->response('page not found');
