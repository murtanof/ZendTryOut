<?php
//The ModuleManager will call getAutoloaderConfig() and getConfig() automatically

namespace Album;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Album\Model\Album;
use Album\Model\AlbumTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;


class Module implements AutoloaderProviderInterface, ConfigProviderInterface{
	public function getAutoloaderConfig(){
		return array(
			'Zend\Loader\ClassMapAutoloader' => array(
				__DIR__ . '/autoload_classmap.php',
			),
			'Zend\Loader\StandardAutoloader' => array(
				'namespaces' => array(
				__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
				),
			),
		);
	}

	public function getConfig(){
		return include __DIR__ . '/config/module.config.php';
	}
	
	public function getServiceConfig(){
		return array(
			'factories' => array(
				'Album\Model\AlbumTable' => function($sm){
					$tableGateway = $sm->get('AlbumTableGateway');
					$table = new AlbumTable($tableGateway);
					return $table;
				},
			),
			'AlbumTableGateway' => function ($sm) {
				$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
				$resultSet = new ResultSet();
				$resultSet->setArrayObjectPrototype(new Album());
				return new tableGateway('album',$dbAdapter, null, $resultSet);
			},
		);
	}
}
?>