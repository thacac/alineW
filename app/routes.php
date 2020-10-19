<?php
	
$w_routes = array(
	['GET', '/', 'Default#home', 'default_home'],
	['GET|POST', '/contact', 'Contact#contact', 'contact'],
	['POST', '/contact', 'Contact#sendMail', 'sendMail'],
);