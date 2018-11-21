<?php
use Tracy\Debugger;

require dirname(__DIR__ ) . '/vendor/autoload.php';

$loader = new Nette\Loaders\RobotLoader;
$loader->addDirectory(__DIR__ );
// And set caching to the 'temp' directory
$loader->setTempDirectory(dirname(__DIR__) . '/temp');
$loader->register(); // Run the RobotLoader

//
//
//Debugger::enable();
//Debugger::$strictMode = true;



