<?php
class FileManagerCalcul {
	
	const GALON_FILE_GENERATED          = '/var/www/test/equi-moulinette/data/galons-grand-geneated_file.txt';
	const GALON_CSS_FILE_GENERATED      = '/var/www/test/equi-moulinette/data/galons-grand-css_geneated.txt';
	const GALON_HTML_FILE_GENERATED     = '/var/www/test/equi-moulinette/data/galons-grand-html_generated.txt';
	const GALON_LISTVALS_FILE_GENERATED = '/var/www/test/equi-moulinette/data/galons-grand-listvals-generated.txt';        
	//calcul
	const GALON_C_FILE_GENERATED          = '/var/www/test/equi-moulinette/data/galons-grand-calcul_geneated_file.txt';
	const GALON_C_CSS_FILE_GENERATED      = '/var/www/test/equi-moulinette/data/galons-grand-css-calcul_geneated.txt';
	const GALON_C_HTML_FILE_GENERATED     = '/var/www/test/equi-moulinette/data/galons-grand-html-calcul_generated.txt';
	const GALON_C_LISTVALS_FILE_GENERATED = '/var/www/test/equi-moulinette/data/galons-grand-listvals-calcul-generated.txt';  
        
	const GALON_P_FILE_GENERATED          = '/var/www/test/equi-moulinette/data/galons-petit-geneated_file.txt';
	const GALON_P_CSS_FILE_GENERATED      = '/var/www/test/equi-moulinette/data/galons-petit-css_geneated.txt';
	const GALON_P_HTML_FILE_GENERATED     = '/var/www/test/equi-moulinette/data/galons-petit-html_generated.txt';
	const GALON_P_LISTVALS_FILE_GENERATED = '/var/www/test/equi-moulinette/data/galons-petit-listvals-generated.txt'; 
        //calcul
	const GALON_PC_FILE_GENERATED          = '/var/www/test/equi-moulinette/data/galons-petit-calcul-geneated_file.txt';
	const GALON_PC_CSS_FILE_GENERATED      = '/var/www/test/equi-moulinette/data/galons-petit-css-calcul_geneated.txt';
	const GALON_PC_HTML_FILE_GENERATED     = '/var/www/test/equi-moulinette/data/galons-petit-html-calcul_generated.txt';
	const GALON_PC_LISTVALS_FILE_GENERATED = '/var/www/test/equi-moulinette/data/galons-petit-listvals-calcul-generated.txt'; 
        
	const BORDURE_FILE_GENERATED      = '/var/www/test/equi-moulinette/data/bordures-geneated_file.txt';
	const BORDURE_CSS_FILE_GENERATED  = '/var/www/test/equi-moulinette/data/bordures-css_geneated.txt';
	const BORDURE_HTML_FILE_GENERATED = '/var/www/test/equi-moulinette/data/bordures-html_generated.txt';
	const BORDURE_LISTVALS_FILE_GENERATED = '/var/www/test/equi-moulinette/data/bordures-listvals-generated.txt';
        //calcul
	const BORDURE_RAJ_C_FILE_GENERATED      = '/var/www/test/equi-moulinette/data/bordures-raj-calcul-geneated_file.txt';
	const BORDURE_RAJ_C_CSS_FILE_GENERATED  = '/var/www/test/equi-moulinette/data/bordures-raj-calcul-css_geneated.txt';
	const BORDURE_RAJ_C_HTML_FILE_GENERATED = '/var/www/test/equi-moulinette/data/bordures-raj-calcul-html_generated.txt';
	const BORDURE_RAJ_C_LISTVALS_FILE_GENERATED = '/var/www/test/equi-moulinette/data/bordures-raj-listvals-calcul-generated.txt'; 
        
       //calcul
	//const BORDURE_DEC_C_FILE_GENERATED      = '/var/www/test/equi-moulinette/data/bordures-dec-calcul-geneated_file.txt';
	const BORDURE_DEC_C_CSS_FILE_GENERATED  = '/var/www/test/equi-moulinette/data/bordures-dec-calcul-css_geneated.txt';
	const BORDURE_DEC_C_HTML_FILE_GENERATED = '/var/www/test/equi-moulinette/data/bordures-dec-calcul-html_generated.txt';
	const BORDURE_DEC_C_LISTVALS_FILE_GENERATED = '/var/www/test/equi-moulinette/data/bordures-dec-listvals-calcul-generated.txt'; 
        
	const BASEBORDURE_FILE_GENERATED      = '/var/www/test/equi-moulinette/data/basebordures-geneated_file.txt';
	const BASEBORDURE_CSS_FILE_GENERATED  = '/var/www/test/equi-moulinette/data/basebordures-css_geneated.txt';
	const BASEBORDURE_HTML_FILE_GENERATED = '/var/www/test/equi-moulinette/data/basebordures-html_generated.txt';
	const BASEBORDURE_LISTVALS_FILE_GENERATED = '/var/www/test/equi-moulinette/data/basebordures-listvals-generated.txt'; 
        //calcul
	const BASEBORDURE_C_FILE_GENERATED      = '/var/www/test/equi-moulinette/data/basebordures-calcul-geneated_file.txt';
	const BASEBORDURE_C_CSS_FILE_GENERATED  = '/var/www/test/equi-moulinette/data/basebordures-calcul-css_geneated.txt';
	const BASEBORDURE_C_HTML_FILE_GENERATED = '/var/www/test/equi-moulinette/data/basebordures-calcul-html_generated.txt';
	const BASEBORDURE_C_LISTVALS_FILE_GENERATED = '/var/www/test/equi-moulinette/data/basebordures-listvals-calcul-generated.txt'; 
        
