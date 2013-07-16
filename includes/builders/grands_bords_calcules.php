<?php

        //----------------------------------------------------------------couleurs grands galons KEY->1
        //i18n
        $coul_acc_ecu_et_sac = array(
            $trans->translate('bordeaux'     , 'both') . ' | (ref:13) | #800000',
            $trans->translate('vert_chasseur', 'both') . ' | (ref:14) | #003300',
            $trans->translate('brun'         , 'both') . ' | (ref:15) | #663300',
            $trans->translate('noir'         , 'both') . ' | (ref:16) | black',
            $trans->translate('gris'         , 'both') . ' | (ref:17) | #6F6FA1',
            $trans->translate('orange'       , 'both') . ' | (ref:18) | #FF6600',
            $trans->translate('jaune'        , 'both') . ' | (ref:19) | #FFFF00',
            $trans->translate('brun_clair'   , 'both') . ' | (ref:20) | #B48100',
            $trans->translate('parme'        , 'both') . ' | (ref:21) | #CC85FF',
            $trans->translate('aubergine'    , 'both') . ' | (ref:22) | #440066',
            $trans->translate('blanc'        , 'both') . ' | (ref:1)  | #FFFFFF',
            $trans->translate('rose_pale'    , 'both') . ' | (ref:2)  | #FF797B',
            $trans->translate('creme'        , 'both') . ' | (ref:3)  | #FFFF99',
            $trans->translate('gris_clair'   , 'both') . ' | (ref:4)  | #D1D1DF',
            $trans->translate('gris_fonce'   , 'both') . ' | (ref:6)  | #6F6FA1',
            $trans->translate('bleu_ciel'    , 'both') . ' | (ref:7)  | #D5ECF1',
            $trans->translate('bleu_petrole' , 'both') . ' | (ref:8)  | #006699',
            $trans->translate('bleu_roi'     , 'both') . ' | (ref:9)  | #0033CC',
            $trans->translate('marine'  , 'both') . ' | (ref:10) | #000066',
            $trans->translate('moutarde'     , 'both') . ' | (ref:11) | #DF9300',
            $trans->translate('rouge'        , 'both') . ' | (ref:12) | #990000',          
                        );        
        $coul_acc_ecu_et_sac = array(
            'bordeaux      | (ref:13) | #800000',
            'vert_chasseur | (ref:14) | #003300',
            'brun          | (ref:15) | #663300',
            'noir          | (ref:16) | black',
            'gris          | (ref:17) | #6F6FA1',
            'orange        | (ref:18) | #FF6600',
            'jaune         | (ref:19) | #FFFF00',
            'brun_clair    | (ref:20) | #B48100',
            'parme         | (ref:21) | #CC85FF',
            'aubergine     | (ref:22) | #440066',
            'blanc         | (ref:1)  | #FFFFFF',
            'rose_pale     | (ref:2)  | #FF797B',
            'creme         | (ref:3)  | #FFFF99',
            'gris_clair    | (ref:4)  | #D1D1DF',
            'gris_fonce    | (ref:6)  | #6F6FA1',
            'bleu_ciel     | (ref:7)  | #D5ECF1',
            'bleu_petrole  | (ref:8)  | #006699',
            'bleu_roi      | (ref:9)  | #0033CC',
            'marine        | (ref:10) | #000066',
            'moutarde      | (ref:11) | #DF9300',
            'rouge         | (ref:12) | #990000',          
                        );          
	$file_names   = array(
            'name', 'name', 'name', 'name', 'name', 'name', 'xxx' , 'name', 'name', 'name',  
            'name', 'name', 'name', 'name', 'name', 'name', 'xxx' , 'name', 'name', 'name',
            'name'
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
        $salt = $prix['grands_bords'][1];

	$html = $managercalcul->buildHtmlListElement($file_names, $file_content, 'BORD_GRAND_CALCULES', $salt);
        //var_dump($html); die;

	//write the html
        if($generate_new_ids)
            $filemanagercalcul->writeHtmlFile($html, 'BORD_GRAND_CALCULES');

	/**
	 * CSS
	*/

	//build the html list
	$css = $managercalcul->buildCssListElement($file_names, $file_content, 'BORD_GRAND_CALCULES', $salt);
        //var_dump($css);  die;
	//write the html
        if($generate_new_ids)
            $filemanagercalcul->writeCssFile($css, 'BORD_GRAND_CALCULES', true);
        //var_dump($css);  die;
        //write list vals
        $tmp = $managercalcul->listValBuilder(array($file_names,$file_content), 'BORD_GRAND_CALCULES');
        //var_dump($tmp); die;
        
        //concat list vals
        $tmp = $managercalcul->concatlistValBuilder(
           array($file_content), 'BORD_GRAND_CALCULES', $tranche_ids['grands_bords'][2], $tranche_ids['grands_bords'], $tranche_ids['grands_bords'][3]                
        );          
        //var_dump($tmp);die;
        $filemanagercalcul->writelListvalFile($tmp, FileManagerCalcul::BASEBORDURE_LISTVALS_FILE_GENERATED); //, FILE_APPEND);   

                