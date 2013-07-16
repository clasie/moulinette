<?php
        //----------------------------------------------------------------couleurs grands galons KEY->1
        //i18n
        $coul_acc_ecu_et_sac = array(
            $trans->translate('bordeaux'      , 'both') . ' | (ref:9) | #800000',
            $trans->translate('fushia'        , 'both') . ' | (ref:33) | #FF0066',
            $trans->translate('bleu_petrole'  , 'both') . ' | (ref:21) | #006699',
            $trans->translate('aubergine'     , 'both') . ' | (ref:32) | #440066',
            $trans->translate('vert_chasseur' , 'both') . ' | (ref:16) | #003300',
            $trans->translate('jaune_pale'    , 'both') . ' | (ref:7) | #FFFF99',
            $trans->translate('blanc'         , 'both') . ' | (ref:1) | #FFFFFF',
            $trans->translate('moutarde_clair', 'both') . ' | (ref:5) | #FFCC00',
            $trans->translate('rouille'       , 'both') . ' | (ref:17) | #CC3300',
            $trans->translate('marine'   , 'both') . ' | (ref:14) | #000066',
            $trans->translate('gris_fonce'    , 'both') . ' | (ref:22) | #6F6FA1',
            $trans->translate('parme'         , 'both') . ' | (ref:30) | #CC85FF',
            $trans->translate('mauve'         , 'both') . ' | (ref:31) | #78008A',
            $trans->translate('champagne'     , 'both') . ' | (ref:4) | #FFFF99',
            $trans->translate('orange'        , 'both') . ' | (ref:29) | #FF6600',
            $trans->translate('vert_flash'    , 'both') . ' | (ref:35) | #00C900',
            $trans->translate('gris_bleu'     , 'both') . ' | (ref:23) | #659A9A',
            $trans->translate('gris'          , 'both') . ' | (ref:3) | #E0E0E9',
            $trans->translate('brun'          , 'both') . ' | (ref:25) | #663300', 
            $trans->translate('bleu_roi'      , 'both') . ' | (ref:13) | #0033CC ', 
            $trans->translate('moutarde_fonce', 'both') . ' | (ref:6) | #CC9900',
            $trans->translate('noir'          , 'both') . ' | (ref:10) | black',
            $trans->translate('bleu_indigo'   , 'both') . ' | (ref:18) | #000066',
            $trans->translate('gris_clair'    , 'both') . ' | (ref:2) | #D1D1DF',
            $trans->translate('vert_pale'     , 'both') . '  | (ref:26) | #7ECA32',
            $trans->translate('bleu_ciel'     , 'both') . ' | (ref:12) | #66CCFF',
            $trans->translate('rose_pale'     , 'both') . ' | (ref:11) | #FFB6C1',
            $trans->translate('vieux_rose'    , 'both') . ' | (ref:15) | #FF797B',
            $trans->translate('brun_clair'    , 'both') . ' | (ref:24) | #B48100',
            $trans->translate('rouge'         , 'both') . ' | (ref:8) | #990000',             
                        );        
        $coul_acc_ecu_et_sac = array(
            'bordeaux | (ref:9) | #800000',
            'fushia   | (ref:33) | #FF0066',
            'bleu_petrole | (ref:21) | #006699',
            'aubergine    | (ref:32) | #440066',
            'vert_chasseur | (ref:16) | #003300',
            'jaune_pale    | (ref:7) | #FFFF99',
            'blanc         | (ref:1) | #FFFFFF',
            'moutarde_clair | (ref:5) | #FFCC00',
            'rouille        | (ref:17) | #CC3300',
            'marine         | (ref:14) | #000066',
            'gris_fonce     | (ref:22) | #6F6FA1',
            'parme          | (ref:30) | #CC85FF',
            'mauve          | (ref:31) | #78008A',
            'champagne      | (ref:4) | #FFFF99',
            'orange         | (ref:29) | #FF6600',
            'vert_flash     | (ref:35) | #00C900',
            'gris_bleu      | (ref:23) | #659A9A',
            'gris           | (ref:3) | #E0E0E9',
            'brun           | (ref:25) | #663300', 
            'bleu_roi       | (ref:13) | #0033CC ', 
            'moutarde_fonce | (ref:6) | #CC9900',
            'noir           | (ref:10) | black',
            'bleu_indigo    | (ref:18) | #000066',
            'gris_clair     | (ref:2) | #D1D1DF',
            'vert_pale      | (ref:26) | #7ECA32',
            'bleu_ciel  | (ref:12) | #66CCFF',
            'rose_pale  | (ref:11) | #FFB6C1',
            'vieux_rose | (ref:15) | #FF797B',
            'brun_clair | (ref:24) | #B48100',
            'rouge      | (ref:8) | #990000',             
                        );          
	$file_names   = array(
            'name', 'name', 'name', 'name', 'name', 'name', 'xxx' , 'name', 'name', 'name',  
            'name', 'name', 'name', 'name', 'name', 'name', 'xxx' , 'name', 'name', 'name',
            'name', 'name', 'name', 'name', 'name', 'name', 'xxx' , 'name', 'name', 'name',
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
        $salt = $prix['grand_galons'][1];

	$html = $managercalcul->buildHtmlListElement($file_names, $file_content, 'GALON_GRANDS_CALCULES', $salt);
        //var_dump($html); 
        //die;
	//write the html
        if($generate_new_ids)
            $filemanagercalcul->writeHtmlFile($html, 'GALON_GRANDS_CALCULES', $concatenate_options);

	/**
	 * CSS
	*/

	//build the html list
	$css = $managercalcul->buildCssListElement($file_names, $file_content, 'GALON_GRANDS_CALCULES', $salt);
        //var_dump($css);  die;
	//write the html
        if($generate_new_ids)
            $filemanagercalcul->writeCssFile($css, 'GALON_GRANDS_CALCULES', true);
        //die;
        //write list vals
        $tmp = $managercalcul->listValBuilder(array($file_names,$file_content), 'GALON_GRANDS_CALCULES');
        //var_dump($tmp); die;
        
        //concat list vals
        $tmp = $managercalcul->concatlistValBuilder(
           array($file_content), 'GALON_GRANDS', $tranche_ids['grand_galons'][2], $tranche_ids['grand_galons'], $tranche_ids['grand_galons'][3]                
        );  
        //var_dump($tmp);//die;
        $filemanagercalcul->writelListvalFile($tmp,  FileManagerCalcul::CONCAT_LISTVALS_FILE_GENERATED);   

                