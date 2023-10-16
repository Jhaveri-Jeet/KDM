<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

define("BASE_DIR", $_SERVER['DOCUMENT_ROOT'] . "/kdm");
define("BASE_URL", "/kdm");

date_default_timezone_set('Asia/Kolkata');

$connection = new PDO("mysql:host=localhost;port=3306;dbname=kdm", "root", "");

$englishToGujaratiNumberMappings = array(
    "0" => "૦",
    "1" => "૧",
    "2" => "૨",
    "3" => "૩",
    "4" => "૪",
    "5" => "૫",
    "6" => "૬",
    "7" => "૭",
    "8" => "૮",
    "9" => "૯",
    "-" => "-",
    "." => ".",
    "+" => "+",
);

$gujaratiToEnglishNumberMappings = array(
    "૦" => "0",
    "૧" => "1",
    "૨" => "2",
    "૩" => "3",
    "૪" => "4",
    "૫" => "5",
    "૬" => "6",
    "૭" => "7",
    "૮" => "8",
    "૯" => "9",
    "-" => "-",
    "." => ".",
    "+" => "+",
);

function englishToGujarati($value)
{
    global $englishToGujaratiNumberMappings;
    $array = mb_str_split($value);
    $result = "";

    foreach ($array as $engChar) {

        $gujChar = $englishToGujaratiNumberMappings[$engChar];
        $result .= $gujChar;
    }

    return $result;
}

function gujaratiToEnglish($value)
{
    global $gujaratiToEnglishNumberMappings;

    $array = mb_str_split($value);
    $result = "";

    foreach ($array as $gujChar) {
        $engChar = $gujaratiToEnglishNumberMappings[$gujChar];
        $result .= $engChar;
    }

    return $result;
}

function pathOf($path)
{
    return BASE_DIR . "/" . $path;
}

function urlOf($path)
{
    return BASE_URL . '/' . $path;
}

function execute($query, $params = null)
{
    global $connection;

    $statement = $connection->prepare($query);
    return $statement->execute($params);
}

function selectOne($query, $params = null)
{
    global $connection;

    $statement = $connection->prepare($query);
    $statement->execute($params);

    $row = $statement->fetch(PDO::FETCH_ASSOC);
    return $row;
}

function select($query, $params = null)
{
    global $connection;

    $statement = $connection->prepare($query);
    $statement->execute($params);

    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function lastInsertId()
{
    global $connection;
    return $connection->lastInsertId();
}

function getLastError()
{
    global $connection;
    return $connection->errorInfo();
}
function test($string)
{
    return preg_replace(
        '/[^\x{0009}\x{000a}\x{000d}\x{0020}-\x{D7FF}\x{E000}-\x{FFFD}]+/u',
        ' ',
        $string
    );
}
session_start();
