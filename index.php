<?php
require_once("config.php");

//$root = new Usuario();
//$root->loadById("1");
//echo $root;

//$lista = Usuario::getList();
//echo json_encode($lista);

//$search = Usuario::search("user");
//echo json_encode($search);

//$login = new Usuario();
//$login->login("root", "12345678");
//echo $login;

//$aluno = new Usuario();
//$aluno->setDeslogin('aluno');
//$aluno->setDessenha('123456');
//$aluno->insert();
//echo $aluno;

//$usuario = new Usuario();
//$usuario->loadById(10);
//$usuario->update("professor", "abcdef");
//echo $usuario;

$usuario = new Usuario();
$usuario->loadById(10);
$usuario->delete();
echo $usuario;
