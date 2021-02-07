<?php 

require $_SERVER['DOCUMENT_ROOT'] . "/model/connection.php";
require $_SERVER['DOCUMENT_ROOT'] . "/model/foundation-model.php";

$request = str_replace($_SERVER['QUERY_STRING'],"",$_SERVER['REQUEST_URI']);
$request = rtrim($request,'/?');
$request = str_replace("/foundation","",$request);

switch($request) {
  case "":
    $search_query = "";
    if(isset($_GET['search'])) { $search_query = filter_input(INPUT_GET,'search',FILTER_SANITIZE_STRING); }
    $foundations = get_foundations($search_query);
    include $_SERVER['DOCUMENT_ROOT'] . '/view/list-foundations.php';
    break;
  default:
    if(is_numeric(ltrim($request,'/'))){
        $foundation_id = ltrim($request,'/');
        $foundation = get_foundation($foundation_id);
        if($foundation) {
          require $_SERVER['DOCUMENT_ROOT'] . "/model/contact-model.php";
          require $_SERVER['DOCUMENT_ROOT'] . "/model/program-model.php";
          $foundation_contacts = get_foundation_contacts($foundation_id);
          $foundation_programs = get_foundation_programs($foundation_id);
          include $_SERVER['DOCUMENT_ROOT'] . '/view/details-foundation.php';
        } else {
            include $_SERVER['DOCUMENT_ROOT'] . '/view/404.php';
        }
    } else {
        include $_SERVER['DOCUMENT_ROOT'] . '/view/404.php';
    }
}