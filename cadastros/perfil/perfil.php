<HTML>
   <HEAD>
      <TITLE>Cadastro de perfil</TITLE>
      <META CHARSET="utf-8" />
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   </HEAD>
   <BODY>
   <FORM ACTION="#" METHOD="post">
         <H4>Cadastro de Perfil</H4>

   



         <div class="container-fluid">
         <div class="form-floating mb-3 ">
            <INPUT TYPE="text"   NAME="nomePerfil"   ID="nomePerfil"  class="form-control" placeholder="Digite seu nome" VALUE="<?php print isset($_POST["nomePerfil"])  ?$_POST["nomePerfil"]  :""?>" /> <BR/>
         <label for="email">Perfil :</label>
         </div>
               <INPUT TYPE="hidden" NAME="codigoPerfil" ID="codigoPerfil" VALUE="<?php print isset($_POST["codigoPerfil"])?$_POST["codigoPerfil"]:""?>" />
               <INPUT TYPE="hidden" NAME="tipoOperacao" ID="tipoOperacao" VALUE="<?php print isset($_POST["tipoOperacao"])?$_POST["tipoOperacao"]:""?>"/>
      <?php
         if(isset($_POST["codigoPerfil"])){
            if($_POST["codigoPerfil"] > 0){
               print "<INPUT TYPE=\"button\" VALUE=\"Alterar\" ONCLICK=\"manter('A')\" class=\"btn btn-outline-info\" /> ";
               print "<INPUT TYPE=\"button\" VALUE=\"Excluir\" ONCLICK=\"manter('E')\" class=\"btn btn-outline-info\"/>";
               
            }else{
               print "<INPUT TYPE=\"button\" VALUE=\"Inserir\" ONCLICK=\"manter('I')\" />";
            }
         }else{
            print "<INPUT TYPE=\"button\" VALUE=\"Inserir\" ONCLICK=\"manter('I')\" />";
         }
         
      ?>
      <button type="submit" class="btn btn-outline-info" value="Limpar" onclick="manter('L')">Limpar</button>
      
      </FORM>
      <?php
         if(isset($_POST["tipoOperacao"])){
            $tipoOperacao = $_POST["tipoOperacao"];
            $nomePerfil   = $_POST["nomePerfil"];
            $codigoPerfil = $_POST["codigoPerfil"];
            $conexao = new PDO("mysql:host=127.0.0.1;dbname=fastfood", "root", "");
            if($tipoOperacao == "I"){
               $comandoSQL = $conexao->prepare("INSERT INTO perfil(nome) VALUES ('".$nomePerfil."')");
               print "Perfil " . $nomePerfil . " cadastrado com sucesso!<BR/><BR/>";
               $comandoSQL->execute();
            }else if($tipoOperacao == "A"){
               $comandoSQL = $conexao->prepare("UPDATE perfil ".
                                               "   SET nome   = '".$nomePerfil."'".
                                               " WHERE codigo = " .$codigoPerfil);
               print "Perfil " . $nomePerfil . " atualizado com sucesso!<BR/><BR/>";
               $comandoSQL->execute();
            }else if($tipoOperacao == "E"){
               $comandoSQL = $conexao->prepare("DELETE FROM perfil WHERE codigo = " .$codigoPerfil);
               print "Perfil " . $nomePerfil . " excluído com sucesso!<BR/><BR/>";
               $comandoSQL->execute();
            }
         }
         
         // buscar dados
         $conexao = new PDO("mysql:host=127.0.0.1;dbname=fastfood", "root", "");
         $comandoSQL = $conexao->query("SELECT * FROM perfil");
         print "<TABLE>";
         print "<TR><TD>Código</TD><TD>Nome</TD><TD>Alterar/Excluir</TD></TR>";
         while($linhaBD = $comandoSQL->fetch()){
            print "<TR><TD>".$linhaBD["codigo"]."</TD><TD>".$linhaBD["nome"]."</TD><TD>".
            "<INPUT TYPE='button' VALUE='A/E' ONCLICK='acao()'>".
            "</TD></TR>";
         }
         print "</TABLE>";
      ?>
   </BODY>
</HTML>
<SCRIPT>
   function acao(codigo, nome){
      document.getElementById("codigoPerfil").value = codigo;
      document.getElementById("nomePerfil").value   = nome;
      document.forms[0].submit();
   }
   
   function manter(operacao){
      if(operacao == "A"){
         document.getElementById("tipoOperacao").value = "A";
      }else if(operacao == "E"){
         document.getElementById("tipoOperacao").value = "E";
      }else if(operacao == "I"){
         document.getElementById("tipoOperacao").value = "I";
      }else if(operacao == "L"){
         document.getElementById("tipoOperacao").value = "";
         document.getElementById("codigoPerfil").value = "";
         document.getElementById("nomePerfil").value   = "";
      }
      document.forms[0].submit();
   }
</SCRIPT>