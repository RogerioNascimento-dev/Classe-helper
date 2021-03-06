<?php
/*															*/
# Autor: 			Rogério de Oliveira Nascimento       	#
# E-mail: 			rogerionascimento.dev@outlook.com.br 	#
# Data:				05/07/2018                           	#
# Versão do php:	7.1.3                                	#
/*															*/
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
	        $return['filename']  = $filename;
	        
	      
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
		$return_files = array();
		$return = array();
		$return['not_acepted'] = array();
		// diretório de destino do arquivo
		$pasta    = "../uploads/"; //nome da pasta que ira salvar os arquivos
		if(!file_exists($pasta)){mkdir($pasta, 0755);}//se a pasta não existiir cria a pasta

		$pasta  = $pasta.$type_file.'/';
	      
	    if(!file_exists($pasta)){mkdir($pasta, 0755);}

 	      
    // cria uma variável para facilitar
    $arquivos = $file['arquivos'];
 
    // total de arquivos enviados
    $total = count($arquivos['name']);
 
    for ($i = 0; $i < $total; $i++)
    {
    	$extencao   = self::getExt($arquivos['name'][$i]);//pega a extenção do arquivo
	    $filename   = md5(time().$i).$extencao;//nome unico para o arquivo, exitar conflito

	if(in_array($extencao, $files_accept)){
         
        if (!move_uploaded_file($arquivos['tmp_name'][$i], $pasta . '/' . $filename))
        {
            $return['error_number']   	= 1;
	        $return['error_detail']  	= "Não foi possível realizar esta operação";
        }else{
        	$return_files[] = $filename;
        }
    }else{
    	    
	        $return['not_acepted'][] = $arquivos['name'][$i];
    }
   
}
 
    		$return['error_number']   	= 0;
	        $return['error_detail']  	= "Sucesso!";
	        $return['filenames']  		= $return_files;
	
		return $return;


	}#fim do método de upload de arquivos mutiplos


	public static function session($session_name,$getOrSet,$value = ''){
		$session_name = 'cap_'.$session_name;
		@session_start();

		switch ($getOrSet) {
			case 'set':
			{
				$_SESSION[$session_name] = $value;
				$return = true;
			}break;

			case 'get':
			{
				if(isset($_SESSION[$session_name])):
					$return = $_SESSION[$session_name];
				else:
					$return = false;
				endif;	

			}break;			
			
		}

		return $return;
			
	}


public static function crypt($key,$value,$opt){
    if($opt == 'crypt'){
        $value = base64_encode($key.$value.$key);
    }else if($opt == 'decrypt'){
        $value = base64_decode($value);
        $value = str_replace($key, "", $value);
    }

    return $value;
}


public static function safeString($string) {

    // matriz de entrada
    $what = array( 'ä','ã','à','á','â','ê','ë','è','é','ï','ì','í','ö','õ','ò','ó','ô','ü','ù','ú','û','À','Á','É','Í','Ó','Ú','ñ','Ñ','ç','Ç',' ','-','(',')',',',';',':','|','!','"','#','$','%','&','/','=','?','~','^','>','<','ª','º' );

    // matriz de saída
    $by   = array( 'a','a','a','a','a','e','e','e','e','i','i','i','o','o','o','o','o','u','u','u','u','A','A','E','I','O','U','n','n','c','C','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_' );

    // devolver a string
    return str_replace($what, $by, $string);
}




//===============|Métodos de Url amigável|=====================

private static $url = null;
    private static $baseUrl = null;
 
    public static function getBaseUrl()
    {
        if( self::$baseUrl != null )
            return self::$baseUrl;
 
        global $_SERVER;
        $startUrl = strlen( $_SERVER["DOCUMENT_ROOT"] );
        $excludeUrl = substr( $_SERVER["SCRIPT_FILENAME"], $startUrl, -9 );
        if( $excludeUrl[0] == "/" )
            self::$baseUrl = $excludeUrl;
        else
            self::$baseUrl = "/" . $excludeUrl;
        return self::$baseUrl;
    }
 
    public static function getVarUrl( $id )
    {
        // Verifica se a lista de URL já foi preenchida
        if( self::$url == null )
            self::getURLList();
         
        // Valida se existe o ID informado e retorna.
        if( isset( self::$url[ $id ] ) )
            return self::$url[ $id ];
         
        // Caso não exista o ID, retorna nulo
        return null;
    }
     
    private static function getURLList()
    {
        global $_SERVER;
         
        // Primeiro traz todos as pastas abaixo do index.php
        $startUrl = strlen( $_SERVER["DOCUMENT_ROOT"] ) -1;
        $excludeUrl = substr( $_SERVER["SCRIPT_FILENAME"], $startUrl, -10 );
         
        // a variável$request possui toda a string da URL após o domínio.
        $request = $_SERVER['REQUEST_URI'];
         
        // Agora retira toda as pastas abaixo da pasta raiz
        $request = substr( $request, strlen( $excludeUrl ) );
         
        // Explode a URL para pegar retirar tudo após o ?
        $urlTmp = explode("?", $request);
        $request = $urlTmp[ 0 ];
         
        // Explo a URL para pegar cada uma das partes da URL
        $urlExplodida = explode("/", $request);
         
        $retorna = array();
 
        for($a = 0; $a <= count($urlExplodida); $a ++)
        {
            if(isset($urlExplodida[$a]) AND $urlExplodida[$a] != "")
            {
                array_push($retorna, $urlExplodida[$a]);
            }
        }
        self::$url = $retorna;
    }

}# Fim da classe


?>