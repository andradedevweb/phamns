<?php
	
	namespace App\Models;

	class HomeModel{


		public static function postFeed($post){
			$pdo = \App\MySql::connect();
			$post = strip_tags($post);
			
			if(preg_match('/\[imagem/',$post)){
				$post = preg_replace('/(.*?)\[imagem=(.*?)\]/', '<p>$1</p><img src="$2" />', $post)	;
			}else{
				$post = '<p>'.$post.'</p>';
			}
				
			
				
			$postFeed = $pdo->prepare("INSERT INTO `posts` VALUES (null,?,?,?)");
			$postFeed->execute(array($_SESSION['id'],$post,date('Y-m-d H:i:s',time())));

			$atualizaUsuario = $pdo->prepare("UPDATE `posts` SET `data` = ? WHERE id = ?");
			$atualizaUsuario->execute(array(date('Y-m-d H:i:s',time()),$_SESSION['id']));
			
		}

		public static function retrieveFriendsPosts(){

			$pdo = \App\MySql::connect();

			$amizades = $pdo->prepare("SELECT * FROM amizades WHERE (enviou = ? AND status = 1) OR (recebeu = ? AND status = 1)");
			$amizades->execute(array($_SESSION['id'],$_SESSION['id']));

			$amizades = $amizades->fetchAll();
			$amigosConfirmados = array();
			foreach ($amizades as $key => $value) {
				if($value['enviou'] == $_SESSION['id']){
					$amigosConfirmados[] = $value['recebeu'];
				}else{
					$amigosConfirmados[] = $value['enviou'];
				}
			}

			$listaAmigos = array();

			foreach ($amigosConfirmados as $key => $value) {
				$listaAmigos[$key]['id'] = \App\Models\UsuariosModel::getUsuarioById($value)['id'];
				$listaAmigos[$key]['nome'] = \App\Models\UsuariosModel::getUsuarioById($value)['nome'];
				$listaAmigos[$key]['email'] = \App\Models\UsuariosModel::getUsuarioById($value)['email'];
				$listaAmigos[$key]['data'] = \App\Models\UsuariosModel::getUsuarioById($value)['data'];
				$listaAmigos[$key]['img'] = \App\Models\UsuariosModel::getUsuarioById($value)['img'];
			}

			usort($listaAmigos,function($a,$b){
				if(strtotime($a['data']) >  strtotime($b['data'])){
					return -1;
				}else{
					return +1;
				}
			});
			$posts = [];

			foreach ($listaAmigos as $key => $value) {

				$data = $pdo->prepare("SELECT * FROM posts WHERE usuario_id = ?");
				$data->execute(array($value['id']));
				if($data->rowCount() >= 1){
					$data = $data->fetch();
					$posts[$key]['usuario'] = $value['nome'];
					$posts[$key]['img'] = $value['img'];
					$posts[$key]['data'] = $data['data'];
					$posts[$key]['conteudo'] = $data['post'];

					
				}
			}
			
			$me = $pdo->prepare("SELECT * FROM usuarios WHERE id = $_SESSION[id]");

			$me->execute();

			$me = $me->fetch();

			if(isset($posts[0])){
				if(strtotime($me['data']) > strtotime($posts[0]['data'])  ){
					$data = $pdo->prepare("SELECT * FROM posts WHERE id = $_SESSION[id] ORDER BY date DESC");
					$data->execute();
					$data = $data->fetchAll()[0];
					array_unshift($posts, array('data'=>$data['data'],'conteudo'=>$data['post'],'me'=>true  ));
				}
			}
	


			return $posts;


		}




	}