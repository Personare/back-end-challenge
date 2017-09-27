<?php

$routing = array(
	'/\/(.*?)\/(.*?)\/(.*)/' => '/\1_\2/\3'
);

$default['controller'] = 'index';
$default['action'] = 'index';