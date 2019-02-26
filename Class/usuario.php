<?php 

class Usuario{

	private $id_usuario;
	private $login;
	private $senha;
	private $data_cadastro;

	public function setIdusuario($id_usuario){
		$this->id_usuario = $id_usuario;
	}
	public function getIdusuario(){
		return $this->id_usuario;
	}
	public function setLogin($login){
		$this->login = $login;
	}
	public function getLogin(){
		return $this->login;
	}
	public function setSenha($senha){
		$this->senha = $senha;
	}
	public function getSenha(){
		return $this->senha;
	}
	public function setDataCadastro($data_cadastro){
		$this->data_cadastro = $data_cadastro;
	}
	public function getDataCadastro(){
		return $this->data_cadastro;
	}

	public function LoadById($id){

		$sql = new Sql();
		$results = $sql->Select("SELECT * FROM tb_usuarios where id_usuario = :ID", array(":ID"=>$id));

		if(count($results)>0){

		$this->setDados($results[0]);

		}

	}

	public static function getList(){
		$sql = new Sql();
		return $sql->select("SELECT * from tb_usuarios order by login");
	}

	public static function search($login){
		$sql = new Sql();
		return $sql->select("SELECT * from tb_usuarios where login like :SEARCH order by login", array(
			':SEARCH'=>"%".$login."%"
		));
	}

	public function login($login,$senha){
		$sql = new Sql();
		$results = $sql->Select("SELECT * FROM tb_usuarios where login = :LOGIN and senha = :SENHA", array(":LOGIN"=>$login,":SENHA"=>$senha));

		if(count($results)>0){

			$this->setDados($results[0]);
	
		} else {
			throw new Exception("Login e ou senha inválidos", 1);
			
		}
	}

	public function setDados($dados){
		$this->setIdusuario($dados['id_usuario']);
		$this->setLogin($dados['login']);
		$this->setSenha($dados['senha']);
		$this->setDataCadastro(new DateTime($dados['data_cadastro']));
	}

	public function insert(){
		$sql = new Sql();
		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN,:SENHA)", array(
			':LOGIN'=>$this->getLogin(),
			':SENHA'=>$this->getSenha()
		));

		if(count($results) > 0 ){
			$this->setDados($results[0]);
		}

	}

	public function update($login, $senha){

		$this->setLogin($login);
		$this->setSenha($senha);

		$sql= new Sql();
		$sql->query("UPDATE tb_usuarios set login = :LOGIN, senha = :SENHA WHERE id_usuario = :ID", array(
			':LOGIN'=>$this->getLogin(),
			':SENHA'=>$this->getSenha(),
			':ID'=>$this->getIdusuario()
		));

	}

	public function __construct($login="", $senha=""){
		$this->setLogin($login);
		$this->setSenha($senha);
	}

	public function __toString(){
		return json_encode(array(
			"id_usuario"=>$this->getIdusuario(),
			"login"=>$this->getLogin(),
			"senha"=>$this->getSenha(),
			"data_cadastro"=>$this->getDataCadastro()->format("d/m/Y H:i:s")
		));
	}

}

 ?>