<?php

require_once '../vendor/autoload.php';

use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

// Create a Transport object
$transport = Transport::fromDsn('smtp://akuntumbals032@gmail.com:nicumanakuntumbal02@smtp.gmail.com:857');

// Create a Mailer object
$mailer = new Mailer($transport);

// Create an Email object
$email = (new Email());

// Set the "From address"
$email->from('akuntumbals032@gmail.com');

// Set the "From address"
$email->to('rdsuryamp@gmail.com');

// Set a "subject"
$email->subject('Demo message using the Symfony Mailer library.');

// Set the plain-text "Body"
$email->text('This is the plain text body of the message.\nThanks,\nAdmin');

// Set HTML "Body"
$email->html('This is the HTML version of the message.');


// Send the message
$mailer->send($email);
