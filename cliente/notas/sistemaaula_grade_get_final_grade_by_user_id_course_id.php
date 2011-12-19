<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Teste de WebService Sistema Aula - Função: </title>
</head>
<body>

<?php


require '../lib/clientewebservice.php';
require '../config.php';


// grupo de informações solicitadas para execução do serviço
$action = "sistemaaula_grade_get_final_grade_by_user_id_and_course_id"; 

$courserid=2; // atualize com o codigo do seu curso
$userid=3;    // atualize com o codigo do usuário 

$param = array($userid,$courserid);
 
$resp = callService($host, $install, $token, $action, $param);

print_r($resp);
 
?>
</body>
</html>
