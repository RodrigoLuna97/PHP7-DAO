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

			$row = $results[0];

			$this->setIdusuario($row['id_usuario']);
			$this->setLogin($row['login']);
			$this->setSenha($row['senha']);
			$this->setDataCadastro(new DateTime($row['data_cadastro']));
		}

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