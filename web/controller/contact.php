<?php 

require $_SERVER['DOCUMENT_ROOT'] . "/model/connection.php";
require $_SERVER['DOCUMENT_ROOT'] . "/model/contact-model.php";

$request = str_replace($_SERVER['QUERY_STRING'],"",$_SERVER['REQUEST_URI']);
$request = str_replace("/contact","",$request);
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
    $contacts = get_contacts($search_query);
    include $_SERVER['DOCUMENT_ROOT'] . '/view/list-contacts.php';
    break;
  case "/add":
    $contact['id'] = "";
    $contact['first_name'] = "";
    $contact['last_name'] = "";
    $contact['organization_id'] = "";
    $contact['title'] = "";
    $contact['is_primary_contact'] = "";
    $contact['email'] = "";
    $contact['phone'] = "";
    $contact['notes'] = "";
    $submit_text = "+ Create Contact";
    $page_title = "Add Contact";
    require $_SERVER['DOCUMENT_ROOT'] . "/model/foundation-model.php";
    $foundations = get_foundations();
    if($_POST) {
      // sanitize inputs
        $contact['id'] = filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT);
        $contact['first_name'] = filter_input(INPUT_POST,'first_name',FILTER_SANITIZE_STRING);
        $contact['last_name'] = filter_input(INPUT_POST,'last_name',FILTER_SANITIZE_STRING);
        $contact['organization_id'] = filter_input(INPUT_POST,'organization_id',FILTER_SANITIZE_NUMBER_INT);
        $contact['title'] = filter_input(INPUT_POST,'title',FILTER_SANITIZE_STRING);
        $contact['is_primary_contact'] = filter_input(INPUT_POST,'is_primary_contact',FILTER_SANITIZE_NUMBER_INT);
        $contact['email'] = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
        $contact['phone'] = filter_input(INPUT_POST,'phone',FILTER_SANITIZE_STRING);
        $contact['notes'] = filter_input(INPUT_POST,'notes',FILTER_SANITIZE_STRING);
      
        if($contact['first_name']) {
          // save to database
          $db_result = save_contact($contact);
          if($db_result) {
            //success
            header("Location: /contact/".$db_result);
          }
          // redirect to details or display error
        }
    }
    include $_SERVER['DOCUMENT_ROOT'] . '/view/form-contact.php';
    break;
  case '/edit':
    $request = str_replace($_SERVER['QUERY_STRING'],"",$_SERVER['REQUEST_URI']);
    $contact_id = substr($request, strrpos($request, '/') + 1);
    $contact = get_contact($contact_id);
    $submit_text = "Save Contact";
    $page_title = "Edit Contact";
    require $_SERVER['DOCUMENT_ROOT'] . "/model/foundation-model.php";
    $foundations = get_foundations();
    if($_POST) {
      // sanitize inputs
        $contact['id'] = filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT);
        $contact['first_name'] = filter_input(INPUT_POST,'first_name',FILTER_SANITIZE_STRING);
        $contact['last_name'] = filter_input(INPUT_POST,'last_name',FILTER_SANITIZE_STRING);
        $contact['organization_id'] = filter_input(INPUT_POST,'organization_id',FILTER_SANITIZE_NUMBER_INT);
        $contact['title'] = filter_input(INPUT_POST,'title',FILTER_SANITIZE_STRING);
        $contact['is_primary_contact'] = filter_input(INPUT_POST,'is_primary_contact',FILTER_SANITIZE_NUMBER_INT);
        $contact['email'] = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
        $contact['phone'] = filter_input(INPUT_POST,'phone',FILTER_SANITIZE_STRING);
        $contact['notes'] = filter_input(INPUT_POST,'notes',FILTER_SANITIZE_STRING);
      
        if($contact['first_name']) {
          // save to database
          $db_result = save_contact($contact);
          if($db_result) {
            //success
            header("Location: /contact/".$db_result);
          }
          // redirect to details or display error
        }
    }
    include $_SERVER['DOCUMENT_ROOT'] . '/view/form-contact.php';

    break;
  case '/delete':
    $request = str_replace($_SERVER['QUERY_STRING'],"",$_SERVER['REQUEST_URI']);
    $contact_id = substr($request, strrpos($request, '/') + 1);
    $request = delete_contact($contact_id);
    header("Location: /contact/");
    break;
  default:
    if(is_numeric(ltrim($request,'/'))){
        $contact_id = ltrim($request,'/');
        $contact = get_contact($contact_id);
        if($contact) {
            include $_SERVER['DOCUMENT_ROOT'] . '/view/details-contact.php';
        } else {
            include $_SERVER['DOCUMENT_ROOT'] . '/view/404.php';
        }
    } else {
        include $_SERVER['DOCUMENT_ROOT'] . '/view/404.php';
    }
}