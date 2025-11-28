<?php

return array(
	'setting' => array(
		'url'=>url('setting-base'), 
		'text'=>lang('setting'), 
		)
	),
	'plugin' => array(
		'url'=>url('plugin'), 
		'text'=>lang('plugin'), 
		'icon'=>'icon-cogs',
		'tab'=> array (
			'local'=>array('url'=>url('plugin-local'), 'text'=>lang('admin_plugin_local_list')),
			'official_free'=>array('url'=>url('plugin-official_free'), 'text'=>lang('admin_plugin_official_free_list')),
			'official_fee'=>array('url'=>url('plugin-official_fee'), 'text'=>lang('admin_plugin_official_fee_list')),
		)
	)
);

?>