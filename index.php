<?php
/**
 * ToDoEqui
 * 0- Trad images options non faites !!!!!!!!!!!!!! <--------------------
 * 1- Remote install css, images OK
 * 1- Remote create ts dressage  OK
 * 2- Remote install HTML 
 * 3- Remote install listvals
 */
/**
 * Utils
 */
function disp($val='HERE'){
    echo '<pre>';
    var_dump($val);
    die;
}

//inclure the translator
include './includes/translator/Translator.php';

//create instance
$trans = new Translator();
//test
echo $trans->translate('grand_galon', 'both');

/*
 * Todo: geneate calculated colors in place of images on
 * - grand galon OK
 * - petit galon OK
 * - petits bords raj + decal OK
 * - list vals                OK
 *    - options               OK
 *    - grands bords          OK
 * - ... strass               OK
 * - ... images bariolees     OK
 * - Faire un bundle pour toutes les options générées dans un seul file OK
 * - Noter la procedure de regeneration OK
 * - Rajouter images grands galons doré/argente OK
 * - Rajouter images grands galons doré/argente OK
 * - Faire le point = exporter en test          OK
 * 
 * - Vals
 * 
 *   -> les css vont dans
 *      -> /var/www/equiselect/sites/default/files/
 *            adaptivetheme/at_commerce_files/
 *               at_commerce.custom.css
 * 
 *      Il n'est pas nécessaire de remouliner pour les css ou les html generated. 
 *      (sauf si il y a de nouvelles couleurs ou images.)
 * 
 *      Remouliner juste pour les prix des options.
 * 
 *      Exemple:
 * 
 *      1- Tapis de selle dressage:
 * 
 *          //COULEURS
 *          0- Sélectionner le produit 'Tapis de selle dressage' 
 *             [ ctrl+f: KEY_SELECTION_COLOR_FLAG ] 
 *                -> afin d'obtenir les COULEURS correspondants 
 *                   au produit
 * 
 * 
 *          //PRIX OPTIONS          
 *          0- Sélectionner le produit 'Tapis de selle dressage' 
 *             [ ctrl+f: KEY_SELECTION_PRICE_OPTIONS_FLAG ] 
 *                -> afin d'obtenir les PRIX correspondants 
 *                   dans les list vals des options. 
 * 
 *          1- Lancer la moulinette    
 * 
 *          2- Taille (manuel)
 * 
 *          3- Coloris 
 * 
 *           -> color-listvals-generated.txt       v
 *           -> colors-css_geneated.txt            v
 *           -> colors-html_generated.txt          v
 *              
 * 
 *          4- Bordure au choix gratuite
 * 
 *           -> basebordures-listvals-generated.txt        v
 *           -> basebordures-calcul-css_geneated.txt       v
 *           -> basebordures-calcul-html_generated.txt     v
 * 
 *          5- Options
 * 
 *              1- 3 niveaux de customisation
 *                  -> Chaque niveau liste toutes les options possibles
 * 
 *              2- lacets 2 (manuel)
 *              3- lacets 4 (manuel)
 *              4- Box options communes
 * 
 *    -> concat-options-listvals-generated.txt  -> 3 fois!!!                    v
 *    -> concat-options-css-generated.txt         v
 *    -> concat-options-html-generated.txt        v          
 * 
 *                  1- Grands galons
 *                  2- Petits galons
 *                  3- Bordures rajoutées
 *                  4- Bordures décalées
 *                  5- Grands galons multicolors
 *                      -> Local dir : 
 *                           files-galons-barioles/
 *                      -> Remote dir: 
 *                          /misc/images/options/struct_colors_customized/5_grands_galons_barioles/
 * 
 *                  6- Petits galons multicolores
 *                      -> Local dir : 
 *                           files-galons-barioles-petits/
 *                      -> Remote dir: 
 *                          /misc/images/options/struct_colors_customized/5_petits_galons_barioles/
 * 
 *                  7- Strass
 *                      -> Local dir : 
 *                           files-strass
 *                      -> Remote dir: 
 *                           /misc/images/options/struct_colors_customized/4_strass/
 * 
 *          
 * - I18N <----------------------------------- here
 * 
 * - Démo en ligne
 */
 
/**
 * Les prix des options varient selon le produit
 */
$prix_selon_produit = array(
    'tapis_dressage' =>     
       array('grand_galons'          =>'25,00 €',
             'grand_galons_barioles' =>'25,00 €',           
             'petit_galons_barioles' =>'25,00 €',            
             'petit_galons'          =>'25,00 €',
             'bordure_raj'           =>'25,00 €',   
             'bordure_dec'           =>'25,00 €',   
             'strass'                =>'25,00 €',            
       ),
    'tapis_saut'     =>        
       array('grand_galons'          =>'26,00 €',
             'grand_galons_barioles' =>'26,00 €',         
             'petit_galons_barioles' =>'26,00 €',            
             'petit_galons'          =>'26,00 €',
             'bordure_raj'           =>'26,00 €',   
             'bordure_dec'           =>'26,00 €',   
             'strass'                =>'26,00 €',          
       ),
    'couverture'     => 
       array('grand_galons'          =>'27,00 €',
             'grand_galons_barioles' =>'27,00 €',     
             'petit_galons_barioles' =>'27,00 €',            
             'petit_galons'          =>'27,00 €',
             'bordure_raj'           =>'27,00 €',   
             'bordure_dec'           =>'27,00 €',   
             'strass'                =>'27,00 €',            
       ),  
);

//---------------------------> Selectioner le prix des options correspondant à un produit
// KEY_SELECTION_PRICE_OPTIONS_FLAG

$produit = 'tapis_dressage';
//$produit = 'tapis_saut';
//$produit = 'couverture';

//prix + unique id css
$prix = array(
    //options
    'grand_galons'          => array ($prix_selon_produit[$produit]['grand_galons']          , 'id_gg'),
    'grand_galons_barioles' => array ($prix_selon_produit[$produit]['grand_galons_barioles'] , 'id_ggb'),    
    'petit_galons_barioles' => array ($prix_selon_produit[$produit]['petit_galons_barioles'] , 'id_pgb'),     
    'petit_galons'          => array ($prix_selon_produit[$produit]['petit_galons']          , 'id_pg'),
    'bordure_raj'           => array ($prix_selon_produit[$produit]['bordure_raj']           , 'id_br'),   
    'bordure_dec'           => array ($prix_selon_produit[$produit]['bordure_dec']           , 'id_bd'),    
    'strass'                => array ($prix_selon_produit[$produit]['strass']                , 'id_st'),     
    //bord par def
    'grands_bords'          => array (''   , 'id_gb'),         
);

$key_prix = 0;

//i18n
//tranches d'ids
$tranche_ids = array (
    'grand_galons' => array (100, 199, $trans->translate('grand_galon', 'both')             
        , $prix['grand_galons'][$key_prix]),
    'grand_galons_barioles' => array (200, 299, $trans->translate('grand_galons_barioles', 'both')               
        , $prix['grand_galons_barioles'][$key_prix]),    
    'petit_galons_barioles' => array (300, 399, $trans->translate('petit_galons_barioles', 'both')               
        , $prix['grand_galons_barioles'][$key_prix]),      
    'petit_galons' => array (400, 499, $trans->translate('petit_galons', 'both')
        , $prix['petit_galons'][$key_prix]),
    'bordure_raj'  => array (500, 599, $trans->translate('bordure_raj', 'both')   
        , $prix['bordure_raj'][$key_prix]), 
    'bordure_dec'  => array (600, 699, $trans->translate('bordure_dec', 'both')     
        , $prix['bordure_dec'][$key_prix]),     
    'strass'       => array (700,799, $trans->translate('strass', 'both')                               
        , $prix['strass'][$key_prix]),   
    'grands_bords' => array (800, 899, $trans->translate('grands_bords', 'both')                  
        , $prix['grands_bords'][$key_prix]),      
);

//flags
$generate_new_ids                  = true; //false;
$calculs_grands_galons             = true;
$calculs_grands_galons_barioles    = true;
$calculs_petits_galons_barioles    = true;
$calculs_petits_galons             = true;
$calculs_grands_bords              = true;
$calculs_bords_rajoutes            = true;
$calculs_bords_decales             = true;
$concatenate_options               = true;

echo "Generates new ids: " . ((!$generate_new_ids)? 'KO' : 'OK') . '<br />';

//displ erors
ini_set('display_errors', 1);
error_reporting(-1);

/**
 * capture the data
 */

//get manager file class
include_once 'includes/file_manager.php';
include_once 'includes/file_manager_calcul.php';

/**
 * Empty css concatenated file
 */
