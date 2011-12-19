<?php
/**
 * Uma simples função que demonstrara como deve ser chamado o servidor WebService do Moodle/SistemaAula.
 *
 * Esta função é a mesma para qualquer chamada WebService do Moodle.
 *
 * @param String $host // IP ou Nome do Host
 * @param String $install // Diretorio de instalação do Moodle (exemplo ead)
 * @param String $token // Token fornecedido pelo administrador do Moodle
 * @param String $action // Nome da ação/mensagem a ser socilidada no WebService
 * @param Array  $params // Array com os parametros que serão parassados para Action do WebService
 * @param String $service // Tipo de serviço que será usado (soap, rest, xmlrpc ou amf)
 */
function callService($host, $install,  $token, $action, $params, $service = "soap", $XDEBUG='') {

	$resp = null;
	if($service == "soap"){
		$service = "webservice/soap/server.php";
		$url = "http://$host/$install/$service";

		$serverurl = "$url?wstoken=$token&wsdl=1";
		if($XDEBUG!=''){
			$serverurl .= "&XDEBUG_SESSION_START=ECLIPSE_DBGP&KEY=$XDEBUG";
		}

		$client = new SoapClient($serverurl);
		try {
			$resp = $client->__soapCall($action, $params);
		} catch (Exception $e) {
			print_r($e);
			return null;
		}
		
	}
	return $resp;
}

