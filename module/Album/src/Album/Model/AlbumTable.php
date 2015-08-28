<?php
	namespace Album\Model;
	
	use Zend\Db\TableGateway\TableGateway;
	
	class AlbumTable{
		protected $tableGateway;
		
		public function __contruct(TableGateway $tableGateway){
			$this->tableGateway = $tableGateway;
		}
		public function fetchAll(){
			$resultset = $this->tableGateway->select();
			return $resultset;
		}
		public function getAlbum($id){
			$id = (int)$id;
			$row = $this->tableGateway->select(array('id' => $id));
			$row1 = $row->current();
			if (!row1){
				throw new \Exception("Can not find row: $id ! ");
			}
			return $row1;
		}
	}
?>