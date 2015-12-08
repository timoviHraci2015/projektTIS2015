<?php

$sender   = "Sender Name";             //senders name
$mailfrom = "email@adress.com";        //senders e-mail adress
$mailto   = "mstevanak@gmail.com";      //recipient

$subject  = "Subject for reviever";    //subject
$message  = "The text for the mail.  
We should read now.
Hej Hej";                          //mail body message

$header  = "MIME-Version 1.0\r\n";
$header .= "Content-type: text/plain; charset=iso-8859-1\r\n";
$header .= "From: ".$sender." <".$mailfrom.">\r\n";
$header .= "Reply-To: ".$mailfrom."\r\n";
$header .= "X-Mailer: PHP/".phpversion();

$success = mail($mailto, $subject, $message, $header);

if($success) echo 'Ok, mail sent';
else         echo 'Sorry, mail failure';

?> 