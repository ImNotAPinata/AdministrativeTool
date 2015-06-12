<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class F_String {

    public static function getUpperStartedLowerFollowedWord($word) {
        return str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($word))));
    }

    public static function csv2array($input, $delimiter = ',', $enclosure = '"', $escape = '\\') {
        $fields = explode($enclosure . $delimiter . $enclosure, substr($input, 1, -1));
        foreach ($fields as $key => $value)
            $fields[$key] = str_replace($escape . $enclosure, $enclosure, $value);
        return($fields);
    }

    public static function strip_word_html($text, $allowed_tags = '<b><i><sup><sub><em><strong><u><br>') 
    { 
        mb_regex_encoding('UTF-8'); 
        //replace MS special characters first 
        $search = array('/&lsquo;/u', '/&rsquo;/u', '/&ldquo;/u', '/&rdquo;/u', '/&mdash;/u'); 
        $replace = array('\'', '\'', '"', '"', '-'); 
        $text = preg_replace($search, $replace, $text); 
        //make sure _all_ html entities are converted to the plain ascii equivalents - it appears 
        //in some MS headers, some html entities are encoded and some aren't 
        $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8'); 
        //try to strip out any C style comments first, since these, embedded in html comments, seem to 
        //prevent strip_tags from removing html comments (MS Word introduced combination) 
        if(mb_stripos($text, '/*') !== FALSE){ 
            $text = mb_eregi_replace('#/\*.*?\*/#s', '', $text, 'm'); 
        } 
        //introduce a space into any arithmetic expressions that could be caught by strip_tags so that they won't be 
        //'<1' becomes '< 1'(note: somewhat application specific) 
        $text = preg_replace(array('/<([0-9]+)/'), array('< $1'), $text); 
        $text = strip_tags($text, $allowed_tags); 
        //eliminate extraneous whitespace from start and end of line, or anywhere there are two or more spaces, convert it to one 
        $text = preg_replace(array('/^\s\s+/', '/\s\s+$/', '/\s\s+/u'), array('', '', ' '), $text); 
        //strip out inline css and simplify style tags 
        $search = array('#<(strong|b)[^>]*>(.*?)</(strong|b)>#isu', '#<(em|i)[^>]*>(.*?)</(em|i)>#isu', '#<u[^>]*>(.*?)</u>#isu'); 
        $replace = array('<b>$2</b>', '<i>$2</i>', '<u>$1</u>'); 
        $text = preg_replace($search, $replace, $text); 
        //on some of the ?newer MS Word exports, where you get conditionals of the form 'if gte mso 9', etc., it appears 
        //that whatever is in one of the html comments prevents strip_tags from eradicating the html comment that contains 
        //some MS Style Definitions - this last bit gets rid of any leftover comments */ 
        $num_matches = preg_match_all("/\<!--/u", $text, $matches); 
        if($num_matches){ 
              $text = preg_replace('/\<!--(.)*--\>/isu', '', $text); 
        } 
        return $text; 
    } 
    
    public static function html2txt($document) {
        $search = array('@<script[^>]*?>.*?</script>@si', // Strip out javascript 
            '@<[\/\!]*?[^<>]*?>@si', // Strip out HTML tags 
            '@<style[^>]*?>.*?</style>@siU', // Strip style tags properly 
            '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments including CDATA 
        );
        $text = preg_replace($search, '', $document);
        return $text;
    }


}

?>
