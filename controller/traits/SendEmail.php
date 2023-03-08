<?php
    trait SendEmail {
        function SendEmail($message) {
            $this->EmailQueueApiCall($message);
        }

        function EmailQueueApiCall($messages = false) {
                    
            include_once "config/application.config.inc.php"; // Include emailqueue configuration.
            include_once "config/db.config.inc.php"; // Include Emailqueue's database connection configuration.
            include_once "scripts/emailqueue_inject.class.php"; // Include Emailqueue's emailqueue_inject class.
            
            $emailqueue_inject = new Emailqueue\emailqueue_inject(EMAILQUEUE_DB_HOST, EMAILQUEUE_DB_UID, EMAILQUEUE_DB_PWD, EMAILQUEUE_DB_DATABASE); // Creates an emailqueue_inject object. Needs the database connection information.
            
        	// Use a try ... catch statement to capture errors
        	try {
        		// Call the emailqueue_inject::inject method to inject an email
        		$result = $emailqueue_inject->inject($messages);
        	} catch (Exception $e) {
        		echo "Emailqueue error: ".$e->getMessage()."<br>";
        	}
        }
    }