<?php

// hook model_tag_start.php

// ------------> 最原生的 CURD，无关联其他数据。

function tag__create($arr) {
	// hook model_tag__create_start.php
	$r = db_insert('tag', $arr);
	// hook model_tag__create_end.php
	return $r;
}

function tag__update($tagid, $arr) {
	// hook model_tag__update_start.php
	$r = db_update('tag', array('tagid'=>$tagid), $arr);
	// hook model_tag__update_end.php
	return $r;
}

function tag__read($tagid) {
	// hook model_tag__read_start.php
	$tag = db_find_one('tag', array('tagid'=>$tagid));
	// hook model_tag__read_end.php
	return $tag;
}

function tag__delete($tagid) {
	// hook model_tag__delete_start.php
	$r = db_delete('tag', array('tagid'=>$tagid));
	// hook model_tag__delete_end.php
	return $r;
}

function tag__find($cond = array(), $orderby = array(), $page = 1, $pagesize = 20) {
	// hook model_tag__find_start.php
	$taglist = db_find('tag', $cond, $orderby, $page, $pagesize);
	// hook model_tag__find_end.php
	return $taglist;
}

function tag_count($cond = array()) {
	$n = db_count('tag', $cond);
	return $n;
}

// ------------> 关联 CURD

function tag_read($tagid) {
	$tag = tag__read($tagid);
	tag_format($tag);
	return $tag;
}

function tag_format(&$tag) {
	if(empty($tag)) return;
	$tag['url'] = url("tag-$tag[tagid]");
}

function tag_find($cond = array(), $orderby = array(), $page = 1, $pagesize = 20) {
	$taglist = tag__find($cond, $orderby, $page, $pagesize);
	if($taglist) foreach ($taglist as &$tag) tag_format($tag);
	return $taglist;
}

function tag_find_by_name($name) {
	$tag = db_find_one('tag', array('name'=>$name));
	return $tag;
}

// ------------> thread_tag 关联

function tag_thread__create($tagid, $tid) {
	$r = db_insert('thread_tag', array('tagid'=>$tagid, 'tid'=>$tid));
	return $r;
}

function tag_thread__delete($tagid, $tid) {
	$r = db_delete('thread_tag', array('tagid'=>$tagid, 'tid'=>$tid));
	return $r;
}

function tag_thread_delete_by_tid($tid) {
	$r = db_delete('thread_tag', array('tid'=>$tid));
	return $r;
}

function tag_thread_delete_by_tagid($tagid) {
	$r = db_delete('thread_tag', array('tagid'=>$tagid));
	return $r;
}

function tag_thread_find_by_tid($tid) {
	$list = db_find('thread_tag', array('tid'=>$tid), array(), 1, 100);
	return $list;
}

function tag_thread_find_by_tagid($tagid, $page = 1, $pagesize = 20) {
	$list = db_find('thread_tag', array('tagid'=>$tagid), array('tid'=>-1), $page, $pagesize);
	return $list;
}

// 统计 tag 下的主题数
function tag_thread_count_by_tagid($tagid) {
	$n = db_count('thread_tag', array('tagid'=>$tagid));
	return $n;
}

// hook model_tag_end.php

?>
