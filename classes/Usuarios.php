<?php

class Usuarios{
    public $mserro = "";
    private $pdo;
 
    public function conectar(){

        global $pdo;

        try {
            $pdo = new PDO('mysql:host=localhost;dbname=usuarios_av;charset=utf8','root','');
        } catch (PDOException $e) {
            echo "erro ao conectar".$e->getMessage();

        }  
       return $pdo;
     
    }

    public function cadastrar($nome,$telefone,$email,$senha){

        //verificar se ja existe email cadastrado

        global $pdo;

        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
        $sql->bindValue(":e", $email);
        $sql->execute();

        if($sql->rowCount() > 0){
            return false; // usuario ja cadastrado
        }else {

            //caso nao, cadastrar
            $sql = $pdo->prepare("INSERT INTO usuarios (nome, telefone, email, senha
                VALUES(:n, :t, :e, :s))");
                $sql->bindValue(":n",$nome);
                $sql->bindValue(":t",$telefone);
                $sql->bindValue(":e",$email);
                $sql->bindValue(":s",md5($senha));
                $sql->execute();
                return true;
        }
    }
 
    public function logar($email, $senha){

        global $pdo;

        //verificar se o email e senha estao cadastrados,  se sim

        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE 
            email = :e AND senha = :s");
            $sql->bindValue(":e",$email);
            $sql->bindValue(":s",md5($senha));
            $sql->execute();
            if($sql->rowCount() > 0){
                //entrar no sistema (usando permisao de sessao)
                $dado = $sql->fetch();
                session_start();
                $_SESSION['id_usuario'] = $dado['id_usuario'];
                return true;

            }else {
                return false; //nao foi possivel logar
            }
    }
}
?>