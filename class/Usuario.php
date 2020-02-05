<?php
class Usuario
{

  private $idusuario;
  private $deslogin;
  private $dessenha;
  private $dtcadastro;

  public function getIdusuario()
  {
    return $this->idusuario;
  }
  public function setIdusuario($id): void
  {
    $this->idusuario = $id;
  }

  public function getDeslogin()
  {
    return $this->deslogin;
  }
  public function setDeslogin($login): void
  {
    $this->deslogin = $login;
  }

  public function getDessenha()
  {
    return $this->dessenha;
  }
  public function setDessenha($pass): void
  {
    $this->dessenha = $pass;
  }

  public function getDtcadastro()
  {
    return $this->dtcadastro;
  }
  public function setDtcadastro($date): void
  {
    $this->dtcadastro = $date;
  }

  public function loadById($id)
  {

    $sql = new Sql();

    $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario=:ID", array(":ID" => $id));

    if (count($results)) {
      $row = $results[0];

      $this->setIdusuario($row['idusuario']);
      $this->setDeslogin($row['deslogin']);
      $this->setDessenha($row['dessenha']);
      $this->setDtcadastro(new DateTime($row['dtcadastro']));
    }
  }

  public static function getList()
  {
    $sql = new Sql();

    return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
  }

  public static function search($login)
  {
    $sql = new Sql();

    return $sql->select(
      "SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin",
      array(":SEARCH" => "%" . $login . "%")
    );
  }

  public function login($login, $senha)
  {
    $sql = new Sql();

    $result = $sql->select(
      "SELECT * FROM tb_usuarios WHERE deslogin=:LOGIN AND dessenha=:SENHA",
      array(
        ":LOGIN" => $login,
        ":SENHA" => $senha
      )
    );

    if (count($result)) {
      $row = $result[0];

      $this->setIdusuario($row['idusuario']);
      $this->setDeslogin($row['deslogin']);
      $this->setDessenha($row['dessenha']);
      $this->setDtcadastro(new DateTime($row['dtcadastro']));
    } else {
      throw new Exception("Login e/ou senha inválidos");
    }
  }

  public function insert()
  {
    $sql = new Sql();

    $results = $sql->select(
      "CALL sp_usuarios_insert(:LOGIN, :PASSWORD)",
      array(
        ":LOGIN" => $this->getDeslogin(),
        ":PASSWORD" => $this->getDessenha(),
      )
    );

    if (count($results)) {
      $row = $results[0];

      $this->setIdusuario($row['idusuario']);
      $this->setDeslogin($row['deslogin']);
      $this->setDessenha($row['dessenha']);
      $this->setDtcadastro(new DateTime($row['dtcadastro']));
    } else {
      throw new Exception("Login e/ou senha inválidos");
    }
  }

  public function update($login, $password)
  {
    $this->setDeslogin($login);
    $this->setDessenha($password);

    $sql = new Sql();
    $sql->query(
      "UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID",
      array(
        ":LOGIN" => $this->getDeslogin(),
        ":PASSWORD" => $this->getDessenha(),
        ":ID" => $this->getIdusuario()
      )
    );
  }

  public function __toString(): string
  {
    return json_encode(array(
      "idusuario" => $this->getIdusuario(),
      "deslogin" => $this->getDeslogin(),
      "dessenha" => $this->getDessenha(),
      "dtcadastro" => $this->getDtcadastro()->format("d/m/Y H:i:s")
    ));
  }
}
