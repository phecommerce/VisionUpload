<?php
include "includes/googledata.php";
include "includes/database.php";
include "includes/email.php";

$google = new Email();

$google->connectGmail();
$google->downloadSearchAttachments();
$google->downloadTrafficAttachments();
$google->downloadTransactionAttachments(); 

?>
