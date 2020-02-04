<?php
  class Usuario {

    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    public function getIdusuario() {
      return $this->idusuario;
    } 
    public function setIdusuario($id): void {
      $this->idusuario = $id;
    }

    public function getDeslogin() {
      return $this->deslogin;
    } 
    public function setDeslogin($login): void {
      $this->deslogin = $login;
    }

    public function getDessenha() {
      return $this->dessenha;
    } 
    public function setDessenha($pass): void {
      $this->dessenha = $pass;
    }

    public function getDtcadastro() {
      return $this->dtcadastro;
    } 
    public function setDtcadastro($date): void {
      $this->dtcadastro = $date;
    }

    public function loadById($id) {

      $sql = new Sql();

      $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario=:ID", array(":ID"=>$id));
      
      if (count($results)) {        
        $row = $results[0];

        $this->setIdusuario($row['idusuario']);
        $this->setDeslogin($row['deslogin']);
        $this->setDessenha($row['dessenha']);
        $this->setDtcadastro(new DateTime($row['dtcadastro']));
      }
    }

    public function __toString():string {
      return json_encode(array(
        "idusuario"=>$this->getIdusuario(),
        "deslogin"=>$this->getDeslogin(),
        "dessenha"=>$this->getDessenha(),
        "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
      ));
    }
  }
?>