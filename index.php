<?php 

require_once("config.php");


//carrega somente um usuário
//$root = new Usuario();
//$root->loadById(3);
//echo $root;

//carrega uma lista de usuários
//$lista = usuario::getList();
//echo json_encode($lista);

//carrega uma lista de usuários buscando pelo login
//$search = Usuario::search("o");
//echo json_encode($search);

//carrega um usuário usando o login e senha
//$usuario = new Usuario();
//$usuario->login("root","123");
//echo $usuario;

//insert de um usuário novo
//$aluno = new Usuario("irineu", "abc123");
//$aluno->insert();
//echo $aluno;

/*update do usuário
$usuario = new Usuario();
$usuario->loadById(7);
$usuario->update("voce", "qwerty");
echo $usuario;*/


$usuario = new Usuario();
$usuario->loadById(6);
$usuario->delete();
echo $usuario;


/* SELECT COM JSON ENCODE
$sql = new Sql();
$usuarios = $sql->select("SELECT * FROM tb_usuarios");
echo json_encode($usuarios);
*/
 ?>
