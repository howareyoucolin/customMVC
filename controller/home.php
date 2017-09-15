<?php

class ControllerHome extends Controller{

	public function index(){	
	
		//render view:
		$this->renderView('header');
		$this->renderView('home');
		$this->renderView('footer');
		
	}

}