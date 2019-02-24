<?php
   require_once 'classes/usuarios.php';
   $u = new Usuario();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta charset="UTF-8">
   <link rel="stylesheet" href="css/style.css">
   <title>CRUD Treinamento | Cadastro</title>
</head>
<body>
   <div class="box-cadastrar">
      <form method="post">
         <h1>CADASTRAR</h1>
         <div class="input-group">
            <label for="nome">Nome Completo:</label>
            <input type="text" id="nome" name="nome" maxlength="40"/>
         </div>
         <div class="input-group">
            <label for="tel">Telefone</label>
            <input type="text" id="tel" name="tel" maxlength="20"/>
         </div>
         <div class="input-group">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" maxlength="40"/>
         </div>
         <div class="input-group">
            <label for="pass">Senha: </label>
            <input type="password" id="pass" name="pass" />
         </div>
         <div class="input-group">
            <label for="conf-pass">Confirmar Senha: </label>
            <input type="password" id="conf-pass" name="conf-pass" />
         </div>
         <div class="btn-submit">
            <input type="submit" name="submit-login" id="submit-login" value="Cadastrar">
         </div>
      </form>
   </div>
<?php
/*verificar se a pessoa clicou no botão*/
if (isset($_POST['nome'])){    /*O isset verifica a existência de uma variável ou de um array*/
   $nome = addslashes($_POST['nome']);     /*O addslashes impede que códigos*/
   $telefone = addslashes($_POST['tel']);  /*indesejados ou com intenção de*/
   $email = addslashes($_POST['email']);   /*maliciosos possam inserir dados*/
   $senha = addslashes($_POST['pass']);    /*furto de dados*/
   $confSenha = addslashes($_POST['conf-pass']);

   /*Verificar se está preenchido*/
    if (!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confSenha)){
       $u->conectar('estudocrud', 'localhost', 'root', '');
       if ($u->msgErro == ""){
          if ($senha == $confSenha){
            if ($u->cadastrar($nome, $telefone, $email, $senha)){
               echo "Cadastrado com sucesso! Pode entrar com os dados cadastrados!";
            }else{
               echo "E-mail já cadastrado!";
            }
          }else{
             echo "A senha inserida no campo de confirmação não coincide com a senha digitada!";
          }
       }else{
         echo "Erro: ".$u->msgErro;
       }

    }else{
       echo "Preencha todos os campos!";
    }
}
?>

<script type="text/javascript" src="js/script.js"></script>
<script>

</script>
</body>
</html>