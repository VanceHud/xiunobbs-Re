<?php

!defined('DEBUG') AND exit('Access Denied.');

$action = param(1);

// hook tag_start.php

if($action == 'list') {
	$header['title'] = lang('tag_list');
	$taglist = tag_find(array(), array('count'=>-1), 1, 1000);
	
	// hook tag_list_end.php
	
	include _include(APP_PATH.'view/htm/tag_list.htm');
} else {
	$tagid = param(1, 0);
	$page = param(2, 1);
	$pagesize = $conf['pagesize'];
	
	$tag = tag_read($tagid);
	empty($tag) AND message(-1, lang('tag_not_exists'));
	
	$threadlist = array();
	$tagthreadlist = tag_thread_find_by_tagid($tagid, $page, $pagesize);
	if($tagthreadlist) {
		$tids = arrlist_values($tagthreadlist, 'tid');
		$threadlist = thread_find_by_tids($tids);
	}
	
	$pagination = pagination(url("tag-$tagid-{page}"), $tag['count'], $page, $pagesize);
	
	$header['title'] = $tag['name'];
	
	// hook tag_read_end.php
	
	include _include(APP_PATH.'view/htm/tag_thread.htm');
}

// hook tag_end.php

?>
