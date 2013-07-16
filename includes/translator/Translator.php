<?php
//vals
include_once 'all_vals/all_vals.php';

class Translator {
    
    //translate
    public function translate($i18n_val = null, $langue='fr'){
        
        global $all_vals;
        
        try{        
            
           switch($langue){
               
               case         'fr'  :  ;
               case         'nl'  :  return $all_vals[$i18n_val][$langue];   break;
               case         'both':  return $all_vals[$i18n_val]['fr'] . '/' . $all_vals[$i18n_val]['nl']; break;
               default    : 'Wrong key: ' . __FILE__ .  ' ' . __LINE__ ;
           }

        }catch(Exception $e){
            return 'KO '  . __FILE__ .  ' ' . __LINE__ ;;
        }
    }
}
