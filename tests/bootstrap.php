<?php

require dirname(__DIR__ ) . '/app/bootstrap.php';

Tester\Environment::setup();

if (!class_exists('Tester\Assert')) {
	echo "Install Nette Tester using `composer update --dev`\n";
	exit(1);
}
