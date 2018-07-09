<?php
class RNH{

	public static function dateFormat($date,$format){		

		return date($format, strtotime(str_replace("/", "-", $date)));		
		
	}#Fim do método dateFormat

	public static function limitString($string,$limit,$concat=''){

	
    $limit  = substr(strip_tags(trim($string)), 0, $limit);
    $string = substr($limit, 0, strrpos($limit, ' ')).$concat;

    	return $string;

	}#Fim do método limitString;



	public static function getExt($name_file){      
      return substr($name_file, strrpos($name_file, '.'), 5);		 
	}#Fim do método getExt



	public static function numberCurrency($valor){

  
		$valor = str_replace('.','',$valor);
		$valor = str_replace(',','.',$valor);
		return $valor;
	}#Fim do método getExt



}# Fim da classe


?>