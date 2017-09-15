<?php

class ControllerAdminpanel extends Controller{

	public function index(){	
	
		//Check if Loggedin:
		if(!$this->admin->isLoggedin()){
			die('Access Denied!');
		}
		if(!$this->admin->isAdmin()){
			die('Off Limit Here!Admin Only!');
		}
		
		//Retrieve users:
		$this->loadModel('adminpanel');
		$this->data['users'] = ModelAdminpanel::getStandardUsers();
	
		//showImage
		if(!isset($_POST['list'])){		
			$this->data['images'] = ModelAdminpanel::getAllImages();
		}else{
			$this->data['images'] = ModelAdminpanel::getSelectedImages($_POST['list']);
			$this->data['list'] = $_POST['list'];
		}
	
		//render view:
		$this->renderView('header');
		$this->renderView('adminpanel');
		$this->renderView('footer');
		
	}

	public function shiftOwnership(){
		//Validate:
		if(isset($_GET['imgid'])){$img_id=$_GET['imgid'];}
		else die('err...');
		
		//Retrieve image data:
		$this->loadModel('adminpanel');
		$this->data['image'] = ModelAdminpanel::getImageData($img_id);
		$user_id = $this->data['image']['user_id'];
		
		//Retrieve users data:
		$this->data['users'] = ModelAdminpanel::getUsersButThis($user_id);
		
		//render view:
		$this->renderView('header');
		$this->renderView('shift');
		$this->renderView('footer');
	}
	
	public function shift(){
		//Validate:
		if(isset($_GET['imgid'])){$img_id=$_GET['imgid'];}
		else die('err...');
		if(isset($_GET['userid'])){$user_id=$_GET['userid'];}
		else die('err...');
		
		$this->loadModel('adminpanel');
		$this->data['image'] = ModelAdminpanel::shiftOwner($img_id,$user_id);
		
		$this->redirect('adminpanel');
	}

}