FileManager::emptyCssConcatFile();
FileManagerCalcul::emptyCssConcatFile();

//get instance
$filemanager       = new FileManager();
$filemanagercalcul = new FileManagerCalcul();

//cleanse list vals in file
$filemanager->writelListvalFile('',  FileManager::CONCAT_LISTVALS_FILE_GENERATED);
//display debug

/************************************************************************************
 * OPTIONS
 */


echo '<pre>';
echo '<br /><u><h2>OPTIONS (not free)</h2></u><br />';

if(1){ //----------------------------------------------------------galons grands
    //calcul
    if($calculs_grands_galons){
        //
        //calculateurs
        include_once 'includes/builders/grands_galons_calcules.php';        
        //----fin calcul
    }else{    
        throw new Exception(__FILE__ .  ' ' . __LINE__);
	//----------------------------------------------------------galons grands	
	//dir content
	$dir_uri = '/var/www/test/equi-moulinette/data/files-galons-grands/.';
	$file_names = $filemanager->getFileNames($dir_uri);

	//file content
	$file_uri = '/var/www/test/equi-moulinette/data/galons-grand-label-names.txt';
	$file_content = $filemanager->getFileContent($file_uri, 'GALON_GRANDS');

	/**
	 * assemble the data
	 */
	
	//get items manager class
	include_once 'includes/items_manager.php';
	
	//get instance
	$manager = new ItemsManager();
	
	/**
	 * HTML galon
	 */
	
	//build the html list
        $salt = substr(uniqid(), -3);        
	$html = $manager->buildHtmlListElement($file_names, $file_content, 'GALON_GRANDS', $salt);
	echo '<pre>';

	//write the html
        if($generate_new_ids)
            $filemanager->writeHtmlFile($html, 'GALON_GRANDS');
	
	/**
	 * CSS
	 */
	
	//build the html list
	$html = $manager->buildCssListElement($file_names, $file_content, 'GALON_GRANDS', $salt);
	
	//write the html
        if($generate_new_ids)
            $filemanager->writeCssFile($html, 'GALON_GRANDS');

        //write list vals
        $tmp = $manager->listValBuilder(array($file_content), 'GALON_GRANDS'); 
        //$tranche_idsdisp($tmp);
        $filemanager->writelListvalFile($tmp,  FileManager::GALON_LISTVALS_FILE_GENERATED);          
        
        //concat list vals
        $tmp = $manager->concatlistValBuilder(
        array($file_content), 'GALON_GRANDS', $tranche_ids['grand_galons'][2], $tranche_ids['grand_galons'], $tranche_ids['grand_galons'][3]                
        );        
        $filemanager->writelListvalFile($tmp,  FileManager::CONCAT_LISTVALS_FILE_GENERATED);         
    }
}

if(1){ //----------------------------------------------------------galons petits

    if($calculs_petits_galons){
        //calculateurs
        include_once 'includes/builders/petits_galons_calcules.php';        
        //----fin calcul
        
    }else{  
         throw new Exception(__FILE__ .  ' ' . __LINE__);
	//----------------------------------------------------------galons petits	
	//dir content
	$dir_uri = '/var/www/test/equi-moulinette/data/files-galons-petits/.';
	$file_names = $filemanager->getFileNames($dir_uri);
	
	//file content
	$file_uri = '/var/www/test/equi-moulinette/data/galons-petit-label-names.txt';
	$file_content = $filemanager->getFileContent($file_uri, 'GALON_PETITS');

	/**
	 * assemble the data
	 */
	
	//get items manager class
	include_once 'includes/items_manager.php';
	
	//get instance
	$manager = new ItemsManager();
	
	/**
	 * HTML galon
	 */
	
	//build the html list
        $salt = substr(uniqid(), -3);        
	$html = $manager->buildHtmlListElement($file_names, $file_content, 'GALON_PETITS', $salt);
	//echo 7;
	//var_dump($html); die();
	//write the html
        if($generate_new_ids)
            $filemanager->writeHtmlFile($html, 'GALON_PETITS');
	
	/**
	 * CSS
	 */
	
	//build the html list
	$html = $manager->buildCssListElement($file_names, $file_content, 'GALON_PETITS', $salt);
	
	//write the html
        if($generate_new_ids)
            $filemanager->writeCssFile($html, 'GALON_PETITS');

        //write list vals
        $tmp = $manager->listValBuilder(array($file_content), 'GALON_PETITS');
        $filemanager->writelListvalFile($tmp,  FileManager::GALON_P_LISTVALS_FILE_GENERATED);       
        
        //concat list vals
        $tmp = $manager->concatlistValBuilder(
                array($file_content), 'GALON_PETITS', $tranche_ids['petit_galons'][2], $tranche_ids['petit_galons'], $tranche_ids['petit_galons'][3]                
        );        
        $filemanager->writelListvalFile($tmp,  FileManager::CONCAT_LISTVALS_FILE_GENERATED, FILE_APPEND);          
    }           
}


if(1){
//----------------------------------------------------------bordures raj

    //calculs grands bords
    if($calculs_bords_rajoutes){

        //calculateurs
        include_once 'includes/builders/bords_rajoutes_calcules.php';        
        //----fin calcul
        
    }else{
        throw new Exception(__FILE__ .  ' ' . __LINE__);
	//dir content
	$dir_uri = '/var/www/test/equi-moulinette/data/files-bordures/.';
	$file_names = $filemanager->getFileNames($dir_uri);
	//echo '<pre>';
	//var_dump($file_names);
	
	//file content
	$file_uri = '/var/www/test/equi-moulinette/data/bordures-label-names.txt';
	$file_content = $filemanager->getFileContent($file_uri, 'BORDURE');
	
	//var_dump($file_content); 
	
	/**
	 * assemble the data
	 */
	
	//get items manager class
	include_once 'includes/items_manager.php';
	
	//get instance
	$manager = new ItemsManager();
	
	/**
	 * HTML bordure
	 */
	
	//build the html list
        $salt = substr(uniqid(), -3);        
	$html = $manager->buildHtmlListElement($file_names, $file_content, 'BORDURE', $salt);
	
	//write the html
        if($generate_new_ids)
            $filemanager->writeHtmlFile($html, 'BORDURE');
	
	/**
	 * CSS
	 */
	
	//build the html list
	$html = $manager->buildCssListElement($file_names, $file_content, 'BORDURE', $salt);
	
	//write the html
        if($generate_new_ids)
            $filemanager->writeCssFile($html, 'BORDURE');
        
        //write list vals
        $tmp = $manager->listValBuilder(array($file_content), 'BORDURE');
        $filemanager->writelListvalFile($tmp,  FileManager::BORDURE_LISTVALS_FILE_GENERATED);           
        
        //concat list vals
        $tmp = $manager->concatlistValBuilder(
                array($file_content), 'BORDURE', $tranche_ids['bordure_raj'][2], $tranche_ids['bordure_raj'], $tranche_ids['bordure_raj'][3]               
        );        
        $filemanager->writelListvalFile($tmp,  FileManager::CONCAT_LISTVALS_FILE_GENERATED, FILE_APPEND);            
        
        //concat list vals
        $tmp = $manager->concatlistValBuilder(
                array($file_content), 'BORDURE', $tranche_ids['bordure_dec'][2], $tranche_ids['bordure_dec'], $tranche_ids['bordure_dec'][3]               
        );        
        $filemanager->writelListvalFile($tmp,  FileManager::CONCAT_LISTVALS_FILE_GENERATED, FILE_APPEND);          
    }
}

