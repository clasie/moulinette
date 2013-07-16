<?php
/*
echo '<pre>';
print_r($active_colors_array);
echo '</pre>';

    [3] => Array
        (
            [colors] => Array
                (
                    [0] => Bleu ciel/Bleu ciel | (bleu-ciel-na1) | #D5ECF1
                    [1] => Gris clair/Gris clair | (gris-clair-na2) | #F2F2F2
                    [2] => Gris foncÃ©/Dark grij | (gris-fonce) | #41403e
                    [3] => Rouge/Red | (rouge-na4) | #c62827
                    [4] => Vert foncÃ©/DArk groen | (vert-fonce-na6) | #003300
                    [5] => Taupe/Taupe | (taupe-na7) | #BD9C59
                    [6] => Champagne/Champagne | (champagne-na9) | #FAF7C2
                    [7] => Noir/Zwart | (noir) | #000000
                    [8] => Bordeaux/Bordeaux | (bordeaux-na11) | #572033
                    [9] => Bleu roi/Bleu roi| (bleu-roi-na12) | #2e4ca6
                    [10] => Choco/Choco| (brun-na14) | #663300
                    [11] => Marine/Marine | (marine-na15) | #01061c
                    [12] => Gris moyen/Grij | (gris-na16) | #808080
                    [13] => Blanc/Witte | (blanc-na17) | white
                    [14] => Vichy marine/Vichy marine| (vichy) | #01061c
                )

            [names] => Array
                (
                    [0] => actif
                    [1] => couleurs tapis personnalisables KEY->3
                    [2] => name
                    [3] => name
                    [4] => name
                    [5] => name
                    [6] => xxx
                    [7] => name
                    [8] => name
                    [9] => name
                    [10] => name
                    [11] => name
                    [12] => name
                    [13] => xxx
                    [14] => name
                )

        )


*/

function getClass($string){
    $array = preg_split("/\|/", $string);
    return trim($array[2]);
}

$counter = 1;
//echo "<br /><hr >";
$temp        = '';
$counter_css = 1;

foreach($active_colors_array as $value){
    
    if('actif' == $value['names'][0]){
        
        //echo "$counter<pre>";
        //print_r($value);
        //echo '</pre>';
        //$counter++;
        
        $label = $value['names'][1];
        $temp .= " <h1><b>" . ucfirst($label) . "</b><hr></h1><br />";
        
        //echo "<pre>";
        //print_r($value);
        //echo '</pre>';                
        
        foreach($value['colors'] as $color_value){
            
            $color = getClass($color_value);
            
            $temp .= "Id: [ {$counter_css} ] " . ucfirst($color_value);
            $temp .= <<<TAG
                    <style>
                        .square_{$counter_css}{
                           width: 800px;
                           height: 40px;
                           background-color: $color;
                           border: 1px solid lightgrey;
                           margin: 10px;
                        }
                    </style>
                    <div class='square_{$counter_css}'></div>
TAG;
            //                    
            //echo "<pre>";
            //echo "$temp <br />";
            //echo '</pre>';
            $counter_css++;            
        }
        
    }
}
$headers = '
    <!DOCTYPE html>
    <!--[if IEMobile 7]><html class="iem7" lang="fr" dir="ltr"><![endif]-->
    <!--[if lte IE 6]><html class="lt-ie9 lt-ie8 lt-ie7" lang="fr" dir="ltr"><![endif]-->
    <!--[if (IE 7)&(!IEMobile)]><html class="lt-ie9 lt-ie8" lang="fr" dir="ltr"><![endif]-->
    <!--[if IE 8]><html class="lt-ie9" lang="fr" dir="ltr"><![endif]-->
    <!--[if (gte IE 9)|(gt IEMobile 7)]><!--><html lang="fr" dir="ltr" prefix="content: http://purl.org/rss/1.0/modules/content/ dc: http://purl.org/dc/terms/ foaf: http://xmlns.com/foaf/0.1/ og: http://ogp.me/ns# rdfs: http://www.w3.org/2000/01/rdf-schema# sioc: http://rdfs.org/sioc/ns# sioct: http://rdfs.org/sioc/types# skos: http://www.w3.org/2004/02/skos/core# xsd: http://www.w3.org/2001/XMLSchema#"><!--<![endif]-->
    <head>
    <meta charset="utf-8" />
    <meta name="generator" content="Drupal 7 (http://drupal.org)" />
    <meta property="dcterms.type" content="Text" />
    <meta property="dcterms.format" content="text/html" />    
    </head>
    <body>
    ';
$end ='
    </body>
    </html>
    ';

$content = $headers . $temp . $end;
file_put_contents('./html_colors_file/colors.html', $content);