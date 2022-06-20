<?php

global $ossgen;

if (!isset($ossgen->request->url) || !isset($ossgen->request->title)) {
	$ossgen->error('[url] and [title] are required');
}

$page = new Page($ossgen->request);
$ossgen->site->pages[] = $page;
$ossgen->site->save();

$ossgen->response($page);