if(1){
//----------------------------------------------------------bordures decal

    //calculs grands bords
    if($calculs_bords_decales){

        //calculateurs
        include_once 'includes/builders/bords_decales_calcules.php';        
        //----fin calcul
        
    }else{
        throw new Exception(__FILE__ .  ' ' . __LINE__);
	//dir content
	$dir_uri = '/var/www/test/equi-moulinette/data/files-bordures/.';
	$file_names = $filemanager->getFileNames($dir_uri);
	//echo '<pre>';
	//var_dump($file_names);
	
	//file content
	$file_uri = '/var/www/test/equi-moulinette/data/bordures-label-names.txt';
	$file_content = $filemanager->getFileContent($file_uri, 'BORDURE');
	
	//var_dump($file_content); 
	
	/**
	 * assemble the data
	 */
	
	//get items manager class
	include_once 'includes/items_manager.php';
	
	//get instance
	$manager = new ItemsManager();
	
	/**
	 * HTML bordure
	 */
	
	//build the html list
        $salt = substr(uniqid(), -3);        
	$html = $manager->buildHtmlListElement($file_names, $file_content, 'BORDURE', $salt);
	
	//write the html
        if($generate_new_ids)
            $filemanager->writeHtmlFile($html, 'BORDURE');
	
	/**
	 * CSS
	 */
	
	//build the html list
	$html = $manager->buildCssListElement($file_names, $file_content, 'BORDURE', $salt);
	
	//write the html
        if($generate_new_ids)
            $filemanager->writeCssFile($html, 'BORDURE');
        
        //write list vals
        $tmp = $manager->listValBuilder(array($file_content), 'BORDURE');
        $filemanager->writelListvalFile($tmp,  FileManager::BORDURE_LISTVALS_FILE_GENERATED);           
        
        //concat list vals
        $tmp = $manager->concatlistValBuilder(
                array($file_content), 'BORDURE', $tranche_ids['bordure_raj'][2], $tranche_ids['bordure_raj'], $tranche_ids['bordure_raj'][3]               
        );        
        $filemanager->writelListvalFile($tmp,  FileManager::CONCAT_LISTVALS_FILE_GENERATED, FILE_APPEND);            
        
        //concat list vals
        $tmp = $manager->concatlistValBuilder(
                array($file_content), 'BORDURE', $tranche_ids['bordure_dec'][2], $tranche_ids['bordure_dec'], $tranche_ids['bordure_dec'][3]               
        );        
        $filemanager->writelListvalFile($tmp,  FileManager::CONCAT_LISTVALS_FILE_GENERATED, FILE_APPEND);          
    }
}
//die('here');
if(1){
	//----------------------------------------------------------galons bariolés
	//dir content
	$dir_uri = '/var/www/test/equi-moulinette/data/files-galons-barioles/.';
	$file_names = $filemanager->getFileNames($dir_uri);
	//echo '<pre>';
	//var_dump($file_names);die;
        
	//file content
	$file_uri = '/var/www/test/equi-moulinette/data/galons-barioles-label-names.txt';
	$file_content = $filemanager->getFileContent($file_uri, 'GALONS_BARIOLES');

	//var_dump($file_content); die;

	/**
	 * assemble the data
	*/
	//get items manager class
	include_once 'includes/items_manager.php';
	//get instance
	$manager = new ItemsManager();
	//get items manager class
	//include_once 'includes/items_manager_calcul.php';
	//get instance
	//$manager = new ItemsManagerCalcul();

	/**
	 * HTML bordure
	*/

	//build the html list
        //$salt = substr(uniqid(), -3);      
        $salt = $prix['grand_galons_barioles'][1];
        
	$html = $manager->buildHtmlListElement($file_names, $file_content, 'GRANDS_GALONS_BARIOLES', $salt);

	//write the html
        if($generate_new_ids)
            $filemanager->writeHtmlFile($html, 'GRANDS_GALONS_BARIOLES', $concatenate_options);

	/**
	 * CSS
	*/

	//build the html list
	$html = $manager->buildCssListElement($file_names, $file_content, 'GRANDS_GALONS_BARIOLES', $salt);

	//write the html
        if($generate_new_ids){
            $filemanager->writeCssFile($html, 'GRANDS_GALONS_BARIOLES', true);
        }

        //write list vals
        /////$tmp = $manager->listValBuilder(array($file_content), 'GRANDS_GALONS_BARIOLES');
        //$filemanager->writelListvalFile($tmp,  FileManager::STRASS_LISTVALS_FILE_GENERATED); 
        //disp($file_content);
        //concat list vals
        $tmp = $manager->concatlistValBuilder(
                array($file_content), 'GRANDS_GALONS_BARIOLES'
                , $tranche_ids['grand_galons_barioles'][2]
                , $tranche_ids['grand_galons_barioles']
                , $tranche_ids['grand_galons_barioles'][3]                
        );        
        //disp($tmp);
        $filemanager->writelListvalFile($tmp,  FileManager::CONCAT_LISTVALS_FILE_GENERATED, FILE_APPEND);            
        
}

if(1){
	//----------------------------------------------------------galons bariolés petit
	//dir content
	$dir_uri = '/var/www/test/equi-moulinette/data/files-galons-barioles-petits/.';
	$file_names = $filemanager->getFileNames($dir_uri);
	//echo '<pre>';
	//var_dump($file_names);die;
        
	//file content
	$file_uri = '/var/www/test/equi-moulinette/data/galons-barioles-petits-label-names.txt';
	$file_content = $filemanager->getFileContent($file_uri, 'GALONS_BARIOLES_PETITS');

	//var_dump($file_content); die;

	/**
	 * assemble the data
	*/

	//get items manager class
	include_once 'includes/items_manager.php';

	//get instance
	$manager = new ItemsManager();

	/**
	 * HTML bordure
	*/

	//build the html list
        //$salt = substr(uniqid(), -3);      
        $salt = $prix['petit_galons_barioles'][1];

	$html = $manager->buildHtmlListElement($file_names, $file_content, 'PETITS_GALONS_BARIOLES', $salt);
        //var_dump($html);die;
	//write the html
        if($generate_new_ids)
            $filemanager->writeHtmlFile($html, 'PETITS_GALONS_BARIOLES', $concatenate_options);

	/**
	 * CSS
	*/

	//build the html list
	$html = $manager->buildCssListElement($file_names, $file_content, 'PETITS_GALONS_BARIOLES', $salt);
        //var_dump($html);die;
	//write the html
        if($generate_new_ids){
            $filemanager->writeCssFile($html, 'PETITS_GALONS_BARIOLES', true);
        }
        //die('here');
        //write list vals
        $tmp = $manager->listValBuilder(array($file_content), 'PETITS_GALONS_BARIOLES');
        //$filemanager->writelListvalFile($tmp,  FileManager::STRASS_LISTVALS_FILE_GENERATED); 
        //die; 
        //concat list vals
        $tmp = $manager->concatlistValBuilder(
                array(
                  $file_content), 'PETITS_GALONS_BARIOLES'
                , $tranche_ids['petit_galons_barioles'][2]
                , $tranche_ids['petit_galons_barioles']
                , $tranche_ids['petit_galons_barioles'][3]                
        );   
        //var_dump($tmp);die;
        $filemanager->writelListvalFile($tmp,  FileManager::CONCAT_LISTVALS_FILE_GENERATED, FILE_APPEND);            
        
}

if(1){
	//----------------------------------------------------------strass
	//dir content
	$dir_uri = '/var/www/test/equi-moulinette/data/files-strass/.';
	$file_names = $filemanager->getFileNames($dir_uri);
	//echo '<pre>';
	//var_dump($file_names);die;

	//file content
	$file_uri = '/var/www/test/equi-moulinette/data/strass-label-names.txt';
	$file_content = $filemanager->getFileContent($file_uri, 'STRASS');

	//var_dump($file_content); die;

	/**
	 * assemble the data
	*/

	//get items manager class
	include_once 'includes/items_manager.php';

	//get instance
	$manager = new ItemsManager();

	/**
	 * HTML bordure
	*/

	//build the html list
        //$salt = substr(uniqid(), -3);      
        $salt = $prix['strass'][1];
        
	$html = $manager->buildHtmlListElement($file_names, $file_content, 'STRASS', $salt);

	//write the html
        if($generate_new_ids)
            $filemanager->writeHtmlFile($html, 'STRASS', $concatenate_options);

	/**
	 * CSS
	*/

	//build the html list
	$html = $manager->buildCssListElement($file_names, $file_content, 'STRASS', $salt);

	//write the html
        if($generate_new_ids)
            $filemanager->writeCssFile($html, 'STRASS', true);
        
        //write list vals
        $tmp = $manager->listValBuilder(array($file_content), 'STRASS');
        $filemanager->writelListvalFile($tmp,  FileManager::STRASS_LISTVALS_FILE_GENERATED); 
        //disp($file_content);
        //concat list vals
        $tmp = $manager->concatlistValBuilder(
                array($file_content), 'STRASS', $tranche_ids['strass'][2], $tranche_ids['strass'], $tranche_ids['strass'][3]                
        );      
        //disp($tmp);
        $filemanager->writelListvalFile($tmp,  FileManager::CONCAT_LISTVALS_FILE_GENERATED, FILE_APPEND);            
        
}





/************************************************************************************
 * BORDERS
 */








echo '<br /><u><h2>BORDERS (free)</h2></u><br />'; 

