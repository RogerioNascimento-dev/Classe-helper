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

