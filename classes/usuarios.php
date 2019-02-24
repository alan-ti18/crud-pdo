<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 23/02/2019
 * Time: 23:43
 */

class Usuario
{
    private $pdo;
    public $msgErro = "";

    public function conectar($nome, $host, $usuario, $senha){
        global $pdo;
        try{
            $pdo = new PDO("mysql:dbname:".$nome.";host=".$host,$usuario,$senha);
        } catch (PDOException $e){
            $msgErro = $e->getMessage();
        }
    }

    public function cadastrar($nome, $telefone, $email, $senha){
        global $pdo;
        /*Verificar se já existe o e-mail cadastrado*/
            $sql = $pdo->prepare("select id_usuario from usuarios where email_usuario = :e");
            $sql->bindValue(":e",$email);
            $sql->execute();
            if ($sql->rowCount() > 0){
                return false; /*já está cadastrado*/
                echo "Já está cadastrado";
            }else{
                /*caso não, cadastrar*/
                $sql = $pdo->prepare("insert into usuarios (nome_usuario, telefone_usuario, email_usuario, senha_usuario) values (:n, :t, :e, :s)");
                $sql->bindValue(":n",$nome);
                $sql->bindValue(":t",$telefone);
                $sql->bindValue(":e",$email);
                $sql->bindValue(":s",md5($senha));
                $sql->execute();
                return true;
            }
    }

    public function logar($user, $senha){
        global $pdo;
//      /*verificar se o e-mail e senha estão cadastrados, se sim*/
        $sql = $pdo->prepare("select id_usuario from usuarios where email = :u and senha = :s");
        $sql->bindValue(":u", $user);
        $sql->bindValue(":s", md5($senha));
        $sql->execute();
        if ($sql->rowCount() > 0){
            /*entrar no sistema (sessão)*/
            $dado = $sql->fetch();  /*fetch pega o que veio do banco e transforma num array */
            session_start();
            $_SESSION['id_usuario'] = $dado['id_usuario'];
            return true; /*Logado com sucesso*/
        }else{
            return false; /*não foi possível logar*/
        }




    }


}





?>