<?php

        //----------------------------------------------------------------couleurs grands galons KEY->1
        //i18n
        $coul_acc_ecu_et_sac = array(
            $trans->translate('blanc'       , 'both') . ' | (ref:1/p)  | #FFFFFF',
            $trans->translate('gris_clair'  , 'both') . ' | (ref:4/p)  | #D1D1DF',
            $trans->translate('bleu_roi'    , 'both') . ' | (ref:9/p)  | #0033CC',
            $trans->translate('jaune'       , 'both') . ' | (ref:34/p) | #FFFF00',
            $trans->translate('fushia'      , 'both') . ' | (ref:33/p) | #FF0066',
            $trans->translate('brun_clair'  , 'both') . ' | (ref:20/p) | #B48100',
            $trans->translate('marine'      , 'both') . ' | (ref:10/p) | #000066',
            $trans->translate('rouge'       , 'both') . ' | (ref:12/p) | #990000',
            $trans->translate('vichy'       , 'both') . ' | (ref:vichy)| #000066',      
                        );        
        $coul_acc_ecu_et_sac = array(
            'blanc      | (ref:1/p)  | #FFFFFF',
            'gris_clair | (ref:4/p)  | #D1D1DF',
            'bleu_roi   | (ref:9/p)  | #0033CC',
            'jaune      | (ref:34/p) | #FFFF00',
            'fushia     | (ref:33/p) | #FF0066',
            'brun_clair | (ref:20/p) | #B48100',
            'marine     | (ref:10/p) | #000066',
            'rouge      | (ref:12/p) | #990000',
            'vichy      | (ref:vichy)| #000066',      
                        );          
	$file_names   = array(
            'name', 'name', 'name', 'name', 'name', 'name', 'xxx' , 'name', 'name'
            );
        //----------------------        
        
        $active_colors_array [1] = array(
            'colors' => $coul_acc_ecu_et_sac,
            'names'  => $file_names
        );
        
 //------------------------color data to generate
        
	$file_content = $active_colors_array[1]['colors'];
	$file_names   = $active_colors_array[1]['names'];

	/**
	 * assemble the data
	*/

	//get items manager class
	include_once 'includes/items_manager_calcul.php';

	//get instance
	$managercalcul = new ItemsManagerCalcul();

	/**
	 * HTML bordure
	*/

	//build the html list
        //$salt = substr(uniqid(), -3);
        $salt = $prix['bordure_raj'][1];
        
	$html = $managercalcul->buildHtmlListElement($file_names, $file_content, 'BORDURE_RAJOUTE_CALCULE', $salt);
        //var_dump($html); 
        //echo 'stopped here ' . __FILE__ .  ' ' . __LINE__;

	//write the html
        if($generate_new_ids)
            $filemanagercalcul->writeHtmlFile($html, 'BORDURE_RAJOUTE_CALCULE', $concatenate_options);

	/**
	 * CSS
	*/

	//build the html list
	$css = $managercalcul->buildCssListElement($file_names, $file_content, 'BORDURE_RAJOUTE_CALCULE', $salt);
        //var_dump($css);  die;
	//write the html
        if($generate_new_ids)
            $filemanagercalcul->writeCssFile($css, 'BORDURE_RAJOUTE_CALCULE', true);
        //var_dump($css);  die;
        //write list vals
        $tmp = $managercalcul->listValBuilder(array($file_names,$file_content), 'BORDURE_RAJOUTE_CALCULE');
        //var_dump($tmp); die;
        
        //concat list vals
        $tmp = $managercalcul->concatlistValBuilder(
           array($file_content), 'BORDURE_RAJOUTE_CALCULE', $tranche_ids['bordure_raj'][2], $tranche_ids['bordure_raj'], $tranche_ids['bordure_raj'][3]                
        );          
        $filemanagercalcul->writelListvalFile($tmp, FileManagerCalcul::CONCAT_LISTVALS_FILE_GENERATED, FILE_APPEND);   

                