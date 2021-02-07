<?php

/* THIS IS OUR MAIN ROUTER */

// get requested path
$request = str_replace($_SERVER['QUERY_STRING'],"",$_SERVER['REQUEST_URI']);
$request = ltrim($request,'/');
if(strpos($request, "/")!==false) {
  $request = '/' . substr($request, 0, strpos($request, "/"));
} else {
  $request = '/' . $request;
}
$request = rtrim($request,'/?');



switch($request) {
  case "":
    include $_SERVER['DOCUMENT_ROOT'] . '/view/home.php';
    break;
  case "/foundation":
    include $_SERVER['DOCUMENT_ROOT'] . '/controller/foundation.php'; 
    break;
  case "/contact":
    include $_SERVER['DOCUMENT_ROOT'] . '/controller/contact.php'; 
    break;
  case "/program":
    include $_SERVER['DOCUMENT_ROOT'] . '/controller/program.php'; 
    break;
  default:
    include $_SERVER['DOCUMENT_ROOT'] . '/view/404.php';
}

