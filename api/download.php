<?php
$file = "../pdfs/KDMCiramicBath.pdf"; // Path to your PDF file

$file_url = 'http://localhost/kdm/pdfs/KDMCiramicBath.pdf';
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: utf-8");
header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");
readfile($file_url);
