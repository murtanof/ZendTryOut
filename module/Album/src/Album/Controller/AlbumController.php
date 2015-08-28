<?php
	namespace Album\Controller;

	use Zend\Mvc\Controller\AbstractActionController;
	use Zend\View\Model\ViewModel;
	
	class AlbumController extends AbstractActionController{
		protected $albumTable;
		
		public function getAlbumTable(){
			$sm = $this->getServiceLocator();
			$this->albumTable = $sm->get('Album\Model\AlbumTable');
		}
		public function indexAction(){
			return new ViewModel(array(
				'albums' => $this->getAlbumTable()->fetchall(),
			));
		}
		public function addAction(){
			
		}
		public function editAction(){
			
		}
		public function deleteAction(){
			
		}
	}	
?>