<?php

include('../includes/init.php');

$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$description = $_POST['description'];

$query = "INSERT INTO `EnquiryCart`(`CompanyName`, `E-Mail`, `Mobile`, `Description`) VALUES (?,?,?,?)";
$params = [$name, $email, $mobile, $description];

execute($query, $params);
