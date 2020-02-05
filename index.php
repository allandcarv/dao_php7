<?php
  require_once("config.php");

  //$root = new Usuario();
  //$root->loadById("1");
  //echo $root;

  //$lista = Usuario::getList();
  //echo json_encode($lista);

  //$search = Usuario::search("user");
  //echo json_encode($search);

  $login = new Usuario();
  $login->login("root", "12345678");
  echo $login;
?>