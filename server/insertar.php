<?php 
header("Access-Control-Allow-Origin: http://localhost:4200");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  
  $params = json_decode(file_get_contents("php://input"));

$passwd="";
$usuario="root";
$bd="alumnos";
// if ($_POST) {
	try {	
	  $mbd = new PDO("mysql:host=localhost;dbname=$bd", $usuario, $passwd);
  		$sentencia = $mbd->prepare("INSERT INTO datospersonales (nombre, apellidos,estatura) VALUES (:nombre, :apellidos,:estatura)");
		$sentencia->bindParam(':nombre', $nombre);
		$sentencia->bindParam(':apellidos', $apellidos);
		$sentencia->bindParam(':estatura', $estatura);

		$nombre=$params->nombre;
		$apellidos=$params->apellidos;
		$estatura=$params->estatura;
		$sentencia->execute();
		$error=$sentencia->errorInfo();
		header('Content-Type: application/json');
		echo json_encode(array(
			'error'=> array(
				'sqlstate'=>current($error),
				'code'=>next($error),
				'msg'=>next($error))));
		$mbd = null;
} catch (PDOException $e) {
		echo json_encode(array(
        'error' => array(
            'msg' => $e->getMessage(),
            'code' => $e->getCode()
        )
    ));
}

// } 
?>