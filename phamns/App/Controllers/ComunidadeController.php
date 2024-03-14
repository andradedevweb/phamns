<?php
	
	namespace App\Controllers;

	class ComunidadeController{


		public function index(){
			if(isset($_SESSION['login'])){

				if(isset($_GET['solicitarAmizade'])){
					$idPara = (int) $_GET['solicitarAmizade'];
					if(\App\Models\UsuariosModel::solicitarAmizade($idPara)){
						\App\Utilidades::alerta('Amizade solicitada com sucesso!');
						\App\Utilidades::redirect(INCLUDE_PATH.'comunidade');
					}else{
						\App\Utilidades::alerta('Ocorreu um erro ao solicitar a amizade...');
						\App\Utilidades::redirect(INCLUDE_PATH.'comunidade');
					}
				}

			\App\Views\MainView::render('comunidade');
			}else{
				\App\Utilidades::redirect(INCLUDE_PATH);
			}
			
		}

	}

?>