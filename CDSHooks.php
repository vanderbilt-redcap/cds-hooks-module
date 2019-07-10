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
					'prefetch' => [
						"patient" => "Patient/{{context.patientId}}"
					]
				]
			]
		]);
	}

	function patientView(){
		$data = json_decode(file_get_contents('php://input'), true);
		$prefetch = $data['prefetch'];
		$patient = $prefetch['patient'];
		$name = $patient['name'][0];
		$displayName = implode(' ' , $name['given']) . ' ' . implode(' ',  $name['family']);

		$this->sendJSONResponse([
			"cards" => [
				[
					'summary' => 'REDCap Example Card',
					'indicator' => 'success',
					'detail' => "This is an example CDS Hooks response from REDCap.  The prefetched patient's name is $displayName.",
					'source' => [
						'label' => 'REDCap',
						'url' => APP_PATH_WEBROOT_FULL
					],
					'links' => [
						[
							'label' => 'REDCap Example Survey Link',
							'url' => 'https://redcap.vanderbilt.edu/surveys/?s=X83KEHJ7EA',
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