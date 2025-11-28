<?php

!defined('DEBUG') AND exit('Access Denied.');

$action = param(1);

if($action == 'list') {
	
	$page = param(2, 1);
	$pagesize = 20;
	
	$cond = array();
	$n = tag_count($cond);
	$taglist = tag_find($cond, array('tagid'=>-1), $page, $pagesize);
	
	$pagination = pagination(url("tag-list-{page}"), $n, $page, $pagesize);
	
	$header['title'] = lang('tag_admin');
	$header['mobile_title'] = lang('tag_admin');
	
	include _include(APP_PATH.'view/htm/tag_list.htm');
	
} elseif($action == 'create') {
	
	if($method == 'GET') {
		
		include _include(APP_PATH.'view/htm/tag_create.htm');
		
	} else {
		
		$name = param('name');
		empty($name) AND message('name', lang('please_input_tag_name'));
		
		$tag = tag_find_by_name($name);
		$tag AND message('name', lang('tag_exists'));
		
		tag__create(array('name'=>$name, 'count'=>0));
		
		message(0, lang('create_successfully'));
	}
	
} elseif($action == 'update') {
	
	$tagid = param(2);
	$tag = tag_read($tagid);
	empty($tag) AND message(-1, lang('tag_not_exists'));
	
	if($method == 'GET') {
		
		include _include(APP_PATH.'view/htm/tag_update.htm');
		
	} else {
		
		$name = param('name');
		$enable = param('enable');
		
		empty($name) AND message('name', lang('please_input_tag_name'));
		
		$arr = array(
			'name'=>$name,
			'enable'=>$enable,
		);
		tag__update($tagid, $arr);
		
		message(0, lang('update_successfully'));
	}
	
} elseif($action == 'delete') {
	
	$tagid = param(2);
	$tag = tag_read($tagid);
	empty($tag) AND message(-1, lang('tag_not_exists'));
	
	tag__delete($tagid);
	tag_thread_delete_by_tagid($tagid);
	
	message(0, lang('delete_successfully'));
	
}

?>
