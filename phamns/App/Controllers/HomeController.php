<?php
	
	namespace App\Controllers;
	class HomeController{


		public function index(){

			if(isset($_GET['loggout'])){
				session_unset();
				session_destroy();

				\App\Utilidades::redirect(INCLUDE_PATH);
			}

			if(isset($_SESSION['login'])){
				//Renderiza a home do usuário.

				//Existe pedido de amizade?

				if(isset($_GET['recusarAmizade'])){
					$idEnviou = (int) $_GET['recusarAmizade'];
					\App\Models\UsuariosModel::atualizarPedidoAmizade($idEnviou,0);
					\App\Utilidades::alerta('Amizade Recusada :(');
					\App\Utilidades::redirect(INCLUDE_PATH);
				}else if(isset($_GET['aceitarAmizade'])){
					$idEnviou = (int) $_GET['aceitarAmizade'];
					if(\App\Models\UsuariosModel::atualizarPedidoAmizade($idEnviou,1)){
					\App\Utilidades::alerta('Amizade aceita!');
					\App\Utilidades::redirect(INCLUDE_PATH);
					}else{
					\App\Utilidades::alerta('Ops.. um erro ocorreu!');
					\App\Utilidades::redirect(INCLUDE_PATH);
					}
				}


				//Existe postagem no feed?


				if(isset($_POST['post_feed'])){

					if($_POST['post_content'] == ''){
						\App\Utilidades::alerta('Não permitimos posts vázios :(');
						\App\Utilidades::redirect(INCLUDE_PATH);
					}

					\App\Models\HomeModel::postFeed($_POST['post_content']);
					\App\Utilidades::alerta('Post feito com sucesso!');
					\App\Utilidades::redirect(INCLUDE_PATH);
				}


				\App\Views\MainView::render('home');
			}else{
				//Renderizar para criar conta.

				if(isset($_POST['login'])){
					$login = $_POST['email'];
					$senha = $_POST['senha'];

					
					//Verificar no banco de dados.

					$verifica = \App\MySql::connect()->prepare("SELECT * FROM usuarios WHERE email = ?");
					$verifica->execute(array($login));

					if($verifica->rowCount() == 0){
						//Não existe o usuário!
						\App\Utilidades::alerta('Não existe nenhum usuário com este e-mail');
						\App\Utilidades::redirect(INCLUDE_PATH);
					}else{
						$dados = $verifica->fetch();
						$senhaBanco = $dados['senha'];
						if(\App\Bcrypt::check($senha,$senhaBanco)){
							//Usuário logado com sucesso
							
							$_SESSION['login'] = $dados['email'];
							$_SESSION['id'] = $dados['id'];
							$_SESSION['nome'] = explode(' ',$dados['nome'])[0];
							$_SESSION['img'] = $dados['img'];
							\App\Utilidades::alerta('Logado com sucesso');
							\App\Utilidades::redirect(INCLUDE_PATH);
						}else{
							\App\Utilidades::alerta('Senha incorreta');
							\App\Utilidades::redirect(INCLUDE_PATH);
						}
					}
				}
				\App\Views\MainView::render('login');
			}

		}

	}
?>