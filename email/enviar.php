<?php
session_start();

// Função para formatar o código
function form_cod($mascara, $value){
    return vsprintf($mascara, str_split($value));  
}
// Mascara do Cógigo
function cod($value){
    $cod = "%s%s%s-%s%s%s";
    $cod_form = form_cod($cod, $value);
    return $cod_form;
}
function to_numero($value){
    $num = "%/%d%d%/%d%d%d%d%d%/%d%d%d%d";
    $num_form = form_cod($num, $value);
    return $num_form;
}
function telefone($value){
    $tel = "(%d%d)%d%d%d%d%d-%d%d%d%d" ;
    $tel_form = form_cod($tel, $value);
    return $tel_form;
}





// Dados do usuário
$emailenviar  = $_POST['email'];
$nome         = $_POST['nome'];
$telefone     = $_POST['telefone'];
$mensagem      = $_POST['mensagem'];



// Emails para quem será enviado o formulário

$destino     = $emailenviar;
$assunto     = " Você possui uma nova mensagem de : | $nome";
$data_envio  = date('d/m/Y');
$hora_envio  = date('H:i');


// É necessário indicar que o formato do e-mail é html
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "From:  ".$nome." <".$emailenviar.">";
//$headers .= "Bcc: $EmailPadrao\r\n";

// Estilização do Campo do Email
// Compo E-mail
$arquivo = "
<style type='text/css'>
body {
margin:0px;
font-family:Verdane;
font-size:12px;
color: #666666;
}
a{
color: #666666;
text-decoration: none;
}
a:hover {
color: #FF0000;
text-decoration: none;
}
</style>
  <html>
      <table class= 'table' width='510' border='1' cellpadding='1' cellspacing='1'>
        <tr>
            <tr>
               <td width='500'>Nome:$nome</td>
            </tr>
            <tr>
                <td width='320'>E-mail:<b>$emailenviar</b></td>
            </tr>
            <tr>
                <td width='320'>Opções: [escolha] </td>
            </tr>
            <tr>
                <td width='320'>
                
                Mensagem: $mensagem 


                </td>
            </tr>
          </td>
        </tr>
        <tr>
          <td>Este e-mail foi enviado em <b>$data_envio</b> às <b>$hora_envio</b></td>
        </tr>
      </table>
  </html>";

$enviaremail = mail($destino, $assunto, $arquivo, $headers);
if($enviaremail)
{
    $mgm = "E-MAIL ENVIADO COM SUCESSO! <br> O link será enviado para o e-mail fornecido no formulário";
    echo    ($mgm);
} 
else {}
?>