<?php
   require_once './_main.inc.php';
   if($_GET["query"]==="user"){
     $myuser=new user("czp","liddk");
     $myuser->createUser();
   }
   if($_GET["query"]==="survey"){
     
   }
  ?>
  