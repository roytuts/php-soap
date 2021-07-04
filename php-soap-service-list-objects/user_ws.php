<?php

function getUserList() {
	
	/*The following data will actually be fetched from database or any external service*/
	$user1 = new StdClass();
	$user1->LastName = 'Tester';
	$user1->FirstName = 'Jane';
	$user1->Email = 'jtester@testco.com';
	
	$user2 = new StdClass();
	$user2->LastName = 'Tester 2';
	$user2->FirstName = 'Jhon';
	$user2->Email = 'jtester2@testco.com';
	
	$users = array();
	$users[0] = $user1;
	$users[1] = $user2;
	
	$Users = new StdClass();
	$Users->User = $users;
	
	return $Users;
}

// Disable WSDL cache during development.
ini_set("soap.wsdl_cache_enabled", "0"); 

// Create SOAP server object to serve the web service.
$server = new SoapServer("user.wsdl");

// Add the web service methods to the server to handle them.
$server->addFunction("getUserList");

$server->handle();
