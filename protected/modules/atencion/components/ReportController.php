<?php

class ReportController extends CController {

    public $layout = '/layouts/column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();
    

    public function renderToSeriesLinealChart($resultArray, $arrayValues, $xAxis, $xAxisAttribute = null, $limit = null) {
        $Renderedarray = array();

        foreach ($xAxis as $x) {
            $arraydata = array();
            $key = 0;
            $month = null;
            foreach ($resultArray as $array) {
                if ($array[$arrayValues[0]] == $x->$xAxisAttribute) {
                    if ($month == null) {
                        $month = $array[$arrayValues[2]];
                    }

                    if ($month == $array[$arrayValues[2]]) {
                        array_push($arraydata, intval($array[$arrayValues[1]]));
                    } else {
                        while ($month != $array[$arrayValues[2]]) {
                            array_push($arraydata, 0);
                            $month++;
                        }
                    }
                    $month++;
                    unset($resultArray[$key]);
                }
                $key++;
            }

            if (count($arraydata) > 0) {
                // Completo con 0 
                for ($i = count($arraydata); $i < $limit; $i++) {
                    if (!array_key_exists($i, $arraydata)) {
                        array_push($arraydata, 0);
                    }
                }

                array_push($Renderedarray, array('name' => $x->$xAxisAttribute, 'data' => $arraydata));
            }
        }

        return $Renderedarray;
    }

}

?>