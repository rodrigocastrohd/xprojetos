<?php
require_once 'classes/usuarios.php';
    $u = new Usuarios;
?>


<html lang="pt-br">
    <head>
        <meta charset="utf-8"/>
        <title>Projeto Login</title>
        <link rel="stylesheet" href="Css/stilo.css">
    </head>
    <body>
        <div id="corpologin">
        <h1>Cadastrar</h1>
        <form method="POST">
            <input type="text" name="nome" placeholder="Nome Completo" maxlength="30">
            <input type="text" name="telefone" placeholder="Telefone" maxlength="30">
            <input type="email" name="email" placeholder="Usuario" maxlength="40">
            <input type="password" name="senha" placeholder="Senha" maxlength="15">
            <input type="password" name="confirmarsenha" placeholder="ConfirmarSenha" maxlength="15">
            <input type="submit" value="Cadastrar">
           
        </form>
        
    </div>

<?php
 
 // verificar se o usuario clicou no botao

 if(isset($_POST['nome'])){

     $nome           = addslashes($_POST['nome']);
     $telefone       = addslashes($_POST['telefone']);
     $email          = addslashes($_POST['email']);
     $senha          = addslashes($_POST['senha']);
     $confirmarsenha = addslashes($_POST['confirmarsenha']);

     //verificar se os campos estao preenchidos

     if(!empty($nome) && !empty($telefone) && !empty($email) && !empty(
         $senha) && !empty($confirmarsenha)){

            $u->cadastrar("usuarios_av","localhost","root","");
            if($u->$mserro == "")//se esta tudo ok
            {
                if($senha == $confirmarsenha){
                    if($u->cadastrar($nome,$telefone,$email,$senha)){
                        echo "Cadastrado com sucesso! Acesse para entrar";
                    }else{
                        echo "Email ja cadastrado";
                    }
                }else{
                    echo "senha e confirmarsenha não correspondem";
                }

           }else{
               echo "erro".$u->$mserro();
            }

         }else{
             echo "preencha todos os dados";
         }
  
}

?>
    </body>
</html>