<?php
class FileManager {
	
	const GALON_FILE_GENERATED          = '/var/www/test/equi-moulinette/data/galons-grand-geneated_file.txt';
	const GALON_CSS_FILE_GENERATED      = '/var/www/test/equi-moulinette/data/galons-grand-css_geneated.txt';
	const GALON_HTML_FILE_GENERATED     = '/var/www/test/equi-moulinette/data/galons-grand-html_generated.txt';
	const GALON_LISTVALS_FILE_GENERATED = '/var/www/test/equi-moulinette/data/galons-grand-listvals-generated.txt';        
	
	const GALON_P_FILE_GENERATED          = '/var/www/test/equi-moulinette/data/galons-petit-geneated_file.txt';
	const GALON_P_CSS_FILE_GENERATED      = '/var/www/test/equi-moulinette/data/galons-petit-css_geneated.txt';
	const GALON_P_HTML_FILE_GENERATED     = '/var/www/test/equi-moulinette/data/galons-petit-html_generated.txt';
	const GALON_P_LISTVALS_FILE_GENERATED = '/var/www/test/equi-moulinette/data/galons-petit-listvals-generated.txt'; 
        
	const BORDURE_FILE_GENERATED          = '/var/www/test/equi-moulinette/data/bordures-geneated_file.txt';
	const BORDURE_CSS_FILE_GENERATED      = '/var/www/test/equi-moulinette/data/bordures-css_geneated.txt';
	const BORDURE_HTML_FILE_GENERATED     = '/var/www/test/equi-moulinette/data/bordures-html_generated.txt';
	const BORDURE_LISTVALS_FILE_GENERATED = '/var/www/test/equi-moulinette/data/bordures-listvals-generated.txt';
        
	const BASEBORDURE_FILE_GENERATED          = '/var/www/test/equi-moulinette/data/basebordures-geneated_file.txt';
	const BASEBORDURE_CSS_FILE_GENERATED      = '/var/www/test/equi-moulinette/data/basebordures-css_geneated.txt';
	const BASEBORDURE_HTML_FILE_GENERATED     = '/var/www/test/equi-moulinette/data/basebordures-html_generated.txt';
	const BASEBORDURE_LISTVALS_FILE_GENERATED = '/var/www/test/equi-moulinette/data/basebordures-listvals-generated.txt'; 
        
	const STRASS_FILE_GENERATED          = '/var/www/test/equi-moulinette/data/strass-geneated_file.txt';
	const STRASS_CSS_FILE_GENERATED      = '/var/www/test/equi-moulinette/data/strass-css_geneated.txt';
	const STRASS_HTML_FILE_GENERATED     = '/var/www/test/equi-moulinette/data/strass-html_generated.txt';
	const STRASS_LISTVALS_FILE_GENERATED = '/var/www/test/equi-moulinette/data/strass-listvals-generated.txt'; 
        
	const GALON_BARIOLE_FILE_GENERATED               = '/var/www/test/equi-moulinette/data/galons-bariole-geneated_file.txt';  
        const GRANDS_GALONS_BARIOLES_HTML_FILE_GENERATED = '/var/www/test/equi-moulinette/data/galons-bariole-html_generated.txt';
	const GRANDS_GALONS_BARIOLES_CSS_FILE_GENERATED  = '/var/www/test/equi-moulinette/data/galons-bariole-css_geneated.txt';
        
	const GALON_BARIOLE_PETIT_FILE_GENERATED         = '/var/www/test/equi-moulinette/data/galons-bariole-petits-geneated_file.txt';  
        const PETITS_GALONS_BARIOLES_HTML_FILE_GENERATED = '/var/www/test/equi-moulinette/data/galons-bariole-petits-html_generated.txt';
	const PETITS_GALONS_BARIOLES_CSS_FILE_GENERATED  = '/var/www/test/equi-moulinette/data/galons-bariole-petits-css_geneated.txt';
        
        
	const COLOR_FILE_GENERATED          = '/var/www/test/equi-moulinette/data/colors-geneated_file.txt';
	const COLOR_CSS_FILE_GENERATED      = '/var/www/test/equi-moulinette/data/colors-css_geneated.txt';
	const COLOR_HTML_FILE_GENERATED     = '/var/www/test/equi-moulinette/data/colors-html_generated.txt';
	const COLOR_LISTVALS_FILE_GENERATED = '/var/www/test/equi-moulinette/data/color-listvals-generated.txt';    
        
	const CONCAT_LISTVALS_FILE_GENERATED    = '/var/www/test/equi-moulinette/data/concat-options-listvals-generated.txt'; 
        const CONCAT_OPTIONS_CSS_FILE_GENERATED = '/var/www/test/equi-moulinette/data/concat-options-css-generated.txt'; 
	
	private $_fileNames   = array();
	private $_fileContent = array();	
	
        public static function emptyCssConcatFile(){
            file_put_contents(self::CONCAT_OPTIONS_CSS_FILE_GENERATED, '');
        }        
	/**
	 * 
	 * @param dir to parse $uri
	 * @return string file names
	 */
	public function getFileNames($uri){
		$this->parseDir($uri);
		natsort($this->_fileNames);
		return $this->_fileNames;
	}
	 
	/**
	 *
	 * @param file to parse $uri
	 * @return string file content
	 */
	public function getFileContent($uri, $itemType=NULL){
		$this->parseFile($uri);
		$this->writeFileNames($itemType);
		return $this->_fileContent;
	}	
	
	/**
	 * Prase dir
	 */
	private function parseDir($uri){
		//init
		$this->_fileNames = array();
		
		$dir = new DirectoryIterator(dirname($uri));
		foreach ($dir as $fileinfo) {
		    if (!$fileinfo->isDot()) {
		        $this->_fileNames[] = $fileinfo->getFilename();
		    }
		}
	}
	
