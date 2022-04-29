<?php 
header("Access-Control-Allow-Origin: http://localhost:4200");
$passwd="";
$usuario="root";
$bd="alumnos";
try {

    $mbd = new PDO("mysql:host=localhost;dbname=$bd", $usuario, $passwd);

	$res = $mbd->query('SELECT * FROM datospersonales' );
	
	if ($res->errorCode()==0) {
		$rows=$res->fetchAll(PDO::FETCH_ASSOC);
		header('Content-type: application/json');
    	echo json_encode($rows);
	}

    $mbd = null;
} catch (PDOException $e) {
    echo json_encode(array(
        'error' => array(
            'msg' => $e->getMessage(),
            'code' => $e->getCode()
        )
    ));
    die();
    }
?>