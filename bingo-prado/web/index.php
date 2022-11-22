<?php
// Reporting E_NOTICE can be good too (to report uninitialized
// variables or catch variable name misspellings ...)
// error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
error_reporting(E_ALL ^ E_DEPRECATED);
date_default_timezone_set('America/Argentina/Buenos_Aires');

$frameworkPath='./framework/prado.php';

// The following directory checks may be removed if performance is required
$basePath=dirname(__FILE__);
$assetsPath=$basePath.'/assets';
$runtimePath=$basePath.'/protected/runtime';

if(!is_file($frameworkPath))
	die("Unable to find prado framework path $frameworkPath.");
if(!is_writable($assetsPath))
	die("Please make sure that the directory $assetsPath is writable by Web server process.");
if(!is_writable($runtimePath))
	die("Please make sure that the directory $runtimePath is writable by Web server process.");


require_once($frameworkPath);

$application=new TApplication;
$application->run();

?>