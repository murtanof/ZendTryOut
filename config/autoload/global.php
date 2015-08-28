<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
	'db'=> array(
		'driver'	=>'Pdo',
		'dsn'			=>'mysql:dbname=test;host=localhost',
		'username'=>'root',
		'password'=>'',
		'driver_options'=>array(pdo::MYSQL_ATTR_INIT_COMMAND=>'set names \'UTF8\''),
	),
	'service_manager'=>array(
		'factories'=>array('Zend\Db\Adapter\Adapter'
			=>'Zend\Db\Adapter\AdapterServiceFactory'),
	),
);
