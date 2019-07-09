<?php
header("Access-Control-Allow-Origin: http://sandbox.cds-hooks.org");
header("Access-Control-Allow-Headers: Authorization, Content-Type");

$cdsUrl = $_GET['cds-url'];
$parts = explode('/', $_GET['cds-url']);
$serviceId = @$parts[2];

if($parts[1] !== 'cds-services'){
	$module->sendErrorResponse("A URL ending in 'cds-url=/cds-services' was expected.");
}

if(empty($serviceId)){
	$module->listServices();
}
else if($serviceId === 'patient-view'){
	$module->patientView();
}
else{
	$module->sendErrorResponse("A service could not be found with the following id: $serviceId");
}
