<?php
//string manipulation tool class
include_once 'string_tool.php';

class ItemsManager {
	
	//galon
	const GALLON              = 'g_';
	const URL_IMAGES_GALONS  = '../../../../../misc/images/options/struct_colors_customized/5_galons/';
	
	//bordure
	const BORDURE             = 'br_';
	const URL_IMAGES_BORDURES = '../../../../../misc/images/options/struct_colors_customized/3_bord_interieur/';

	//basebordure 
	const BASEBORDURE         = 'base_br_';
	const URL_IMAGES_BASEBORDURE = '../../../../../misc/images/options/struct_colors_customized/2_bordure/';
	
	//strass
	const STRASS              = 'st_';
	const URL_IMAGES_STRASS   = '../../../../../misc/images/options/struct_colors_customized/4_strass/';
	
	const GRANDS_GALONS_BARIOLES = 'ggb_';  
	const URL_IMAGES_GRANDS_GALONS_BARIOLES   = '../../../../../misc/images/options/struct_colors_customized/5_grands_galons_barioles/';
        
        //PETITS_GALONS_BARIOLES
	const PETITS_GALONS_BARIOLES = 'pgb_';  
	const URL_IMAGES_PETITS_GALONS_BARIOLES   = '../../../../../misc/images/options/struct_colors_customized/5_petits_galons_barioles/';
                
	//colors
	const COLOR               = 'col_';
	const URL_IMAGES_COLOR    = '../../../../../misc/images/options/struct_colors_customized/1_couleur_de_base/';
	
	public $htmlList = NULL;
        
	/**
	 * Build the html 
	 * 
	 * <div>
	 * 	  <div class="divColor">
         *    <span class="divColorImgGallons g_blanc" ></span>
         *    <span class="menu" >1-Blanc</span>
         * </div>
         *  
	 * @param pictures $files
	 * @param pictures $labels
	 */
	public function buildHtmlListElement($files, $labels, $itemType=NULL, $salt=''){
            
                global $trans;
                
		//prefix
		$prefix     = '';
		$title      = '';
		$css_color  = '';
                $css_border = '';
		//hide/show box title
		$html_exclude_box_title  = false;
		
		//bordure interieure
		if('BORDURE' == $itemType){
			$prefix = $this::BORDURE;
			$title  = 'Bordures / Rand';
		//galon	
		}elseif('GALON_GRANDS' == $itemType){
			$prefix = $this::GALLON;
			$title  = 'Grands galons / Groote toegevoegde vlecht';
		//strass
		}elseif('GALON_PETITS' == $itemType){
			$prefix = $this::GALLON;
			$title  = 'Petits galons / Kleine toegevoegde vlecht';
		//strass
		}elseif('STRASS' == $itemType){
			$prefix = $this::STRASS;
			$title  = 'Strass';
			$css_color  = 'Bases';
                        $css_border = 'ColorBorders';                        
		//grand galon barioles
		}elseif('GRANDS_GALONS_BARIOLES' == $itemType){
			$prefix = $this::GRANDS_GALONS_BARIOLES;
                        $val    = $trans->translate('grand_galons_barioles', 'both'); 
			$title  = $val; //'Grands galons multicolors';
			$css_color  = 'Bases';
                        $css_border = 'ColorBorders';                        
		//petit galon bariole
		}elseif('PETITS_GALONS_BARIOLES' == $itemType){
			$prefix     = $this::PETITS_GALONS_BARIOLES;
			$val        = $trans->translate('petit_galons_barioles', 'both');
                        $title      = $val; //$trans->translate('petit_galons_barioles', 'both'); 
			$css_color  = 'Bases';
                        $css_border = 'ColorBorders';                        
		//basebordure
		}elseif('BASEBORDURE' == $itemType){
			$html_exclude_box_title = false;
			$prefix = $this::BASEBORDURE;
			$title  = 'Bordures aux choix / Ofwel Rand';
                        $css_border = 'ColorBorders';
		//couleur
		}elseif('COLOR' == $itemType){
			$html_exclude_box_title = true;
			$prefix     = $this::COLOR;
			$title      = 'Couleurs';
			$css_color  = 'Bases';
                        $css_border = 'ColorBorders';
		}
		
		//css class name
		$className ='';
		//html result
		$tmp = '';
		//counter
		$counter  = 1;
		$tmp_pre  ='';
		$tmp_post ='';
                /*
					<div class="divBigProduct">		
			   <div style="display:block;" >				 	   
			      <div class="PersoOptionColorGallonsBases">
						
			         <div class="divColor">
                                    <span class="divColorImgGallons col_blanc" ></span>
                                    <span class="menu" >1-Blanc/Wit</span>
                                 </div>   
                 
                 */
		foreach($labels as $line){
			
			//css class name
			$className   = $line;
			$className   = StringTool::getCssClassName($className, $salt);
			$className   = StringTool::remove_accents($className);
			$className   = $prefix . $className;
			//html label
			$label   = $line;
			$label   = StringTool::getHtmlLabel($label);
			
			$tmp .= <<<TAG
			
			  <div class="divColor">
		         <span class="divColorImgGallons{$css_color} {$className}" ></span>
		         <span class="menu" >{$counter} / {$label}</span>
		      </div> 
		
TAG;
			$counter++;
		}
		
		//exclude box title
		if(true == $html_exclude_box_title){
			
		   $tmp_pre .= <<<TAG
		
			<div class="divBigProduct {$css_border}">		
			   <div style="display:block;" >				 	   
			      <div class="PersoOptionColorGallons">
			
TAG;
		}else{
			$tmp_pre .= <<<TAG
			
			<div class="divBigProduct {$css_border}">
			   <div style="display:block;" >
			      <div class="PersoOptionTitle"><b>{$title}</b></div>
			      <div class="PersoOptionColorGallons"> 
			
TAG;
	
		}
		
		$tmp_post .= <<<TAG
		
		      </div>
		   </div>
		</div>
                <div class='clearboth'> </div>
		
TAG;
		return $tmp_pre . $tmp . $tmp_post;
	}
	/**
	 * Build the css
	 * 
         * .g_blanc {
         *    background-image:url('../../../../../misc/images/options/
         *       struct_colors_customized/5_galons/1-blanc_284x20.jpg');
         * }
         * 
	 * @param pictures $files
	 * @param pictures $labels
	 */
	
