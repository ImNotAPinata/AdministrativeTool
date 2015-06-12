<?php

class ReaderController extends CController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='column1';
        
        public $menu = array();

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionIndex()
	{
            
            $documento = new EcpDocumento();
            
            if(isset($_GET['EcpContrato']))
            {
                $documento->attributes = $_GET['EcpContrato'];
            }
            
            $this->render('admin',array('documento'=>$documento)); 
	}
        
        public function actionUpload()
	{
            $uploadform = new UploadContratoForm();
            
            if (isset($_POST['UploadContratoForm'])) {
                $uploadform->attributes = $_POST['UploadContratoForm'];
                if ($uploadform->validate()) {
                    $uploadform->archivo = CUploadedFile::getInstance($uploadform, 'archivo');
                    $savedir = Yii::app()->params->defaultUploadLocation ."reader". DIRECTORY_SEPARATOR .date('Y_m_d_h_m_s')."_".$uploadform->archivo->name;
                    $uploadform->archivo->saveAs($savedir);
                    // creamos el documento
                    
                    // grabamos la info del documento
                    $documento = new EcpDocumento();
                    $documento->des_documento = $uploadform->doc_name;
                    $documento->cod_tipo = $uploadform->cod_estado;
                    $documento->save();
                    
                    // Este metodo funciona pero se pierde todo el estilo!
                    $tosplit = explode(",",$uploadform->split_info);
                    $cad = "";
                    $key = 1;
                    $maxkey = count($tosplit);
                    
                    $file = fopen($savedir, 'r');
                    while($line = fgets($file))
                    {
                        if ($maxkey != $key+1) {
                            if (strcmp(trim($line), trim($tosplit[$key])) == 0) {
                                
                                $docpart = new EcpParte();
                                $docpart->des_parte = trim($tosplit[$key]);
                                $docpart->des_html = $cad;
                                $docpart->fk_documento = $documento->pk_documento;
                                $docpart->save();
                                 
                                $cad = "";
                                $key++;
                            }
                        }
                        
                        $cad .= $line."<br/>";
                    }
                    // grabo la ultima parte
                    $docpart = new EcpParte();
                    $docpart->des_parte = $tosplit[$key];
                    $docpart->des_html = $cad;
                    $docpart->fk_documento = $documento->pk_documento;
                    $docpart->save();
                    
                    fflush($file);
                    fclose($file);
                    
                    // ------------------------------------------------------ //
                    
                }
            }   
            
            /*
INTRODUCCION,
CAPÍTULO I,
CAPÍTULO II,
CAPÍTULO III,
CAPÍTULO IV,
CAPÍTULO V,
FORMATOS Y ANEXOS ,
            */
            $this->render('upload',array('uploadform'=>$uploadform));
        }
}
?>
<?php


//strpos($cad, $line)
                    
                    /*$keywordSize = strlen($tosplit[$key]);
                    $file = fopen($savedir, 'r');
                    while($char = fgetc($file))
                    {
                        
                        $searchedwordSize = strlen($searchedword);
                        $cad .= $char;
                        
                        if($searchedwordSize == $keywordSize)
                        { $searchedword = substr($searchedword,0,-1); 
                          $searchedword .= $char;
                          var_dump($searchedword);
                          if($searchedword == $tosplit[$key] || count($tosplit) == $key )
                          {
                              array_push($docarray, $cad);
                              $key++;
                              $cad = "";
                              $keywordSize = $tosplit[$key];
                          }
                        }
                        else { $searchedword .= $char;  }
                    }
                    
                    fclose($file);
                    fflush($file);
                    var_dump($docarray);
                     
                    */
?>