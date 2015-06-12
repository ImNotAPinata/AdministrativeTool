<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class F_Array {

    public static function reordenarKeys($array) {
        if (is_array($array)) {
            $reorderarray = array();
            foreach ($array as $item)
                $reorderarray[] = F_Array::reordenarKeys($item);
        } else {
            $reorderarray = $array;
        }
        return $reorderarray;
    }
    
    public static function getArrayFromArrayObject($arrayobject,$attribute)
    {
        $array = array();
        foreach($arrayobject as $object) {
                array_push($array,$object->$attribute);
        }
        return $array;
    }
    
    public function array2csv($input, $delimiter = ',', $enclosure = '"', $escape = '\\') {
        foreach ($input as $key => $value)
            $input[$key] = str_replace($enclosure, $escape . $enclosure, $value);
        return $enclosure . implode($enclosure . $delimiter . $enclosure, $input) . $enclosure;
    }
}

?>