	public function buildCssListElement($files, $labels, $itemType=NULL, $salt){
	    
		//prefix
		$prefix = '';
		//url images
		$url    = '';
		
		//bordure interieure
		if('BORDURE' == $itemType){
			$prefix = $this::BORDURE;
			$url    = $this::URL_IMAGES_BORDURES;
		//galon grands
		}elseif('GALON_GRANDS' == $itemType){ // grands et petits
			$prefix = $this::GALLON;
			$url    = $this::URL_IMAGES_GALONS;
		//galon petit
		}elseif('GALON_PETITS' == $itemType){ // grands et petits
			$prefix = $this::GALLON;
			$url    = $this::URL_IMAGES_GALONS;
		//strass
		}elseif('STRASS' == $itemType){
			$prefix = $this::STRASS;
			$url    = $this::URL_IMAGES_STRASS;
		//grands galons barioles
		}elseif('GRANDS_GALONS_BARIOLES' == $itemType){
			$prefix = $this::GRANDS_GALONS_BARIOLES;
			$url    = $this::URL_IMAGES_GRANDS_GALONS_BARIOLES;
		//petit galons barioles
		}elseif('PETITS_GALONS_BARIOLES' == $itemType){
			$prefix = $this::PETITS_GALONS_BARIOLES;
			$url    = $this::URL_IMAGES_PETITS_GALONS_BARIOLES;
		//basebordure
		}elseif('BASEBORDURE' == $itemType){
			$prefix = $this::BASEBORDURE;
			$url    = $this::URL_IMAGES_BASEBORDURE;
		//couleurs
		}elseif('COLOR' == $itemType){
			$prefix = $this::COLOR;
			$url    = $this::URL_IMAGES_COLOR;
			
		}
            //var_dump($files);		
	    //modify the keys
	    $new_files = array();	   
	    foreach($files as $key=>$val){
	    	$new_files[] = $val;
	    }	    
	    //rename with the older
	    $files = $new_files;
            //var_dump($labels);	
	    
	    //echo '<pre>';
	    //print_r($files); 
	    //print_r($labels); //die();
	    	    
		//css class name
		$className ='';
		//html result
		$tmp = '';
	
		foreach($labels as $key => $line){			
			//a trick
			$key_tmp = $key;
				
			//css class name
			$className   = $line;
                        
			$className   = StringTool::getCssClassName($className, $salt);
                        //var_dump('class name: ' . $className);
	 		$className   = StringTool::remove_accents($className);
			$className   = $prefix . $className;
			$color_code  = '';
			
			//image file name label
			$image   = $files[$key_tmp];
			//$image   = StringTool::getImageFileName($image);
				
			//no images neede, just color code
			if('COLOR' == $itemType){
				
				$color_code  = StringTool::getColorCode($line);
				
				$tmp .= <<<TAG

.{$className} {
	background-color: {$color_code} ;
}

TAG;
			}else{
				
				$tmp .= <<<TAG
.{$className} {
	 background-image:url('{$url}{$image}');
}
TAG;
			}
		}
		return $tmp;
	}
        public function listValBuilder($vals, $itemType=''){
            
		//bordure interieure
		if('BORDURE' == $itemType){
			return $this->listVals($vals);
		//galon grands
		}elseif('GALON_GRANDS' == $itemType){ // grands et petits
			return $this->listVals($vals);
		//galon petit
		}elseif('GALON_PETITS' == $itemType){ // grands et petits
			return $this->listVals($vals);
		//strass
		}elseif('STRASS' == $itemType){
			return $this->listVals($vals);
		//grand galons barioles
		}elseif('GRANDS_GALONS_BARIOLES' == $itemType){
			return $this->listVals($vals);
		//petit galons barioles
		}elseif('PETITS_GALONS_BARIOLES' == $itemType){
			return $this->listVals($vals);
		//basebordure
		}elseif('BASEBORDURE' == $itemType){
			return $this->listVals($vals);
		//couleurs
		}elseif('COLOR' == $itemType){                     
			return $this->colorListVals($vals);
                }else{
                    throw new Exception("In ItemsManager->listValBuilder(), aucun type connu définit!!!");
                }                            
        }
        private function colorListVals($vals){
            $tmp = '';
            foreach($vals[1] as $key => $val){
                $tmp .= StringTool::getlistVal(($key + 1), $val) . "\n";
            }
            return $tmp;
        }
        private function listVals($vals){
            $tmp = '';
            //var_dump($vals);die;
            foreach($vals[0] as $key => $val){
                $tmp .= StringTool::getlistVal(($key + 1), $val) . "\n";
            }
            return $tmp;
        }                
        public function concatlistValBuilder($vals, $itemType='', $rootLabel='', $tranches=array(), $prix=''){
            
		//bordure interieure
		if('BORDURE' == $itemType){
			return $this->concatListVals($vals, $rootLabel, $tranches, $prix);
		//galon grands
		}elseif('GALON_GRANDS' == $itemType){ // grands et petits
			return $this->concatListVals($vals, $rootLabel, $tranches, $prix);
		//galon petit
		}elseif('GALON_PETITS' == $itemType){ // grands et petits
			return $this->concatListVals($vals, $rootLabel, $tranches, $prix);
		//strass
		}elseif('STRASS' == $itemType){
                        //var_dump('STRASS xxx'); //die;
                        //var_dump($vals); die;
			return $this->concatListVals($vals, $rootLabel, $tranches, $prix);
		//grand galons barioles
		}elseif('GRANDS_GALONS_BARIOLES' == $itemType){
			return $this->concatListVals($vals, $rootLabel, $tranches, $prix);
		//petit galons barioles
		}elseif('PETITS_GALONS_BARIOLES' == $itemType){
			return $this->concatListVals($vals, $rootLabel, $tranches, $prix);
		//basebordure
		}elseif('BASEBORDURE' == $itemType){
			return $this->concatListVals($vals, $rootLabel, $tranches, $prix);
		//couleurs
		}elseif('COLOR' == $itemType){                     
			return $this->concatListVals($vals, $rootLabel, $tranches, $prix);
                }else{
                    throw new Exception("In ItemsManager->listValBuilder(), aucun type connu définit!!!");
                }                            
        }        
        private function concatListVals($vals, $rootLabel='', $tranches=array(), $prix){
            $tmp = '';
            //var_dump($vals); //die;
            foreach($vals[0] as $key => $val){
                //$key += $tranches[0];
                //var_dump($val);
                $tmp .= StringTool::getConcatlistVal($tranches[0], ($key + 1), $val, $rootLabel , $prix) . "\n";
            }
            return $tmp;
        }          
}