//grands bords
if(1){

    //calculs grands bords
    if($calculs_grands_bords){

        //calculateurs
        include_once 'includes/builders/grands_bords_calcules.php';        
        //----fin calcul

    }else{      
        throw new Exception(__FILE__ .  ' ' . __LINE__);
	//-----------------------------bordure au choix -----------------bordure de BASE = grands bords
	//dir content
	$dir_uri = '/var/www/test/equi-moulinette/data/files-basebordures/.';
	$file_names = $filemanager->getFileNames($dir_uri);
	//echo '<pre>';
	//var_dump($file_names);

	//file content
	$file_uri = '/var/www/test/equi-moulinette/data/basebordures-label-names.txt';
	$file_content = $filemanager->getFileContent($file_uri, 'BASEBORDURE');

	//var_dump($file_content);

	/**
	 * assemble the data
	*/

	//get items manager class
	include_once 'includes/items_manager.php';

	//get instance
	$manager = new ItemsManager();

	/**
	 * HTML bordure
	*/

	//build the html list
        $salt = substr(uniqid(), -3);         
	$html = $manager->buildHtmlListElement($file_names, $file_content, 'BASEBORDURE', $salt);

	//write the html
        if($generate_new_ids)
            $filemanager->writeHtmlFile($html, 'BASEBORDURE');

	/**
	 * CSS
	*/

	//build the html list
	$html = $manager->buildCssListElement($file_names, $file_content, 'BASEBORDURE', $salt);

	//write the html
        if($generate_new_ids)
            $filemanager->writeCssFile($html, 'BASEBORDURE');
        
        //write list vals
        $tmp = $manager->listValBuilder(array($file_content), 'BASEBORDURE');
        $filemanager->writelListvalFile($tmp,  FileManager::BASEBORDURE_LISTVALS_FILE_GENERATED);   
    }
}





/************************************************************************************
 * COLORS
 */





echo '<br /><u><h2>COULEURS DES PRODUITS</h2></u><br />'; 

