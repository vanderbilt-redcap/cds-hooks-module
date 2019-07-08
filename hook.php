<?php

$data = [
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
];

header('Content-Type: application/json');
echo json_encode($data, JSON_PRETTY_PRINT);