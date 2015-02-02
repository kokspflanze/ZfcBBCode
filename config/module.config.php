<?php
$serverName = isset($_SERVER['SERVER_NAME'])?$_SERVER['SERVER_NAME']:'';

return [
	'zfc-bbcode' => [
		'emoticons' => [
			'active' => false,
			'path' => [
				':)' => $serverName.'/minified/emoticons/smile.png',
				':angel:' => $serverName.'/minified/emoticons/angel.png',
				':angry:' => $serverName.'/minified/emoticons/angry.png',
				'8-)' => $serverName.'/minified/emoticons/cool.png',
				":'(" => $serverName.'/minified/emoticons/cwy.png',
				':ermm:' => $serverName.'/minified/emoticons/ermm.png',
				':D' => $serverName.'/minified/emoticons/grin.png',
				'<3' => $serverName.'/minified/emoticons/heart.png',
				':(' => $serverName.'/minified/emoticons/sad.png',
				':O' => $serverName.'/minified/emoticons/shocked.png',
				':P' => $serverName.'/minified/emoticons/tongue.png',
				';)' => $serverName.'/minified/emoticons/wink.png',
				':alien:' => $serverName.'/minified/emoticons/alien.png',
				':blink:' => $serverName.'/minified/emoticons/blink.png',
				':blush:' => $serverName.'/minified/emoticons/blush.png',
				':cheerful:' => $serverName.'/minified/emoticons/cheerful.png',
				':devil:' => $serverName.'/minified/emoticons/devil.png',
				':dizzy:' => $serverName.'/minified/emoticons/dizzy.png',
				':getlost:' => $serverName.'/minified/emoticons/getlost.png',
				':kissing:' => $serverName.'/minified/emoticons/kissing.png',
				':ninja:' => $serverName.'/minified/emoticons/ninja.png',
				':pinch:' => $serverName.'/minified/emoticons/pinch.png',
				':pouty:' => $serverName.'/minified/emoticons/pouty.png',
				':sick:' => $serverName.'/minified/emoticons/sick.png',
				':sideways:' => $serverName.'/minified/emoticons/sideways.png',
				':silly:' => $serverName.'/minified/emoticons/silly.png',
				':sleeping:' => $serverName.'/minified/emoticons/sleeping.png',
				':unsure:' => $serverName.'/minified/emoticons/unsure.png',
				':woot:' => $serverName.'/minified/emoticons/woot.png',
				':wassat:' => $serverName.'/minified/emoticons/wassat.png'
			]
		]
	],
	'service_manager' => [
		'invokables' => [
			'zfc-bbcode_parser' => 'ZfcBBCode\Service\SBBCodeParser',
		],
	],
];