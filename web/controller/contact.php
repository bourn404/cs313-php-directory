<?php 

require $_SERVER['DOCUMENT_ROOT'] . "/model/connection.php";
require $_SERVER['DOCUMENT_ROOT'] . "/model/contact-model.php";

$request = str_replace($_SERVER['QUERY_STRING'],"",$_SERVER['REQUEST_URI']);
$request = rtrim($request,'/?');
$request = str_replace("/contact","",$request);

switch($request) {
  case "":
    $search_query = "";
    if(isset($_GET['search'])) { $search_query = filter_input(INPUT_GET,'search',FILTER_SANITIZE_STRING); }
    $contacts = get_contacts($search_query);
    include $_SERVER['DOCUMENT_ROOT'] . '/view/list-contacts.php';
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