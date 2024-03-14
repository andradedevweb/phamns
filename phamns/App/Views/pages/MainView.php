<?php
	
	namespace App\Views;

	class MainView{

		public static function render($filename){

			include('App/Views/pages/'.$filename.'.php');
			
		}
	}
?>