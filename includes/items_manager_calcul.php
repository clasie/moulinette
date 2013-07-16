<?php
//string manipulation tool class
include_once 'string_tool.php';

class ItemsManagerCalcul {
	
	//galon
	const GALLON              = 'g_';      
	const URL_IMAGES_GALONS  = '../../../../../misc/images/options/struct_colors_customized/5_galons/';
	
	const GALLON_GRAND_CALCULE              = 'ggc_';
        const GALLON_PETIT_CALCULE              = 'pgc_';
        
	const BORDURE_GRAND_CALCULE             = 'bgc_';
        const BORDURE_PETIT_CALCULE             = 'bpc_';       
        
        const BORDURE_RAJOUTE_CALCULE           = 'brc_';         
        const BORDURE_DECALEE_CALCULE           = 'bdc_';        
        //const BORDURE__CALCULE           = 'brc_'; 
        
	//bordure
	const BORDURE             = 'br_';
	const URL_IMAGES_BORDURES = '../../../../../misc/images/options/struct_colors_customized/3_bord_interieur/';

	//basebordure 
	const BASEBORDURE         = 'base_br_';
	const URL_IMAGES_BASEBORDURE = '../../../../../misc/images/options/struct_colors_customized/2_bordure/';
        
	const BASEBORDURE_CALCULES         = 'bbc_';
      //const URL_IMAGES_BASEBORDURE = '../../../../../misc/images/options/struct_colors_customized/2_bordure/';        
	
        //const BORDURE_RAJ_CALCULES         = 'brc_';        
        