	/**
	 * Prase file
	 */
	private function parseFile($uri){
		if(file_exists($uri)){
		   $this->_fileContent = file($uri);
		}else{
		   throw new Exception("File to parse doesn't exists: " . $uri);
		}
	}
        public function writelListvalFile($content, $name, $flag=false){
            if(!$flag){
                file_put_contents($name, $content);
            }else{
                file_put_contents($name, $content, $flag);
            }
        }
	/**
	 * Write the list of file names in a file
	 */
	private function writeFileNames($itemType=NULL){
		
		//target file
		$fileName = '';
		
		//galon grand
		if('GALON_GRANDS' == $itemType){			
			$fileName = $this::GALON_FILE_GENERATED;			
		//galon petits
		}elseif('GALON_PETITS'== $itemType){			
			$fileName = $this::GALON_P_FILE_GENERATED;
		//bordure exterieure
		}elseif('BORDURE'== $itemType){			
			$fileName = $this::BORDURE_FILE_GENERATED;
		//strass
		}elseif('STRASS'== $itemType){			
			$fileName = $this::STRASS_FILE_GENERATED;		
		//galon bariole
		}elseif('GALONS_BARIOLES'== $itemType){			
			$fileName = $this::GALON_BARIOLE_FILE_GENERATED;	
		//galon bariole petit
		}elseif('GALONS_BARIOLES_PETITS'== $itemType){			
			$fileName = $this::GALON_BARIOLE_PETIT_FILE_GENERATED;	
		//basebordure
		}elseif('BASEBORDURE'== $itemType){			
			$fileName = $this::BASEBORDURE_FILE_GENERATED;
		//colors			
		}elseif('COLOR'== $itemType){			
			$fileName = $this::COLOR_FILE_GENERATED;			
		}
		
		//empty the file
		file_put_contents($fileName , '');
		
		//fill the file
		foreach($this->_fileNames AS $value){
			$value .= "\n";
			file_put_contents($fileName , $value, FILE_APPEND);
		}
	}
	
	/**
	 * Write the HTML file
	 */
	public function writeHtmlFile($content, $itemType=NULL, $concatenate_options=false){
		
		//target file
		$target_file          = '';
		static $cleanse_count = 1;
                
		//galon grand
		if('GALON_GRANDS' == $itemType){				
			$fileName = $this::GALON_HTML_FILE_GENERATED;				
		//galon petit
		}elseif('GALON_PETITS'== $itemType){			
			$fileName = $this::GALON_P_HTML_FILE_GENERATED;
		//bordure exterieure
		}elseif('BORDURE'== $itemType){				
			$fileName = $this::BORDURE_HTML_FILE_GENERATED;
		//strass		
		}elseif('STRASS'== $itemType){				
			$fileName = $this::STRASS_HTML_FILE_GENERATED;			
		//grand galon barioles
		}elseif('GRANDS_GALONS_BARIOLES'== $itemType){				
			$fileName = $this::GRANDS_GALONS_BARIOLES_HTML_FILE_GENERATED;			
		//petit galon bariole
		}elseif('PETITS_GALONS_BARIOLES'== $itemType){				
			$fileName = $this::PETITS_GALONS_BARIOLES_HTML_FILE_GENERATED;			
		//basebordure
		}elseif('BASEBORDURE'== $itemType){				
			$fileName = $this::BASEBORDURE_HTML_FILE_GENERATED;		
		//color		
		}elseif('COLOR'== $itemType){		
			$fileName = $this::COLOR_HTML_FILE_GENERATED;				
		}
		echo $fileName .'<br />';
		//empty the file
		file_put_contents($fileName, $content);
                
                //concatenate options
                if($concatenate_options){ 
                   file_put_contents(FileManagerCalcul::CONCAT_HTML_OPTIONS_FILE , $content, FILE_APPEND); 
                }                
	}	
	
	/**
	 * Write the CSS file
	 */
	public function writeCssFile($content, $itemType, $concatenate=false){

		//prefix
		$targetFile ='';
		
		//bordure
		if('BORDURE' == $itemType){
			$targetFile = self::BORDURE_CSS_FILE_GENERATED;
		//galon
		}elseif('GALON_GRANDS' == $itemType){
			$targetFile = self::GALON_CSS_FILE_GENERATED;
		//galon petit
		}elseif('GALON_PETITS'== $itemType){			
			$targetFile = $this::GALON_P_CSS_FILE_GENERATED;
		//strass
		}elseif('STRASS' == $itemType){
			$targetFile = self::STRASS_CSS_FILE_GENERATED;
		//grands galons barioles
		}elseif('GRANDS_GALONS_BARIOLES' == $itemType){
			$targetFile = self::GRANDS_GALONS_BARIOLES_CSS_FILE_GENERATED;
		//petits galons barioles
		}elseif('PETITS_GALONS_BARIOLES' == $itemType){
			$targetFile = self::PETITS_GALONS_BARIOLES_CSS_FILE_GENERATED;
		//basebordure
		}elseif('BASEBORDURE' == $itemType){
			$targetFile = self::BASEBORDURE_CSS_FILE_GENERATED;
		//color
		}elseif('COLOR' == $itemType){
			$targetFile = self::COLOR_CSS_FILE_GENERATED;
		}
		
		//empty the file
		file_put_contents($targetFile , $content);
                
                //concat options css
                if(true ==  $concatenate){
                   file_put_contents(self::CONCAT_OPTIONS_CSS_FILE_GENERATED , $content, FILE_APPEND);                       
                }
	}
	
}