	const STRASS_FILE_GENERATED      = '/var/www/test/equi-moulinette/data/strass-geneated_file.txt';
	const STRASS_CSS_FILE_GENERATED  = '/var/www/test/equi-moulinette/data/strass-css_geneated.txt';
	const STRASS_HTML_FILE_GENERATED = '/var/www/test/equi-moulinette/data/strass-html_generated.txt';
	const STRASS_LISTVALS_FILE_GENERATED = '/var/www/test/equi-moulinette/data/strass-listvals-generated.txt'; 
        
	const COLOR_FILE_GENERATED      = '/var/www/test/equi-moulinette/data/colors-geneated_file.txt';
	const COLOR_CSS_FILE_GENERATED  = '/var/www/test/equi-moulinette/data/colors-css_geneated.txt';
	const COLOR_HTML_FILE_GENERATED = '/var/www/test/equi-moulinette/data/colors-html_generated.txt';
	const COLOR_LISTVALS_FILE_GENERATED = '/var/www/test/equi-moulinette/data/color-listvals-generated.txt';    
        
	const CONCAT_LISTVALS_FILE_GENERATED = '/var/www/test/equi-moulinette/data/concat-options-listvals-generated.txt'; 
	const CONCAT_BORDS_EXT_LISTVALS_FILE_GENERATED = 
                                               '/var/www/test/equi-moulinette/data/concat-free-bords-listvals-generated.txt'; 
        
	const CONCAT_HTML_OPTIONS_FILE          = '/var/www/test/equi-moulinette/data/concat-options-html-generated.txt';        
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
                //to cleanse at first the html options file
		static $cleanse_count = 0;
		//target file
		$target_file = ''; //  GALON_GRANDS_CALCULES
		
		//galon grand
		if('GALON_GRANDS' == $itemType){				
			$fileName = $this::GALON_HTML_FILE_GENERATED;				
		//galon grand calcule
		}elseif('GALON_GRANDS_CALCULES'== $itemType){			
			$fileName = $this::GALON_C_HTML_FILE_GENERATED;
		//galon petit calcule
		}elseif('GALON_PETITS_CALCULES'== $itemType){			
			$fileName = $this::GALON_PC_HTML_FILE_GENERATED;
		//bordure exterieure
		}elseif('GALON_PETITS'== $itemType){			
			$fileName = $this::GALON_P_HTML_FILE_GENERATED;
		//bordure exterieure calculee
		}elseif('BORD_GRAND_CALCULES'== $itemType){				
			$fileName = $this::BASEBORDURE_C_HTML_FILE_GENERATED;
		//bordure rajoutee calculee		
		}elseif('BORDURE_RAJOUTE_CALCULE'== $itemType){				
			$fileName = $this::BORDURE_RAJ_C_HTML_FILE_GENERATED;
		//bordure decalee calculee		
		}elseif('BORDURE_DECALE_CALCULE'== $itemType){				
			$fileName = $this::BORDURE_DEC_C_HTML_FILE_GENERATED;
		//strass		
		}elseif('BORDURE'== $itemType){				
			$fileName = $this::BORDURE_HTML_FILE_GENERATED;
		//strass		
		}elseif('STRASS'== $itemType){				
			$fileName = $this::STRASS_HTML_FILE_GENERATED;			
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
                    
                    //flag to append or not
                    $append_file = '';                            
                    //cleanse the file at first
                    if( 0 == $cleanse_count++ ){
                        file_put_contents($this::CONCAT_HTML_OPTIONS_FILE , $content); 
                    }else{
                        file_put_contents($this::CONCAT_HTML_OPTIONS_FILE , $content, FILE_APPEND); 
                    }
                }
	}	
	
	/**
	 * Write the CSS file
	 */
	public function writeCssFile($content, $itemType, $concatenate=false){

                //flag to empty at first the css concatenate file
                static $cleanse_css_concat = 0;            
		//prefix
		$targetFile ='';
		
		//bordure
		if('BORDURE' == $itemType){
			$targetFile = self::BORDURE_CSS_FILE_GENERATED;
		//galon
		}elseif('GALON_GRANDS' == $itemType){
			$targetFile = self::GALON_CSS_FILE_GENERATED;
		//galon grand calcule
		}elseif('GALON_GRANDS_CALCULES' == $itemType){
			$targetFile = self::GALON_C_CSS_FILE_GENERATED;
		//galon petit calcule
		}elseif('GALON_PETITS_CALCULES' == $itemType){
			$targetFile = self::GALON_PC_CSS_FILE_GENERATED;
		//galon petit
		}elseif('GALON_PETITS'== $itemType){			
			$targetFile = $this::GALON_P_CSS_FILE_GENERATED;
		//strass
		}elseif('STRASS' == $itemType){
			$targetFile = self::STRASS_CSS_FILE_GENERATED;
		//basebordure calcule
		}elseif('BORD_GRAND_CALCULES' == $itemType){
			$targetFile = self::BASEBORDURE_C_CSS_FILE_GENERATED;
		//bord raj calc 
		}elseif('BORDURE_RAJOUTE_CALCULE' == $itemType){
			$targetFile = self::BORDURE_RAJ_C_CSS_FILE_GENERATED;
		//bord dec calc
		}elseif('BORDURE_DECALEE_CALCULE' == $itemType){
			$targetFile = self::BORDURE_DEC_C_CSS_FILE_GENERATED;
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












