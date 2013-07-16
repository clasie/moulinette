<?php

        //----------------------------------------------------------------couleurs grands galons KEY->1
        //i18n
        $coul_acc_ecu_et_sac = array(
            $trans->translate('noir'         , 'both') . ' | (ref:10/p) | black',
            $trans->translate('gris_clair'         , 'both') . ' | (ref:2/p) |#D1D1DF',
            $trans->translate('parme'         , 'both') . '  | (ref:30/p) | #CC85FF',
            $trans->translate('bordeaux'         , 'both') . ' | (ref:9/p) | #800000',
            $trans->translate('brun'         , 'both') . ' | (ref:25/p) | #663300', 
            $trans->translate('mauve'         , 'both') . ' | (ref:31/p) | #78008A',
            $trans->translate('bleu_indigo'         , 'both') . ' | (ref:18/p) | #000066',
            $trans->translate('champagne'         , 'both') . ' | (ref:4/p) | #FFFF99',
            $trans->translate('jaune'         , 'both') . ' | (ref:34/p) | #FFFF00',
            $trans->translate('aubergine'         , 'both') . ' | (ref:32p) | #440066',
            $trans->translate('rouge'         , 'both') . ' | (ref:8/p) | #990000',
            $trans->translate('gris_fonce'         , 'both') . '  | (ref:22/p) | #6F6FA1',
            $trans->translate('marine'         , 'both') . ' | (ref:14/p) | #000066',
            $trans->translate('bleu_roi'         , 'both') . ' | (ref:13/p) | #0033CC',
            $trans->translate('bleu_petrole'         , 'both') . ' | (ref:21/p) | #006699',
            $trans->translate('vert_flash'         , 'both') . '  | (ref:35/p) | #00C900',
            $trans->translate('gris'         , 'both') . ' | (ref:3/p) | #E0E0E9',
            $trans->translate('fushia'         , 'both') . ' | (ref:33/p) | #FF0066',
            $trans->translate('bleu_ciel'         , 'both') . ' | (ref:12/p) | #66CCFF',
            $trans->translate('rouille'         , 'both') . ' | (ref:17/p) | #CC3300',  
            $trans->translate('blanc'         , 'both') . '  | (ref:1/p) | #FFFFFF',
            $trans->translate('vert_chasseur'         , 'both') . ' | (ref:16/p) | #003300',
            $trans->translate('brun_clair'         , 'both') . ' | (ref:24/p) | #B48100',            
                        );        
        $coul_acc_ecu_et_sac = array(
            'noir       | (ref:10/p) | black',
            'gris_clair | (ref:2/p) |#D1D1DF',
            'parme      | (ref:30/p) | #CC85FF',
            'bordeaux   | (ref:9/p) | #800000',
            'brun       | (ref:25/p) | #663300', 
            'mauve      | (ref:31/p) | #78008A',
            'bleu_indigo | (ref:18/p) | #000066',
            'champagne   | (ref:4/p) | #FFFF99',
            'jaune       | (ref:34/p) | #FFFF00',
            'aubergine   | (ref:32p) | #440066',
            'rouge       | (ref:8/p) | #990000',
            'gris_fonce  | (ref:22/p) | #6F6FA1',
            'marine      | (ref:14/p) | #000066',
            'bleu_roi    | (ref:13/p) | #0033CC',
            'bleu_petrole | (ref:21/p) | #006699',
            'vert_flash   | (ref:35/p) | #00C900',
            'gris         | (ref:3/p) | #E0E0E9',
            'fushia       | (ref:33/p) | #FF0066',
            'bleu_ciel    | (ref:12/p) | #66CCFF',
            'rouille      | (ref:17/p) | #CC3300',  
            'blanc        | (ref:1/p) | #FFFFFF',
            'vert_chasseur | (ref:16/p) | #003300',
            'brun_clair    | (ref:24/p) | #B48100',            
                        );         
	$file_names   = array(
            'name', 'name', 'name', 'name', 'name', 'name', 'xxx' , 'name', 'name', 'name',  
            'name', 'name', 'name', 'name', 'name', 'name', 'xxx' , 'name', 'name', 'name',
            'name', 'name', 'name'
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
        $salt = $prix['petit_galons'][1];
        
	$html = $managercalcul->buildHtmlListElement($file_names, $file_content, 'GALON_PETITS_CALCULES', $salt);
        //var_dump($html); 
        //die;
	//write the html
        if($generate_new_ids)
            $filemanagercalcul->writeHtmlFile($html, 'GALON_PETITS_CALCULES', $concatenate_options);

	/**
	 * CSS
	*/

	//build the html list
	$css = $managercalcul->buildCssListElement($file_names, $file_content, 'GALON_PETITS_CALCULES', $salt);
        //var_dump($css);  die;
	//write the html
        if($generate_new_ids)
            $filemanagercalcul->writeCssFile($css, 'GALON_PETITS_CALCULES', true);
        //die;
        //write list vals
        $tmp = $managercalcul->listValBuilder(array($file_names,$file_content), 'GALON_PETITS_CALCULES');
        //var_dump($tmp); die;
        
        //concat list vals
        $tmp = $managercalcul->concatlistValBuilder(
           array($file_content), 'GALON_PETITS', $tranche_ids['petit_galons'][2], $tranche_ids['petit_galons'], $tranche_ids['petit_galons'][3]                
        );          
        $filemanagercalcul->writelListvalFile($tmp, FileManagerCalcul::CONCAT_LISTVALS_FILE_GENERATED, FILE_APPEND);   

                