if(1){
	//----------------------------------------------------------COLORS
	
	//colors tapis de selle/etc...
        //tableau général des couleurs
        $active_colors_array = array();
            
            
        //----------------------------------------------------------------couleurs access ecurie et sac KEY->1
        //i18n
        $coul_acc_ecu_et_sac = array(
             $trans->translate('gris_clair', 'both') . ' | (gris-clair) | #6f6e76', 
             $trans->translate('bleu_roi'  , 'both') . ' | (bleu-roi) | #2e4ca6', 
             $trans->translate('rouge'     , 'both') . ' | (rouge) | #c62827', 
             $trans->translate('bordeaux'   , 'both') . ' | (bordeaux) | #630017', 
             $trans->translate('vert'      , 'both') . ' | (vert) | #525159',  
             $trans->translate('kaki'      , 'both') . ' | (kaki) | #cab491', 
             $trans->translate('brun'      , 'both') . ' | (brun) | #45241b', 
             $trans->translate('marine'     , 'both') . ' | (marine) | #01061c', 
             $trans->translate('noir'      , 'both') . ' | (noir) | #000000', 
             $trans->translate('gris_fonce', 'both') . ' | (gris-fonce) | #41403e',              
                        );        
        $coul_acc_ecu_et_sac = array(
             'gris_clair | (gris-clair) | #6f6e76', 
             'bleu_roi   | (bleu-roi) | #2e4ca6', 
             'rouge      | (rouge) | #c62827', 
             'bordeaux   | (bordeaux) | #630017', 
             'vert       | (vert) | #525159',  
             'kaki       | (kaki) | #cab491', 
             'brun       | (brun) | #45241b', 
             'marine     | (marine) | #01061c', 
             'noir       | (noir) | #000000', 
             'gris_fonce | (gris-fonce) | #41403e',              
                        );          
	$file_names   = array(
            'name', 'name', 'name', 'name', 'name', 'name', 'xxx' , 'name', 'name', 'name'    );
        //----------------------        
        
        $active_colors_array [1] = array(
            'colors' => $coul_acc_ecu_et_sac,
            'names'  => $file_names,
            'uid'    => 'x3'                 
        );
        
        //----------------------------------------------------------------couleurs nid abeille KEY->2
        //i18n
        $coul_nid_abeille = array(
            
            $trans->translate('bordeaux'   , 'both') . ' | (bordeaux) | #572033',             
            $trans->translate('blanc'     , 'both') . ' | (blanc) | white', 
            $trans->translate('brun'      , 'both') . ' | (brun) | #45241b', 
            $trans->translate('gris_fonce', 'both') . ' | (gris-fonce) | #41403e',            
            $trans->translate('vert_fonce', 'both') . ' | (vert-fonce) | #36404c', 
            $trans->translate('marine'    , 'both') . ' | (marine) | #01061c',             
            $trans->translate('mauve'     , 'both') . ' | (mauve) | #744c57',  
            $trans->translate('noir'      , 'both') . ' | (noir) | #000000',                          
                        );        
        $coul_nid_abeille = array(
            
            'bordeaux   | (bordeaux) | #572033',             
            'blanc      | (blanc) | white', 
            'brun       | (brun) | #45241b', 
            'gris_fonce | (gris-fonce) | #41403e',            
            'vert_fonce | (vert-fonce) | #36404c', 
            'marine     | (marine) | #01061c',             
            'mauve      | (mauve) | #744c57',  
            'noir       | (noir) | #000000',                          
                        );            
	$file_names   = array(
            'name', 'name', 'name', 'name', 'name', 'name', 'xxx' , 'name'   );
        //----------------------      

        $active_colors_array [2] = array(
            'colors' => $coul_nid_abeille,
            'names'  => $file_names,
            'uid'    => 'x2'                 
        );        
        
        //----------------------------------------------------------------couleurs tapis personnalisables KEY->3 ACTIF ok
        //i18n
        $coul_tapis = array(
            
            $trans->translate('bleu_ciel'  , 'both') . ' | (bleu-ciel-na1) | #D5ECF1',             
            $trans->translate('gris_clair' , 'both') . ' | (gris-clair-na2) | #F2F2F2', 
            $trans->translate('gris_fonce' , 'both') . ' | (gris-fonce) | #41403e',             
            $trans->translate('rouge'      , 'both') . ' | (rouge-na4) | #c62827',           
            //aviateur
            $trans->translate('vert_fonce' , 'both') . ' | (vert-fonce-na6) | #003300', 
            //taupe = camel
            //champagne = crème
            $trans->translate('taupe'       , 'both') . ' | (taupe-na7) | #BD9C59',             
            $trans->translate('champagne'   , 'both') . ' | (champagne-na9) | #FAF7C2',              
            $trans->translate('noir'        , 'both') . ' | (noir) | #000000',                          
            $trans->translate('bordeaux'     , 'both') . ' | (bordeaux-na11) | #572033', 
            $trans->translate('bleu_roi'    , 'both') . '| (bleu-roi-na12) | #2e4ca6', 
            //choco = brun
            $trans->translate('choco'       , 'both') . '| (brun-na14) | #663300',
            $trans->translate('marine'      , 'both') . ' | (marine-na15) | #01061c',             
            $trans->translate('gris_moyen'  , 'both') . ' | (gris-na16) | #808080',       
            $trans->translate('blanc'       , 'both') . ' | (blanc-na17) | white',             
            $trans->translate('vichy_marine', 'both') . '| (vichy) | #01061c',           
        
                        );        
        $coul_tapis = array(
            
            'bleu_ciel    | (bleu-ciel-na1) | #D5ECF1',             
            'gris_clair   | (gris-clair-na2) | #F2F2F2', 
            'gris_fonce   | (gris-fonce) | #41403e',             
            'rouge        | (rouge-na4) | #c62827',           
            //aviateur
            'vert_fonce   | (vert-fonce-na6) | #003300', 
            //taupe = camel
            //champagne = crème
            'taupe        | (taupe-na7) | #BD9C59',             
            'champagne    | (champagne-na9) | #FAF7C2',              
            'noir         | (noir) | #000000',                          
            'bordeaux     | (bordeaux-na11) | #572033', 
            'bleu_roi     | (bleu-roi-na12) | #2e4ca6', 
            //choco = brun
            'choco        | (brun-na14) | #663300',
            'marine       | (marine-na15) | #01061c',             
            'gris_moyen   | (gris-na16) | #808080',       
            'blanc        | (blanc-na17) | white',             
            'vichy_marine | (vichy) | #01061c',           
        
                        );         
	$file_names   = array(
            'actif', 'couleurs tapis personnalisables KEY->3', 'name', 'name', 'name', 'name', 'xxx' , 'name', 'name', 'name', 'name', 'name', 'name', 'xxx' , 'name'   );        
        
        $active_colors_array [3] = array(
            'colors' => $coul_tapis,
            'names'  => $file_names,
            'uid'    => 'ctp'                 
        );  
        //----------------------  
        
        //----------------------------------------------------------------veneto KEY->4 ACTIF ok
        //i18n
        $couleurs = array(
            
            $trans->translate('gris_fonce'  , 'both') . ' | (gris-fonce) | #41403e', 
            $trans->translate('marine_fonce', 'both') . ' | (marine) | #000523', 
            $trans->translate('noir'        , 'both') . ' | (noir) | #000000',                         
                        );      
        $couleurs = array(
            
            'gris_fonce   | (gris-fonce) | #41403e', 
            'marine_fonce | (marine) | #000523', 
            'noir         | (noir) | #000000',                         
                        );         
	$file_names   = array(
            'actif', 'veneto KEY->4', 'name'  );           
        
        $active_colors_array [4] = array(
            'colors' => $couleurs,
            'names'  => $file_names,
            'uid'    => 'v'             
        );  
        //---------------------- 
           
        //----------------------------------------------------------------couleurs ceintures elastiques KEY->5 ACTIF ok
        //i18n
        $couleurs = array(//noir-/blanc-/marine-/gris-/marron-/fushia/rouge-
            
            $trans->translate('gris', 'both') . ' | (gris) | #41403e', 
            //'Marine Fonce/Marine Fonce | (marine) | #000523', 
            $trans->translate('noir', 'both') . ' | (noir) | #000000',  
            $trans->translate('blanc', 'both') . ' | (gris-clair) | #FFFFFF', 
            $trans->translate('rouge', 'both') . '| (rouge) | #c62827', 
            //'Bordeaux/Bordeaux | (bordeaux) | #630017', 
            //'Vert/Green | (vert) | #525159',  
            //'Kaki/Kaki | (kaki) | #cab491', 
            $trans->translate('fushia', 'both') . ' | (fushia) | #e14d9b',             
            $trans->translate('marron', 'both') . '| (brun) | #45241b', 
            $trans->translate('marine', 'both') . ' | (marine) | #01061c', 
            //'Noir/Zwart | (noir) | #000000', 
            //'Gris foncé/Dark grij | (gris-fonce) | #41403e',              
                        );        
        $couleurs = array(//noir-/blanc-/marine-/gris-/marron-/fushia/rouge-
            
            'gris  | (gris) | #41403e', 
            //'Marine Fonce/Marine Fonce | (marine) | #000523', 
            'noir  | (noir) | #000000',  
            'blanc | (gris-clair) | #FFFFFF', 
            'rouge | (rouge) | #c62827', 
            //'Bordeaux/Bordeaux | (bordeaux) | #630017', 
            //'Vert/Green | (vert) | #525159',  
            //'Kaki/Kaki | (kaki) | #cab491', 
            'fushia | (fushia) | #e14d9b',             
            'marron | (brun) | #45241b', 
            'marine | (marine) | #01061c', 
            //'Noir/Zwart | (noir) | #000000', 
            //'Gris foncé/Dark grij | (gris-fonce) | #41403e',              
                        );         
	$file_names   = array(
            'actif', 'couleurs ceintures elastiques KEY->5', 'name' ,'name', 'name', 'name', 'name'  );           
        
        $active_colors_array [5] = array(
            'colors' => $couleurs,
            'names'  => $file_names,
            'uid'    => 'ccelast'                 
        );  
        //----------------------   

        //----------------------------------------------------------------couleurs sac neop non perso KEY->6 ACTIF ok
        //i18n
        $couleurs = array(//noir/gris fonce/
            
            $trans->translate('gris_fonce', 'both') . ' | (gris-fonce) | #41403e', 
            //'Marine Fonce/Marine Fonce | (marine) | #000523', 
            $trans->translate('noir'      , 'both') . ' | (noir) | #000000',                         
                        );        
        $couleurs = array(//noir/gris fonce/
            
            'gris_fonce | (gris-fonce) | #41403e', 
            //'Marine Fonce/Marine Fonce | (marine) | #000523', 
            'noir | (noir) | #000000',                         
                        );          
	$file_names   = array(
            'actif', 'couleurs sac neop non perso KEY->6'  );           
        
        $active_colors_array [6] = array(
            'colors' => $couleurs,
            'names'  => $file_names,
            'uid'    => 'csnnp'                 
        );  
        //----------------------           
        
        
        //----------------------------------------------------------------couleurs acc ecurie personnalisables KEY->7 ----------TO DO        
        //i18n
        $couleurs = array(
            $trans->translate('gris_clair', 'both') . ' | (gris-clair) | #6f6e76', 
            $trans->translate('rouge'     , 'both') . ' | (rouge) | #c62827', 
            $trans->translate('bordeaux'   , 'both') . ' | (bordeaux) | #630017', 
            $trans->translate('vert'      , 'both') . ' | (vert) | #525159',  
            $trans->translate('kaki'      , 'both') . ' | (kaki) | #cab491', 
            $trans->translate('brun'      , 'both') . ' | (brun) | #45241b', 
            $trans->translate('marine'     , 'both') . ' | (marine) | #01061c', 
            $trans->translate('noir'      , 'both') . ' | (noir) | #000000', 
            $trans->translate('gris_fonce', 'both') . ' | (gris-fonce) | #41403e',              
                        );        
        $couleurs = array(
            'gris_clair | (gris-clair) | #6f6e76', 
            'rouge      | (rouge) | #c62827', 
            'bordeaux   | (bordeaux) | #630017', 
            'vert       | (vert) | #525159',  
            'kaki       | (kaki) | #cab491', 
            'brun       | (brun) | #45241b', 
            'marine     | (marine) | #01061c', 
            'noir       | (noir) | #000000', 
            'gris_fonce | (gris-fonce) | #41403e',              
                        );         
	$file_names   = array(
            'name', 'name', 'name', 'name', 'name', 'name', 'xxx' , 'name', 'name'   );
        $active_colors_array [7] = array(
            'colors' => $couleurs,
            'names'  => $file_names,
            'uid'    => 'x1'             
        );          
        //----------------------          
        

        //----------------------------------------------------------------couleurs acc chev personnalisables KEY->8 ACTIF ok
        //                                                                    licol pure laine
        //i18n
        $couleurs = array( // Marine-/Noir-/Choco-/Vert foncé-/Bordeaux-/Gris-/Taupe-
            //'Gris clair/Gris clair | (gris-clair) | #6f6e76', 
            //'Rouge/Red | (rouge) | #c62827', 
            $trans->translate('bordeaux'   , 'both') . ' | (bordeaux) | #630017', 
            $trans->translate('vert_fonce', 'both')  . ' | (vert-fonce) | #0C420F',  
            //'Kaki/Kaki | (kaki) | #cab491', 
            //'Brun/Brun| (brun) | #45241b', 
            $trans->translate('choco'     , 'both') . ' | (brun) | #663300',            
            $trans->translate('marine'    , 'both') . ' | (marine) | #01061c', 
            $trans->translate('noir'      , 'both') . ' | (noir) | #000000', 
            $trans->translate('gris_fonce', 'both') . ' | (gris-fonce) | #41403e',     
            $trans->translate('taupe'     , 'both') . ' | (taupe) | #BD9C59',            
                        );        
        $couleurs = array( // Marine-/Noir-/Choco-/Vert foncé-/Bordeaux-/Gris-/Taupe-
            //'Gris clair/Gris clair | (gris-clair) | #6f6e76', 
            //'Rouge/Red | (rouge) | #c62827', 
            'bordeaux   | (bordeaux) | #630017', 
            'vert_fonce | (vert-fonce) | #0C420F',  
            //'Kaki/Kaki | (kaki) | #cab491', 
            //'Brun/Brun| (brun) | #45241b', 
            'choco      | (brun) | #663300',            
            'marine     | (marine) | #01061c', 
            'noir       | (noir) | #000000', 
            'gris_fonce | (gris-fonce) | #41403e',     
            'taupe      | (taupe) | #BD9C59',            
                        );        
	$file_names   = array(
            'actif', 'couleurs acc chev personnalisables KEY->8 (licol pure laine)', 'name', 'name', 'name', 'name', 'name'   );
        
        $active_colors_array [8] = array(
            'colors' => $couleurs,
            'names'  => $file_names,
            'uid'    => 'cacp'             
        );          
        //---------------------- 

        //----------------------------------------------------------------couleurs bonnets personnalisables KEY->9 ACTIF ok
        //i18n
        $couleurs = array(//Marine-/Noir-/Chocolat-/Gris foncé-/Gris-/Bordeaux-/Rouge-/Vert foncé-/Kaki-
            
            $trans->translate('bleu_ciel'      , 'both') . ' | (bleu-ciel-na1) | #D5ECF1',             
            $trans->translate('gris_clair'     , 'both') . ' | (gris-clair-na2) | #F2F2F2', 
            $trans->translate('gris_fonce'     , 'both') . ' | (gris-fonce) | #41403e',             
            $trans->translate('rouge'          , 'both') . ' | (rouge-na4) | #c62827',           
            //aviateur
            $trans->translate('vert_fonce'     , 'both') . ' | (vert-fonce-na6) | #003300', 
            //taupe = camel
            //champagne = crème
            $trans->translate('taupe'          , 'both') . ' | (taupe-na7) | #BD9C59',             
            $trans->translate('champagne'      , 'both') . ' | (champagne-na9) | #FAF7C2',              
            $trans->translate('noir'           , 'both') . ' | (noir) | #000000',                          
            $trans->translate('bordeaux'        , 'both') . ' | (bordeaux-na11) | #572033', 
            $trans->translate('bleu_roi'       , 'both') . ' | (bleu-roi-na12) | #2e4ca6', 
            //choco = brun
            $trans->translate('choco'       , 'both') . ' | (brun-na14) | #663300',
            $trans->translate('marine'      , 'both') . ' | (marine-na15) | #01061c',             
            $trans->translate('gris_moyen'  , 'both') . ' | (gris-na16) | #808080',       
            $trans->translate('blanc'       , 'both') . ' | (blanc-na17) | white',             
            $trans->translate('vichy_marine', 'both') . ' | (vichy) | #01061c',           
        
                        );        
        $couleurs = array(//Marine-/Noir-/Chocolat-/Gris foncé-/Gris-/Bordeaux-/Rouge-/Vert foncé-/Kaki-
            
            'bleu_ciel  | (bleu-ciel-na1) | #D5ECF1',             
            'gris_clair | (gris-clair-na2) | #F2F2F2', 
            'gris_fonce | (gris-fonce) | #41403e',             
            'rouge      | (rouge-na4) | #c62827',           
            //aviateur
            'vert_fonce | (vert-fonce-na6) | #003300', 
            //taupe = camel
            //champagne = crème
            'taupe      | (taupe-na7) | #BD9C59',             
            'champagne  | (champagne-na9) | #FAF7C2',              
            'noir       | (noir) | #000000',                          
            'bordeaux   | (bordeaux-na11) | #572033', 
            'bleu_roi   | (bleu-roi-na12) | #2e4ca6', 
            //choco = brun
            'choco      | (brun-na14) | #663300',
            'marine     | (marine-na15) | #01061c',             
            'gris_moyen | (gris-na16) | #808080',       
            'blanc      | (blanc-na17) | white',             
            'vichy_marine | (vichy) | #01061c',           
        
                        );         
	$file_names   = array(
            'actif', 'couleurs bonnets personnalisables KEY->9', 'name', 'name', 'name', 'name', 'name', 'xxx' , 'name' , 'name' 
            , 'name' , 'name' , 'name' , 'name' , 'name' );        
        
        $active_colors_array [9] = array(
            'colors' => $couleurs,
            'names'  => $file_names,
            'uid'    => 'cbperso'             
        );         
        //----------------------  
        
        //----------------------------------------------------------------couleurs amortisseur gel KEY->10 ----------TO DO
        //i18n
        $couleurs = array(// Noir-/Marine-/Choco-/Bleu roi-/Blanc-
            
            //'Gris foncé/Dark grij | (gris-fonce) | #41403e', 
            $trans->translate('marine'     , 'both') . ' | (marine) | #01061c',
            $trans->translate('brun'       , 'both') . ' | (brun-na14) | #663300',            
            $trans->translate('noir'       , 'both') . ' | (noir) | #000000',                 
            $trans->translate('blanc'      , 'both') . ' | (blanc) | #FFFFFF', 
            $trans->translate('bleu_roi'   , 'both') . ' | (bleu-roi-na12) | #2e4ca6',             
                        );        
        $couleurs = array(// Noir-/Marine-/Choco-/Bleu roi-/Blanc-
            
            //'Gris foncé/Dark grij | (gris-fonce) | #41403e', 
            'marine   | (marine) | #01061c',
            'brun     | (brun-na14) | #663300',            
            'noir     | (noir) | #000000',                 
            'blanc    | (blanc) | #FFFFFF', 
            'bleu_roi | (bleu-roi-na12) | #2e4ca6',             
                        );           
	$file_names   = array(
            'name', 'name', 'name', 'name', 'name'  );           
        
        $active_colors_array [10] = array(
            'colors' => $couleurs,
            'names'  => $file_names,
            'uid'    => 'cag'                 
        );  
        //----------------------           
        
        //----------------------------------------------------------------couleurs chemise ete perso -> ete filet KEY->11 ACTIF ok
        //i18n
        $couleurs = array(//Marine/Blanc/Noir/Gris
            
            $trans->translate('gris'      , 'both') . ' | (gris) | #F2F2F2', 
            $trans->translate('blanc'     , 'both') . ' | (blanc) | #FFFFFF',            
            $trans->translate('marine'    , 'both') . ' | (marine) | #01061c',
            $trans->translate('noir'      , 'both') . ' | (noir) | #000000',                         
                        );     
        $couleurs = array(//Marine/Blanc/Noir/Gris
            
            'gris   | (gris) | #F2F2F2', 
            'blanc  | (blanc) | #FFFFFF',            
            'marine | (marine) | #01061c',
            'noir   | (noir) | #000000',                         
                        );         
	$file_names   = array(
            'actif', 'couleurs chemise ete perso -> ete filet KEY->11', 'name', 'name'   );           
        
        $active_colors_array [11] = array(
            'colors' => $couleurs,
            'names'  => $file_names,
            'uid'    => 'ccepef'                 
        );  
        //----------------------           
        
        
        //----------------------------------------------------------------couleurs chemise ete perso -> ete filet + nid abei KEY->12 ACIF ok
        //i18n
        $couleurs = array(//Marine/Blanc/Noir/Gris
            
            $trans->translate('gris'       , 'both') . ' | (gris) | #F2F2F2', 
            $trans->translate('blanc'      , 'both') . ' | (blanc) | #FFFFFF',            
            $trans->translate('marine'     , 'both') . ' | (marine) | #01061c',
            $trans->translate('noir'       , 'both') . ' | (noir) | #000000',                         
                        );     
        $couleurs = array(//Marine/Blanc/Noir/Gris
            
            'gris   | (gris) | #F2F2F2', 
            'blanc  | (blanc) | #FFFFFF',            
            'marine | (marine) | #01061c',
            'noir   | (noir) | #000000',                         
                        );         
	$file_names   = array(
            'actif', 'couleurs chemise ete perso -> ete filet + nid abei KEY->12', 'name', 'name'   );           
        
        $active_colors_array [12] = array(
            'colors' => $couleurs,
            'names'  => $file_names,
            'uid'    => 'ccepefna' 
        ); 
        //----------------------          
        
        //----------------------------------------------------------------couleurs chemise ete perso -> nid abei KEY->13 ACTIF ok
        //i18n
        $couleurs = array(//Marine-/Choco-/Blanc-/Noir-/Gris-/Vert foncé-/Bordeaux-
            
            $trans->translate('gris'      , 'both') . ' | (gris) | #F2F2F2', 
            $trans->translate('blanc'     , 'both') . ' | (blanc) | #FFFFFF',            
            $trans->translate('marine'    , 'both') . ' | (marine) | #01061c',
            $trans->translate('noir'      , 'both') . ' | (noir) | #000000',     
            $trans->translate('choco'     , 'both') . ' | (brun-na14) | #663300',       
            $trans->translate('vert_fonce', 'both') . ' | (vert-fonce-na6) | #003300',             
            $trans->translate('bordeaux'   , 'both') . ' | (bordeaux) | #572033',             
                        );        
        $couleurs = array(//Marine-/Choco-/Blanc-/Noir-/Gris-/Vert foncé-/Bordeaux-
            
            'gris   | (gris) | #F2F2F2', 
            'blanc  | (blanc) | #FFFFFF',            
            'marine | (marine) | #01061c',
            'noir   | (noir) | #000000',     
            'choco  | (brun-na14) | #663300',       
            'vert_fonce | (vert-fonce-na6) | #003300',             
            'bordeaux   | (bordeaux) | #572033',             
                        );         
	$file_names   = array(
            'actif', 'couleurs chemise ete perso -> nid abei KEY->13', 'name', 'name', 'name', 'name', 'name'  );           
        
        $active_colors_array [13] = array(
            'colors' => $couleurs,
            'names'  => $file_names,
            'uid'    => 'ccepna'                 
        );  
        //----------------------          
                
        //----------------------------------------------------------------couleurs couvre reins pol venet KEY->14 ACTIF ok
        //i18n
        $couleurs = array(//Marine/Noir/Gris
            
            $trans->translate('gris'     , 'both') . ' | (gris) | #F2F2F2', 
            $trans->translate('marine'   , 'both') . ' | (marine) | #01061c',
            $trans->translate('noir'     , 'both') . ' | (noir) | #000000',                         
                        );        
        $couleurs = array(//Marine/Noir/Gris
            
            'gris   | (gris) | #F2F2F2', 
            'marine | (marine) | #01061c',
            'noir   | (noir) | #000000',                         
                        );        
	$file_names   = array(
            'actif', 'couleurs couvre reins pol venet KEY->14', 'name'  );           
        
        $active_colors_array [14] = array(
            'colors' => $couleurs,
            'names'  => $file_names,
            'uid'    => 'ccrpv'                 
        );  
        //----------------------          
        
        
        //----------------------------------------------------------------couleurs coton americain perso set de 4 KEY->15 ACTIF ok
        //i18n
        $couleurs = array(// Marine-/Gris clair-/Gris moyen-/Gris foncé-/Blanc-/Noir-/Crème-/Taupe-/-Vert foncé/-Chocolat/Vichy marine-/Bordeaux-/Rouge-
            
            //'Bleu ciel/Bleu ciel | (bleu-ciel-na1) | #D5ECF1',             
            $trans->translate('gris_clair'     , 'both') . ' | (gris-clair) | #F2F2F2 ',             
            $trans->translate('gris_moyen'     , 'both') . ' | (gris) | #6f6e76',             
            $trans->translate('gris_fonce'     , 'both') . ' | (gris-fonce) | #41403e',             
            $trans->translate('rouge'          , 'both') . ' | (rouge-na4) | #c62827',           
            //aviateur
            $trans->translate('vert_fonce'     , 'both') . ' | (vert-fonce-na6) | #003300', 
            //taupe = camel
            //champagne = crème
            $trans->translate('taupe'      , 'both') . ' | (taupe) | #BD9C59',             
            $trans->translate('creme'      , 'both') . ' | (creme) | #FAF7C2',              
            $trans->translate('noir'       , 'both') . ' | (noir) | #000000',                          
            $trans->translate('bordeaux'    , 'both') . ' | (bordeaux-na11) | #572033', 
            //'Bleu roi/Bleu roi| (bleu-roi-na12) | #2e4ca6', 
            //choco = brun
            $trans->translate('choco'       , 'both') . ' | (chocolat) | #663300',
            $trans->translate('marine'      , 'both') . ' | (marine) | #01061c',             
            //'Gris moyen/Grij | (gris-na16) | #808080',       
            $trans->translate('blanc'       , 'both') . ' | (blanc) | white',             
            $trans->translate('vichy_marine', 'both') . ' | (vichy) | #01061c',        
            //'Kaki/Kaki | (kaki) | #cab491',                     
                        );        
        $couleurs = array(// Marine-/Gris clair-/Gris moyen-/Gris foncé-/Blanc-/Noir-/Crème-/Taupe-/-Vert foncé/-Chocolat/Vichy marine-/Bordeaux-/Rouge-
            
            //'Bleu ciel/Bleu ciel | (bleu-ciel-na1) | #D5ECF1',             
            'gris_clair | (gris-clair) | #F2F2F2 ',             
            'gris_moyen | (gris) | #6f6e76',             
            'gris_fonce | (gris-fonce) | #41403e',             
            'rouge       | (rouge-na4) | #c62827',           
            //aviateur
            'vert_fonce | (vert-fonce-na6) | #003300', 
            //taupe = camel
            //champagne = crème
            'taupe      | (taupe) | #BD9C59',             
            'creme      | (creme) | #FAF7C2',              
            'noir       | (noir) | #000000',                          
            'bordeaux   | (bordeaux-na11) | #572033', 
            //'Bleu roi/Bleu roi| (bleu-roi-na12) | #2e4ca6', 
            //choco = brun
            'choco      | (chocolat) | #663300',
            'marine     | (marine) | #01061c',             
            //'Gris moyen/Grij | (gris-na16) | #808080',       
            'blanc        | (blanc) | white',             
            'vichy_marine | (vichy) | #01061c',        
            //'Kaki/Kaki | (kaki) | #cab491',                     
                        );        
	$file_names   = array(
            'actif', 'couleurs coton americain perso set de 4 KEY->15', 'name', 'name', 'name', 'name', 'name', 'name', 'name', 'name', 'name', 'name', 'name'  );           
        
        $active_colors_array [15] = array(
            'colors' => $couleurs,
            'names'  => $file_names,
            'uid'    => 'ccapsdq'             
        );  
        //----------------------             

        
        //----------------------------------------------------------------couleurs set bandage polo par set de 2 KEY->16 ACTIF ok
        //i18n
        $couleurs = array(// Marine-/Gris-/Noir-/Chocolat-/Blanc-/Taupe-
            
            //'Bleu ciel/Bleu ciel | (bleu-ciel-na1) | #D5ECF1',             
            $trans->translate('gris'     , 'both') . ' | (gris) | #F2F2F2', 
            //'Gris clair/Gris clair | (gris-clair) | #6f6e76',             
            //'Gris foncé/Dark grij | (gris-fonce) | #41403e',             
            //'Rouge/Red | (rouge-na4) | #c62827',           
            //aviateur
            //'Vert foncé/Dark groen | (vert-fonce-na6) | #003300', 
            //taupe = camel
            //champagne = crème
            $trans->translate('taupe'     , 'both') . ' | (taupe) | #BD9C59',             
            //'Crème/Creme | (creme) | #FAF7C2',              
            $trans->translate('noir'      , 'both') . ' | (noir) | #000000',                          
            //'Bordeaux/Bordeaux | (bordeaux-na11) | #572033', 
            //'Bleu roi/Bleu roi| (bleu-roi-na12) | #2e4ca6', 
            //choco = brun
            $trans->translate('choco'     , 'both') . '| (chocolat) | #663300',
            $trans->translate('marine'    , 'both') . ' | (marine) | #01061c',             
            //'Gris moyen/Grij | (gris-na16) | #808080',       
            $trans->translate('blanc'     , 'both') . ' | (blanc) | white',             
            //'Vichy marine/Vichy marine| (vichy) | #01061c',        
            //'Kaki/Kaki | (kaki) | #cab491',                          
                        );        
        $couleurs = array(// Marine-/Gris-/Noir-/Chocolat-/Blanc-/Taupe-
            
            //'Bleu ciel/Bleu ciel | (bleu-ciel-na1) | #D5ECF1',             
            'gris | (gris) | #F2F2F2', 
            //'Gris clair/Gris clair | (gris-clair) | #6f6e76',             
            //'Gris foncé/Dark grij | (gris-fonce) | #41403e',             
            //'Rouge/Red | (rouge-na4) | #c62827',           
            //aviateur
            //'Vert foncé/Dark groen | (vert-fonce-na6) | #003300', 
            //taupe = camel
            //champagne = crème
            'taupe | (taupe) | #BD9C59',             
            //'Crème/Creme | (creme) | #FAF7C2',              
            'noir  | (noir) | #000000',                          
            //'Bordeaux/Bordeaux | (bordeaux-na11) | #572033', 
            //'Bleu roi/Bleu roi| (bleu-roi-na12) | #2e4ca6', 
            //choco = brun
            'choco| (chocolat) | #663300',
            'marine | (marine) | #01061c',             
            //'Gris moyen/Grij | (gris-na16) | #808080',       
            'blanc  | (blanc) | white',             
            //'Vichy marine/Vichy marine| (vichy) | #01061c',        
            //'Kaki/Kaki | (kaki) | #cab491',                          
                        );          
	$file_names   = array(
            'actif', 'couleurs set bandage polo par set de 2 KEY->16', 'name', 'name', 'name', 'name'   );           
        
        $active_colors_array [16] = array(
            'colors' => $couleurs,
            'names'  => $file_names,
            'uid'    => 'csbppsdd' ,                
        );  
        //----------------------           
        
        
        //----------------------------------------------------------------couleurs sac perso KEY->17 ACTIF ok
        //i18n
        $couleurs = array(
            // Marine-/Noir-/Chocolat-/Gris foncé-/Gris-/Bordeaux-/Rouge-/Vert foncé-/Kaki-
            
            //'Gris clair/Gris clair | (gris-clair) | #6f6e76', 
            $trans->translate('gris'      , 'both') . ' | (gris) | #F2F2F2',             
            //'Bleu roi/Bleu roi| (bleu-roi) | #2e4ca6', 
            $trans->translate('rouge'     , 'both') . ' | (rouge) | #c62827', 
            $trans->translate('bordeaux'  , 'both') . ' | (bordeaux) | #630017', 
            //'Vert/Green | (vert) | #525159',  
            $trans->translate('vert_fonce', 'both') . ' | (vert-fonce-na6) | #003300',             
            $trans->translate('kaki'      , 'both') . ' | (kaki) | #cab491', 
            $trans->translate('chocolat'  , 'both') . ' | (brun) | #45241b', 
            $trans->translate('marine'    , 'both') . ' | (marine) | #01061c',
            $trans->translate('noir'      , 'both') . ' | (noir) | #000000', 
            $trans->translate('gris_fonce', 'both') . ' | (gris-fonce) | #41403e',     
            $trans->translate('bleu_roi'  , 'both') . ' | (bleu-roi-na12) | #2e4ca6',             
        
                        );        
        $couleurs = array(
            // Marine-/Noir-/Chocolat-/Gris foncé-/Gris-/Bordeaux-/Rouge-/Vert foncé-/Kaki-
            
            //'Gris clair/Gris clair | (gris-clair) | #6f6e76', 
            'gris     | (gris) | #F2F2F2',             
            //'Bleu roi/Bleu roi| (bleu-roi) | #2e4ca6', 
            'rouge    | (rouge) | #c62827', 
            'bordeaux | (bordeaux) | #630017', 
            //'Vert/Green | (vert) | #525159',  
            'vert_fonce | (vert-fonce-na6) | #003300',             
            'kaki       | (kaki) | #cab491', 
            'chocolat   | (brun) | #45241b', 
            'marine     | (marine) | #01061c',
            'noir       | (noir) | #000000', 
            'gris_fonce | (gris-fonce) | #41403e',     
            'bleu_roi   | (bleu-roi-na12) | #2e4ca6',             
        
                        );         
	$file_names   = array(
            'actif', 'couleurs sac perso KEY->17', 'name', 'name', 'name', 'name', 'xxx' , 'name', 'name' , 'name'  );        
        
        $active_colors_array [17] = array(
            'colors' => $couleurs,
            'names'  => $file_names,
            'uid'    => 'csp'      ,           
        );  
        //----------------------          
        
        //----------------------------------------------------------------couleurs chemise de box en coton resistant KEY->18 ACTIF ok
        //i18n
        $couleurs = array(
            // Marine/Gris/Rouge/Bleu
            
            $trans->translate('bleu'  , 'both') . ' | (bleu) | #D5ECF1',             
            //'Gris clair/Gris clair | (gris-clair-na2) | #F2F2F2', 
            //'Gris foncé/Dark grij | (gris-fonce) | #41403e',             
            $trans->translate('rouge'  , 'both') . ' | (rouge) | #c62827',           
            //aviateur
            //'Vert foncé/DArk groen | (vert-fonce-na6) | #003300', 
            //taupe = camel
            //champagne = crème
            //'Taupe/Taupe | (taupe-na7) | #BD9C59',             
            //'Champagne/Champagne | (champagne-na9) | #FAF7C2',              
            //'Noir/Zwart | (noir) | #000000',                          
            //'Bordeaux/Bordeaux | (bordeaux-na11) | #572033', 
            //'Bleu roi/Bleu roi| (bleu-roi-na12) | #2e4ca6', 
            //choco = brun
            //'Choco/Choco| (brun-na14) | #663300',
            $trans->translate('marine'  , 'both') . ' | (marine) | #01061c',             
            $trans->translate('gris'    , 'both') . ' | (gris) | #808080',       
            //'Blanc/Witte | (blanc-na17) | white',             
            //'Vichy marine/Vichy marine| (vichy) | #01061c',           
        
                        );        
        $couleurs = array(
            // Marine/Gris/Rouge/Bleu
            
            'bleu  | (bleu) | #D5ECF1',             
            //'Gris clair/Gris clair | (gris-clair-na2) | #F2F2F2', 
            //'Gris foncé/Dark grij | (gris-fonce) | #41403e',             
            'rouge | (rouge) | #c62827',           
            //aviateur
            //'Vert foncé/DArk groen | (vert-fonce-na6) | #003300', 
            //taupe = camel
            //champagne = crème
            //'Taupe/Taupe | (taupe-na7) | #BD9C59',             
            //'Champagne/Champagne | (champagne-na9) | #FAF7C2',              
            //'Noir/Zwart | (noir) | #000000',                          
            //'Bordeaux/Bordeaux | (bordeaux-na11) | #572033', 
            //'Bleu roi/Bleu roi| (bleu-roi-na12) | #2e4ca6', 
            //choco = brun
            //'Choco/Choco| (brun-na14) | #663300',
            'marine | (marine) | #01061c',             
            'gris   | (gris) | #808080',       
            //'Blanc/Witte | (blanc-na17) | white',             
            //'Vichy marine/Vichy marine| (vichy) | #01061c',           
        
                        );          
	$file_names   = array(
            'actif', 'couleurs chemise de box en coton resistant KEY->18', 'name', 'name' );        
        
        $active_colors_array [18] = array(
            'colors' => $couleurs,
            'names'  => $file_names,
            'uid'    => 'ccbcr'    ,            
        );  
        //----------------------                   

        //------------------------color data to generate
        //
        // Keys
        /*
            couleurs access ecurie et sac   KEY->1
            couleurs nid abeille            KEY->2
            couleurs tapis personnalisables KEY->3 ACTIF ok
            veneto                          KEY->4 ACTIF ok
            couleurs ceintures elastiques   KEY->5 ACTIF ok
            couleurs sac neop non perso     KEY->6 ACTIF ok
            couleurs acc ecurie personnalisables KEY->7
            couleurs acc chev personnalisables   KEY->8 ACTIF ok
            couleurs bonnets personnalisables    KEY->9 ACTIF ok
            couleurs amortisseur gel             KEY->10
            couleurs chemise ete perso -> ete filet            KEY->11
            couleurs chemise ete perso -> ete filet + nid abei KEY->12
            couleurs chemise ete perso -> nid abei  KEY->13
            couleurs couvre reins pol venet         KEY->14
            couleurs coton americain perso set de 4 KEY->15
            couleurs set bandage polo par set de 2  KEY->16
            couleurs sac perso                         KEY->17
            couleurs chemise de box en coton resistant KEY->18
        */
        
        /*
         * !!! SELECT HERE WITH '$key' THE PRODUCT TO BUILD !!! 
         * 
         * KEY_SELECTION_COLOR_FLAG
         */
        $key = 3;
        
	$file_content = $active_colors_array[$key]['colors'];
	$file_names   = $active_colors_array[$key]['names'];
        $salt         = $active_colors_array[$key]['uid'];
        echo "<h3>CURRENT PRODUCT {$file_names[1]}  ID: $salt  </h3><br />";
        //------------------------
	
	/*
	//dir content
	$dir_uri = '/var/www/test/equi-moulinette/data/files-colors/.';
	$file_names = $filemanager->getFileNames($dir_uri);
	//echo '<pre>';
	//var_dump($file_names); 

	//file content
	$file_uri = '/var/www/test/equi-moulinette/data/colors-label-names.txt';
	$file_content = $filemanager->getFileContent($file_uri, 'COLOR');

	//var_dump($file_content); die();
        */
	/**
	 * assemble the data
	*/

	//get items manager class
	include_once 'includes/items_manager.php';

	//get instance
	//$manager = new ItemsManager();
        $manager = new ItemsManagerCalcul();
	/**
	 * HTML bordure
	*/

	//build the html list
        //$salt = substr(uniqid(), -3);
	$html = $manager->buildHtmlListElement($file_names, $file_content, 'COLOR', $salt);
        //disp($html); 
	//write the html
        //$html = 'merde';
        if($generate_new_ids)
            $filemanager->writeHtmlFile($html, 'COLOR');

	/**
	 * CSS
	*/

	//build the html list
	$html = $manager->buildCssListElement($file_names, $file_content, 'COLOR', $salt);

	//write the html
        if($generate_new_ids)
            $filemanager->writeCssFile($html, 'COLOR');
        
        //write list vals
        $tmp = $manager->listValBuilder(array($file_names,$file_content), 'COLOR');
        //disp($tmp);
        $filemanager->writelListvalFile($tmp,  FileManager::COLOR_LISTVALS_FILE_GENERATED);        
        
        
        
        //------------------------------------------build the main color test page
        if(0){
            require_once 'includes/build_color_test_page.php';
            
        }        
} // fin colors

echo('<br />Fin fichier index.php <------------------------------------------------');
















