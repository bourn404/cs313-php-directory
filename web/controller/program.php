<?php 

require $_SERVER['DOCUMENT_ROOT'] . "/model/connection.php";
require $_SERVER['DOCUMENT_ROOT'] . "/model/program-model.php";

$request = str_replace($_SERVER['QUERY_STRING'],"",$_SERVER['REQUEST_URI']);
$request = rtrim($request,'/?');
$request = str_replace("/program","",$request);

switch($request) {
  case "":
    $search_query = "";
    if(isset($_GET['search'])) { $search_query = filter_input(INPUT_GET,'search',FILTER_SANITIZE_STRING); }
    $programs = get_programs($search_query);
    include $_SERVER['DOCUMENT_ROOT'] . '/view/list-programs.php';
    break;
  default:
    include $_SERVER['DOCUMENT_ROOT'] . '/view/404.php';
    break;
}