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


	public static function uploadFile($file,$files_accept,$type_file){

		$return = array();

	  	$pasta    = "../uploads/"; //nome da pasta que ira salvar os arquivos
	  	if(!file_exists($pasta)){mkdir($pasta, 0755);}//se a pasta não existiir cria a pasta

	  	if($file['tmp_name']){

	    $extencao   = self::getExt($file['name']);//pega a extenção do arquivo
	    $filename   = md5(time()).$extencao;//nome unico para o arquivo, exitar conflito

	    if(in_array($extencao, $files_accept)){

	    	$pasta  = $pasta.$type_file.'/';
	      
	    if(!file_exists($pasta)){mkdir($pasta, 0755);}

	    if(move_uploaded_file($file['tmp_name'], $pasta.$filename)){
	        
	        
	        $return['error_number']   = 0;
	        $return['error_detail']  = "Sucesso!";
	        
	      
	    }else{
	        
	        
	        $return['error_number']   = 1;
	        $return['error_detail']  = "Não foi possível realizar esta operação";
	        
	        
	    }//fim da area que move o arquivo


	    }else{      

	        
	        $return['error_number']   	= 1;
	        $return['error_detail']  	= "O arquivo selecionado não é aceito";       
	       
	    }


	  	}else{

	        $return['error_number']   = 1;
	    	$return['error_detail']  = "Nenhum arquivo selecionado";   
	    
		}


		return $return;
	}#fim do método de upload de arquivos



	public static function uploadFiles($file,$files_accept,$type_file){
		$total_files = count($file['name']);
		
		for($x=0;$x<$total_files;$x++){
			

		$pasta    = "../uploads/"; //nome da pasta que ira salvar os arquivos
	  	if(!file_exists($pasta)){mkdir($pasta, 0755);}//se a pasta não existiir cria a pasta

	  

	    $extencao   = self::getExt($file['name'][$x]);//pega a extenção do arquivo
	    $filename   = md5(time()).$extencao;//nome unico para o arquivo, exitar conflito

	    if(in_array($extencao, $files_accept)){

	    	$pasta  = $pasta.$type_file.'/';
	      
	    if(!file_exists($pasta)){mkdir($pasta, 0755);}

	    if(move_uploaded_file($file['tmp_name'][$x], $pasta.$filename)){
	        
	        
	        $return['error_number']   = 0;
	        $return['error_detail']  = "Sucesso!";
	        
	      
	    }else{
	        
	        
	        $return['error_number']   = 1;
	        $return['error_detail']  = "Não foi possível realizar esta operação";
	        
	        
	    }//fim da area que move o arquivo


	    }else{      

	        
	        $return['error_number']   	= 1;
	        $return['error_detail']  	= "O arquivo selecionado não é aceito";       
	       
	    }


		}#EndFor

		return $return;

	}#fim do método de upload de arquivos mutiplos


}# Fim da classe


?>