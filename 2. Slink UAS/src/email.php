<?php

require_once '../vendor/autoload.php';

use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

// Create a Transport object
$transport = Transport::fromDsn('smtp://akuntumbals032@gmail.com:nbixqxcyulvtelpu@smtp.gmail.com:465');

// Create a Mailer object
$mailer = new Mailer($transport);

// Create an Email object
$email = (new Email());

// Set the "From address"
$email->from('akuntumbals032@gmail.com');

// Set the "From address"
$email->to('rdsuryamp@gmail.com');

// Set a "subject"
$email->subject('Kode OTP Verifikasi Akun Slink');

// Set HTML "Body"
$email->html('<h3>Selamat Bergabung Menjadi Bagian Dari Keluarga Besar Slink...</h3>
<h4>0834342242</h4>
<h5>Silahkan Masukan Kode Berikut Ke Halaman Verifikasi</h5>');

// Send the message
$mailer->send($email);
