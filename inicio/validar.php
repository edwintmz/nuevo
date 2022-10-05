<?php
	$usuario = $_POST['usuario'];
	$pasword = $_POST['pasword'];
	try{
		$base = new PDO('mysql:host=localhost; dbname=rol', 'root', '');
		$base -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
		$base -> exec("SET CHARACTER SET utf8");
		$sql = "select * from usuarios where usuario = :uso and contrasena = :pas";
		$resultado = $base -> prepare($sql);
		$resultado -> execute(array(":uso" => $usuario, ":pas" => $pasword));
		
        $numero_registro = $resultado -> rowCount();
        $registro = $resultado -> fetch(PDO::FETCH_ASSOC);
		if($numero_registro == 1 and $registro['id_cargo'] == 1){
			session_start();
			$_SESSION["usuario"] = $usuario;
			header("location:admin.php/?uso=$usuario");
		}else
		if($numero_registro == 1 and $registro['id_cargo'] >= 2 and $registro['id_cargo'] <= 10){
			session_start();
			$_SESSION["rol"] = $usuario;
			header("location:adm.php/?uso=$usuario");
		}else {
			header("location:index.html");
		}
		$resultado -> closeCursor();

	} CATCH(Exception $e){
		die('Error: ' . $e -> GetMessage());
	} 
	
?>