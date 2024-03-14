<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
	<link href="<?php echo INCLUDE_PATH_STATIC ?>estilos/style.css" rel="stylesheet">
</head>
<body>
<style>
	*{
		font-family: "Comic Sans MS", "Comic Sans", cursive;
	}
		body{
			background-color: black;
			color: white;
			outline: none;
		}
		.sidebar{
			background-color: rgb(20, 20, 20);
		}
		.form-login{
			background-color: rgb(115, 115, 115);
		}
		.Logar{
			background-color: yellow;
			color: white;
		}
		.link{
			color: white;
		}
	</style>

	<div class="sidebar"></div>

	<div class="form-container-login">

		<div class="logo-chamada-login">
		
			<img src="<?php echo INCLUDE_PATH_STATIC ?>images/phamns-logo.png" />
		</div><!--logo-chamada-login-->

		<div class="form-login">
				<form method="post">
					<input type="text" name="email" placeholder="Login...">
					<input type="password" name="senha" placeholder="Senha...">
					<input type="submit" name="acao" value="Logar" class="logar">
					<input type="hidden" name="login">
				</form>
				<p><a href="<?php echo INCLUDE_PATH ?>registrar">Criar Conta</a></p>
		</div><!--form-login-->

	</div>
</body>
</html>