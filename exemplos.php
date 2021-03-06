<?php
if(isset($_POST['exec'])){
  $resp = array();
  $resp['post'] = $_POST;
  $resp['files'] = $_FILES;

  exit(json_encode($resp));
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
  	<div class="container">
    <h1>Hello, world!</h1>



<?php
#Importação da classe
require "rnh.class.php";

#--|Utilização do método dateFormat|--#
echo RNH::dateFormat(date('2018-07-10 21:30:20'),'d/m/Y h:i');

/*
Observações:
O primeiro parametro é a data em que deseja formatar e o segundo é o formato desejado
*/

echo '<br>';


#--|Utilização do método limitString|--#
$string = 'Este é um exemplo de como a função de limitar string funciona sem cortar a palavra ao meio pois ela identifica a ultima ocorrencia de espaço dentro do limite passado.';
echo RNH::limitString($string,70,'...');
/*
Observações:
1 - O primeiro parametro é a string em que deseja reduzir e o segundo é a quantidade de caracteres e o terceiro é o indicador que a frase continua, caso não queira usar não passe o ultimo parametro.
2 - A função reduz a string ao tamanho desejado sem cortar a palavra no meio. 
*/


echo '<br>';

#--|Utilização do método getExt|--#
$file_name = 'imagem-de-um-dia-feliz.jpg';
echo RNH::getExt($file_name);
/*
Observações:
1 - Recebe como parametro o nome de um arquivo e retorna somente a extenção
*/

echo '<br>';

#--|Utilização do método numberCurrency|--#

echo RNH::numberCurrency('1.500,35');
/*
Observações:
1 - Recebe como parametro um numero em formato de moeda br e converte para formato de banco
*/

echo '<br>';
?>

<form action="" method="post" enctype="multipart/form-data" name="myform" id="myform">
	<input type="file" multiple="multiple" name="arquivos" id="arquivos"/>
	<input type="hidden" name="exec" id="exec" value="teste_ajax" />
  <input type="text" name="name" id="name" value="" />
  <input type="text" name="email" id="email" value="" />
  <input type="text" name="phone" id="phone" value="" />
	<button class="btn btn-default" type="button" onclick="send_form()">Enviar</button>
</form>

<?php 
/*
#Chamando método de upload simples
if(isset($_FILES['arquivos'])):		
	$ret = RNH::uploadFile($_FILES['arquivos'],array('.jpg','.jpeg'),'bola');
	print_r($ret);
endif;
*/

/*
#Chamando método de upload multiplo
if(isset($_FILES['arquivos'])):   
  $ret = RNH::uploadFiles($_FILES,array('.jpg','.jpeg'),'imagem');
  echo '<pre>';
  print_r($ret);
endif;
*/

RNH::session('eu', 'set','Programador');
echo RNH::session('eu', 'get');
?>

<div class="container-fluid">
  <p>Conteudo aqui abaixo</p>
</div>



</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

<script src="../../cap/js/jquery.min.js"></script>
<script src="../../cap/js/jquery.form.js"></script>



    <script>
function send_form(){
var form = $('#myform');

    var params = 'execs=test&rogerio=eu&'+form.serialize();
    
    $.ajax({
    url:        '',
    data:       params,
    type:       'post',
    dataType:   'json',

    error:      function(){alert('Erro ao acessar a pagina desejada'); },
    beforeSend:   function(){
           
      console.log('aguarde..');
    },//fim do beforeSend
    
    success:    function(resposta){
             
     console.log(resposta);
      
     
    },//fim do sucesso

    complete:       function(){
        console.log('Completei');
    } // fim do complete    
  });//fim do ajax
    

}
</script>

  </body>
</html>