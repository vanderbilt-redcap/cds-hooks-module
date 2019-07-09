<?php
namespace Vanderbilt\CDSHooks;

class CDSHooks extends \ExternalModules\AbstractExternalModule{
	function listServices(){
		$this->sendJSONResponse([
			"services" => [
				[
					'hook' => 'patient-view',
					'name' => 'REDCap CDS Service Example',
					'description' => 'A simple REDCap CDS Service example.',
					'id' => 'patient-view',
					"prefetch" => [
						'patientToGreet' => 'Patient/{{Patient.id}}'
					]
				]
			]
		]);
	}

	function patientView(){
		$this->sendJSONResponse([
			"cards" => [
				[
					'summary' => 'REDCap Example Card',
					'indicator' => 'success',
					'detail' => 'This is an example CDS Hooks response from REDCap.',
					'source' => [
						'label' => 'REDCap',
						'url' => APP_PATH_WEBROOT_FULL
					],
					'links' => [
						[
							'label' => 'REDCap Example Link',
							'url' => APP_PATH_WEBROOT_FULL,
							'type' => 'absolute'
						]
					]
				]
			]
		]);
	}

	function sendJSONResponse($content){
		header('Content-Type: application/json');
		die(json_encode($content, JSON_PRETTY_PRINT));
	}

	function sendErrorResponse($content){
		http_response_code(400);
		die($content);
	}
}