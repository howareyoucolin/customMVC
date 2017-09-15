<?php

class ControllerDashboard extends Controller{

	public function index(){	
	
		//Check if Loggedin:
		if(!$this->user->isLoggedin()){
			die('Access Denied!');
		}
		if($this->admin->isAdmin()){
			$this->redirect('adminpanel');
		}
	
		$this->loadModel('dashboard');
		$this->data['images'] = ModelDashBoard::getImages();
	
		//render view:
		$this->renderView('header');
		$this->renderView('dashboard');
		$this->renderView('footer');
		
	}
	
	public function delete(){
	
		//Validate:
		if(!isset($_POST['id'])){ die('err...');}
		else{ $id = $_POST['id'];}
		
		//Deletion:
		$this->loadModel('dashboard');
		echo ModelDashBoard::deleteImages($id,$this->user->id);
	}
	
	public function upload(){
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $_FILES["file"]["name"]);
		$extension = end($temp);

		//image must be less than 1000kb:
		if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/pjpeg")
		|| ($_FILES["file"]["type"] == "image/x-png")
		|| ($_FILES["file"]["type"] == "image/png"))
		&& ($_FILES["file"]["size"] < 1000000)
		&& in_array($extension, $allowedExts)) {
			if ($_FILES["file"]["error"] > 0) {
				die("Return Code: " . $_FILES["file"]["error"]);
			}
			$date = new DateTime();
			$filename = "upload/" . $date->getTimestamp() . "." .$extension;
			move_uploaded_file($_FILES["file"]["tmp_name"], $filename);	
			//add the link to database:
			$this->loadModel('dashboard');
			ModelDashBoard::insertImages($this->user->id,$filename);
			//Redirect:
			$this->redirect('dashboard');
		}
	}
	
	public function changeEmail(){
		//Validate:
		if(!isset($_POST['email'])){ die('err...');}
		else{ $email = $_POST['email'];}
		
		//Change Email:
		$this->loadModel('dashboard');
		ModelDashBoard::changeEmail($this->user->id,$email);
		
		//Refresh Session:
		echo $_SESSION['email'] = $email;
	}
	
	public function multiDelete(){
		if(isset($_POST['delete'])){	
			$this->loadModel('dashboard');
			ModelDashboard::multiDeleteImages($_POST['delete'],$this->user->id);
		}else{
			die('error');
		}
		$this->redirect('dashboard');		
	}
	
	

	
}