<?php

	//http://localhost/php-soap-service-list-objects/user_client.php

    echo "<html>";
    echo "<head>";
    echo "<title>User Web Application</title>";
    echo "</head>";
    echo "<body>";

    // Check if SOAP module is enabled with PHP server.
    $soap_enabled = class_exists("SOAPClient"); 
    if ($soap_enabled = 0) {
        die("SOAP Module not found with PHP server.");
    }

    // Create the SOAP client object for the web service.
    // Disable wsdl caching during development.
    ini_set("soap.wsdl_cache_enabled", "0");   

    try {
		// Setup web service URL.
		$ws_url = "http://localhost/php-soap-service-list-objects/user_ws.php";
		
		// Setup WSDL file.
		$wsdl_file = "user.wsdl";
		
		// Setup options for SOAP Client.
		$options = array('location' => $ws_url, 'soap_version'   => SOAP_1_1);
		
		// Create SOAP Client object for invoking web service methods.
		$soapclient = new SoapClient($wsdl_file, $options);

		// Call the web service method.
		$response = $soapclient->getUserList();
		
		//echo var_dump($response);
		//echo var_dump($response->User);
		
		$users = $response->User;
		echo "<br>Number of Users: " . sizeof($users);
		
		echo "<br>";
        echo "<h1>User Information</h1>";
        echo "<table border=1>";
		for ($i = 0; $i < sizeof($users); ++$i) {
			$user = $users[$i];
			echo "<tr>";
			echo "<td>" . $user->LastName . "</td>";
			echo "<td>" . $user->FirstName . "</td>";
			echo "<td>" . $user->Email . "</td>";
			echo "</tr>";
		}
		echo "</table>";
    } catch (Exception $e) {
        echo "<br>Error! ". $e;
        echo $e->getMessage ();
        echo "<br>Last request: ". $soapclient->__getLastRequest();
        echo "<br>Last response: ". $soapclient->__getLastResponse();
    }

    echo "</body>";
    echo "</html>";
