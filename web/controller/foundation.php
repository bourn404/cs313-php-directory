<?php 

require $_SERVER['DOCUMENT_ROOT'] . "/model/connection.php";
require $_SERVER['DOCUMENT_ROOT'] . "/model/foundation-model.php";

$request = str_replace($_SERVER['QUERY_STRING'],"",$_SERVER['REQUEST_URI']);
$request = str_replace("/foundation","",$request);
$request = ltrim($request,'/');
if(strpos($request, "/")!==false) {
  $request = '/' . substr($request, 0, strpos($request, "/"));
} else {
  $request = '/' . $request;
}
$request = rtrim($request,'/?');




switch($request) {
  case "":
    $search_query = "";
    if(isset($_GET['search'])) { $search_query = filter_input(INPUT_GET,'search',FILTER_SANITIZE_STRING); }
    $foundations = get_foundations($search_query);
    include $_SERVER['DOCUMENT_ROOT'] . '/view/list-foundations.php';
    break;
  case "/add":
    $foundation['id'] = "";
    $foundation['org_name'] = "";
    $foundation['address1'] = "";
    $foundation['city'] = "";
    $foundation['state'] = "";
    $foundation['zip'] = "";
    $foundation['website'] = "";
    $submit_text = "+ Create Foundation";
    $page_title = "Add Foundation";
    if($_POST) {
      // sanitize inputs
        $foundation['id'] = filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT);
        $foundation['org_name'] = filter_input(INPUT_POST,'org_name',FILTER_SANITIZE_STRING);
        $foundation['address1'] = filter_input(INPUT_POST,'address1',FILTER_SANITIZE_STRING);
        $foundation['city'] = filter_input(INPUT_POST,'city',FILTER_SANITIZE_STRING);
        $foundation['state'] = filter_input(INPUT_POST,'state',FILTER_SANITIZE_STRING);
        $foundation['zip'] = filter_input(INPUT_POST,'zip',FILTER_SANITIZE_STRING);
        $foundation['website'] = filter_input(INPUT_POST,'website',FILTER_SANITIZE_STRING);
      
        if($foundation['org_name']) {
          // save to database
          $db_result = save_foundation($foundation);
          if($db_result) {
            //success
            header("Location: /foundation/".$db_result);
          }
          // redirect to details or display error
        }
    }
    include $_SERVER['DOCUMENT_ROOT'] . '/view/form-foundation.php';
    break;
  case '/edit':
    $request = str_replace($_SERVER['QUERY_STRING'],"",$_SERVER['REQUEST_URI']);
    $foundation_id = substr($request, strrpos($request, '/') + 1);
    $foundation = get_foundation($foundation_id);
    $submit_text = "Save Details";
    $page_title = "Edit Foundation";
    if($_POST) {
      // sanitize inputs
        $foundation['id'] = filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT);
        $foundation['org_name'] = filter_input(INPUT_POST,'org_name',FILTER_SANITIZE_STRING);
        $foundation['address1'] = filter_input(INPUT_POST,'address1',FILTER_SANITIZE_STRING);
        $foundation['city'] = filter_input(INPUT_POST,'city',FILTER_SANITIZE_STRING);
        $foundation['state'] = filter_input(INPUT_POST,'state',FILTER_SANITIZE_STRING);
        $foundation['zip'] = filter_input(INPUT_POST,'zip',FILTER_SANITIZE_STRING);
        $foundation['website'] = filter_input(INPUT_POST,'website',FILTER_SANITIZE_STRING);
      
        if($foundation['org_name']) {
          // save to database
          $db_result = save_foundation($foundation);
          if($db_result) {
            //success
            header("Location: /foundation/".$db_result);
          }
          // redirect to details or display error
        }
    }
    include $_SERVER['DOCUMENT_ROOT'] . '/view/form-foundation.php';

    break;
  case '/delete':
    $request = str_replace($_SERVER['QUERY_STRING'],"",$_SERVER['REQUEST_URI']);
    $foundation_id = substr($request, strrpos($request, '/') + 1);
    $request = delete_foundation($foundation_id);
    header("Location: /foundation/");
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