	//strass
	const STRASS              = 'st_';
	const URL_IMAGES_STRASS   = '../../../../../misc/images/options/struct_colors_customized/4_strass/';
	
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
                        $val    = $trans->translate('bordures', 'both');
			$title  = $val;
		//galon	
		}elseif('GALON_GRANDS' == $itemType){
			$prefix = $this::GALLON;
                        $val    = $trans->translate('grands_galons', 'both');
			$title  = $val;
		//grand galon calcule
		}elseif('GALON_GRANDS_CALCULES' == $itemType){
			$prefix     = $this::GALLON_GRAND_CALCULE;
                        $val        = $trans->translate('grands_galons', 'both');
			$title      = $val;
			$css_color  = 'Bases';
                        $css_border = 'ColorBorders';                        
		//grands bords calcules 
		}elseif('BORD_GRAND_CALCULES' == $itemType){ 
			$prefix     = $this::BASEBORDURE_CALCULES;
                        $val        = $trans->translate('bordure_exterieure', 'both');
			$title      = $val;
			$css_color  = 'Bases';
                        $css_border = 'ColorBorders';                  
                        $html_exclude_box_title = true;
		//petit galon calcule
		}elseif('GALON_PETITS_CALCULES' == $itemType){
			$prefix     = $this::GALLON_PETIT_CALCULE;
                        $val        = $trans->translate('petits_galons', 'both');
			$title      = $val;
			$css_color  = 'Bases';
                        $css_border = 'ColorBorders';                        
		//strass
		}elseif('GALON_PETITS' == $itemType){
			$prefix = $this::GALLON;
                        $val    = $trans->translate('petits_galons', 'both');
			$title  = $val;
		//strass
		}elseif('STRASS' == $itemType){
			$prefix = $this::STRASS;
                        $val    = $trans->translate('strass', 'both');
			$title  = $val;
		//basebordure
		}elseif('BASEBORDURE' == $itemType){
			$html_exclude_box_title = true;
			$prefix = $this::BASEBORDURE;
                        $val    = $trans->translate('bordure_au_choix', 'both');
			$title  = $val; 
                        $css_border = 'ColorBorders';
		//bordure rajoute calcule
		}elseif('BORDURE_RAJOUTE_CALCULE' == $itemType){
			$html_exclude_box_title = false;
			$prefix = $this::BORDURE_RAJOUTE_CALCULE;
                        $val    = $trans->translate('bordures_raj', 'both');                        
			$title  = $val; 
                        $css_border = 'ColorBorders';
		//bordure decal calcule
		}elseif('BORDURE_DECALE_CALCULE' == $itemType){
			$html_exclude_box_title = false;
			$prefix = $this::BORDURE_DECALEE_CALCULE;
                        $val    = $trans->translate('bordures_dec', 'both');
			$title  = $val; 
                        $css_border = 'ColorBorders';
		//couleur
		}elseif('COLOR' == $itemType){
			$html_exclude_box_title = true;
			$prefix     = $this::COLOR;
                        $val        = $trans->translate('couleurs', 'both');
			$title      = $val;
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
                //var_dump($labels);die;
		foreach($labels as $key=>$line){
                        //echo '<pre>';
                        //var_dump($key);
			//var_dump($line);
			//css class name
			$className   = $line;
			$className   = StringTool::getCssClassName($className, $salt);
                        //echo $className .  '<br />'; //die;
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
		//die;
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
		//galon grand calcule
		}elseif('GALON_GRANDS_CALCULES' == $itemType){ // grands et petits
			$prefix = $this::GALLON_GRAND_CALCULE;
			$url    = $this::URL_IMAGES_GALONS;
		//galon petit calcule
		}elseif('GALON_PETITS_CALCULES' == $itemType){ // grands et petits
			$prefix = $this::GALLON_PETIT_CALCULE;
			$url    = $this::URL_IMAGES_GALONS;
		//galon petit
		}elseif('GALON_PETITS' == $itemType){ // grands et petits
			$prefix = $this::GALLON;
			$url    = $this::URL_IMAGES_GALONS;
		//strass
		}elseif('STRASS' == $itemType){
			$prefix = $this::STRASS;
			$url    = $this::URL_IMAGES_STRASS;
		//basebordure
		}elseif('BASEBORDURE' == $itemType){
			$prefix = $this::BASEBORDURE;
			$url    = $this::URL_IMAGES_BASEBORDURE;
		//basebordure
		}elseif('BORD_GRAND_CALCULES' == $itemType){                    
			$prefix = $this::BASEBORDURE_CALCULES;
			$url    = $this::URL_IMAGES_BASEBORDURE;
		//bord raj calc
		}elseif('BORDURE_RAJOUTE_CALCULE' == $itemType){                    
			$prefix = $this::BORDURE_RAJOUTE_CALCULE;
			$url    = $this::URL_IMAGES_BASEBORDURE;
		//bord dec calc
		}elseif('BORDURE_DECALE_CALCULE' == $itemType){                    
			$prefix = $this::BORDURE_DECALEE_CALCULE;
			$url    = $this::URL_IMAGES_BASEBORDURE;
		//couleurs
		}elseif('COLOR' == $itemType){
			$prefix = $this::COLOR;
			$url    = $this::URL_IMAGES_COLOR;
			
		}
		
	    //modify the keys
	    $new_files = array();	   
	    foreach($files as $key=>$val){
	    	$new_files[] = $val;
	    }	    
	    //rename with the older
	    $files = $new_files;
	    
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
			$className   = StringTool::remove_accents($className);
			$className   = $prefix . $className;
			$color_code  = '';
			
			//image file name label
			$image   = $files[$key_tmp];
			//$image   = StringTool::getImageFileName($image);
				
			//no images neede, just color code
			if('COLOR'                   == $itemType   || 
                           'GALON_GRANDS_CALCULES'   == $itemType   ||
                           'GALON_PETITS_CALCULES'   == $itemType   ||
                           'BORD_GRAND_CALCULES'    == $itemType    || 
                           'BORDURE_RAJOUTE_CALCULE' == $itemType   || 
                           'BORDURE_DECALE_CALCULE'  == $itemType                                 
                        )
                        {
				
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
		//galon grand calcule
		}elseif('GALON_GRANDS_CALCULES' == $itemType){ // grands et petits
			return $this->listVals($vals);
		//galon petit calcule
		}elseif('GALON_PETITS_CALCULES' == $itemType){ // grands et petits
			return $this->listVals($vals);
		//galon petit
		}elseif('GALON_PETITS' == $itemType){ // grands et petits
			return $this->listVals($vals);
		//strass
		}elseif('STRASS' == $itemType){
			return $this->listVals($vals);
		//basebordure 
		}elseif('BASEBORDURE' == $itemType){
			return $this->listVals($vals);
		//basebordure calcule 
		}elseif('BORD_GRAND_CALCULES' == $itemType){
			return $this->listVals($vals);
		//bord raj calc
		}elseif('BORDURE_RAJOUTE_CALCULE' == $itemType){
			return $this->listVals($vals);
		//bord dec calc
		}elseif('BORDURE_DECALE_CALCULE' == $itemType){
			return $this->listVals($vals);
		//couleurs
		}elseif('COLOR' == $itemType){                     
			return $this->colorListVals($vals);
                }else{
                    throw new Exception(__FILE__ .  '  ' . __LINE__ . "In ItemsManager->listValBuilder(), aucun type connu définit!!!");
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
            //echo '<pre>';
            //var_dump($vals); //die;
            foreach($vals[1] as $key => $val){
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
			return $this->concatListVals($vals, $rootLabel, $tranches, $prix);
		//basebordure
		}elseif('BASEBORDURE' == $itemType){
			return $this->concatListVals($vals, $rootLabel, $tranches, $prix);
		//basebordure calcules
		}elseif('BORD_GRAND_CALCULES' == $itemType){
			return $this->concatListVals($vals, $rootLabel, $tranches, $prix);
		//bord raj calc
		}elseif('BORDURE_RAJOUTE_CALCULE' == $itemType){
			return $this->concatListVals($vals, $rootLabel, $tranches, $prix);
		//bord dec calc
		}elseif('BORDURE_DECALE_CALCULE' == $itemType){
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
            //var_dump($vals);//die;
            foreach($vals[0] as $key => $val){
                //$key += $tranches[0];
                //var_dump($val);die;    
                $tmp .= StringTool::getConcatlistVal($tranches[0], ($key + 1), $val, $rootLabel , $prix) . "\n";
                //var_dump($tmp);die;
            }
            return $tmp;
        }          
}