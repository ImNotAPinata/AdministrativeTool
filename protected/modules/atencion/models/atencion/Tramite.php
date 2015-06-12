<?php

/**
 * This is the model class for table "t013_atn_tramite".
 *
 * The followings are the available columns in table 't013_atn_tramite':
 * @property integer $pk_tramite
 * @property integer $fk_solicitud
 * @property integer $fk_movimiento
 * @property string $des_observacion
 * @property string $cod_remitente
 * @property string $nom_remitente
 * @property string $cod_destinatario
 * @property string $nom_destinatario
 * @property integer $es_vigente
 * @property string $fec_registro
 * @property integer $val_activo
 *
 * The followings are the available model relations:
 * @property Solicitud $solicitud
 * @property Movimiento $movimiento
 */
class Tramite extends CActiveRecord
{
        public $selected;
        public $prioridad;
        public $registro;
        
        // opciones a escoger formulario
        public $_opcion_allow;
        public $_opcion_self;
        public $_opcion_save;
        
        public $report_fdesde;
        public $report_fhasta;
        
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return T013AtnTramite the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't013atn_tramite';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_solicitud, fk_movimiento, cod_remitente, nom_remitente, cod_destinatario, nom_destinatario', 'required'),
			array('fk_solicitud, fk_movimiento, es_vigente, val_activo', 'numerical', 'integerOnly'=>true),
			array('cod_remitente, cod_destinatario', 'length', 'max'=>10),
			array('nom_remitente, nom_destinatario', 'length', 'max'=>100),
			array('des_observacion, fec_registro,_opcion_allow,_opcion_save,_opcion_self', 'safe'),
                        array('report_fdesde, report_fhasta', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pk_tramite, fk_solicitud, fk_movimiento, des_observacion, cod_remitente, nom_remitente, cod_destinatario, nom_destinatario, es_vigente, fec_registro, val_activo,_opcion_allow,_opcion_save,_opcion_self', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'solicitud' => array(self::BELONGS_TO, 'Solicitud', 'fk_solicitud'),
			'movimiento' => array(self::BELONGS_TO, 'Movimiento', 'fk_movimiento'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_tramite' => 'ID Tramite',
			'fk_solicitud' => 'ID Solicitud',
			'fk_movimiento' => 'Movimiento',
			'des_observacion' => 'Observación',
			'cod_remitente' => 'Reg. Remitente',
			'nom_remitente' => 'Remitente',
			'cod_destinatario' => 'Reg. Destinatario',
			'nom_destinatario' => 'Destinatario',
			'es_vigente' => 'Es Vigente',
			'fec_registro' => 'Fecha',
			'val_activo' => 'Es Activo',
                        '_opcion_allow' => 'Asignar a una persona para que continue la atención',
                        '_opcion_self' => 'Solo graba el formulario, continuare su llenado después',
                        '_opcion_save' => 'Terminar la atención (Definitivo)',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('pk_tramite',$this->pk_tramite);
		$criteria->compare('fk_solicitud',$this->fk_solicitud);
		$criteria->compare('fk_movimiento',$this->fk_movimiento);
		$criteria->compare('des_observacion',$this->des_observacion,true);
		$criteria->compare('cod_remitente',$this->cod_remitente,true);
		$criteria->compare('nom_remitente',$this->nom_remitente,true);
		$criteria->compare('cod_destinatario',$this->cod_destinatario,true);
		$criteria->compare('nom_destinatario',$this->nom_destinatario,true);
		$criteria->compare('es_vigente',$this->es_vigente);
		$criteria->compare('fec_registro',$this->fec_registro,true);
		$criteria->compare('val_activo',$this->val_activo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function searchOverview()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
                $criteria->compare('pk_tramite',$this->pk_tramite);
		$criteria->compare('fk_solicitud',$this->fk_solicitud);
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array( 
                            'defaultOrder'=>'t.fec_registro DESC', 
                        ),
                        'pagination'=>array(
                            'pageSize'=>5,
                        ),
		));
	}
        
        public function getUltimoRemitente($pksolicitud)
        {
            $sql = "select cod_remitente,nom_remitente from ".EDB::getAtenciondb(EDB::atn_tramite)." where fk_solicitud = $pksolicitud order by pk_tramite DESC limit 1";
            $result = Yii::app()->db->createCommand($sql)->queryRow();
            return $result;
        }
        
        public function clearVigentes($solicitud)
        {
            $sql = "update ".EDB::getAtenciondb(EDB::atn_tramite)." set es_vigente = 0 where fk_solicitud = $solicitud and es_vigente = 1";
            return Yii::app()->db->createCommand($sql)->execute();
        }
        
        public function report_Pendientes() 
        {
            $criteria = new CDbCriteria;
            //$criteria->with = array('solicitud');
            $criteria->compare('nom_destinatario', $this->nom_destinatario,true);
            $criteria->addCondition('fk_movimiento !='. EMovimiento::gen_noseatendio);
            $criteria->addCondition('fk_movimiento !='. EMovimiento::gen_rechazo);
            $criteria->addCondition('fk_movimiento !='. EMovimiento::gen_finalizaatencion);
            $criteria->compare('fk_movimiento', $this->fk_movimiento);
            $criteria->compare('t.es_vigente', EBooleano::si);
            
            if($this->report_fdesde!='') { $criteria->addCondition('str_to_date(t.fec_registro,"%Y-%m-%d") >= "'. $this->report_fdesde.'"'); }
            if($this->report_fhasta!='') { $criteria->addCondition('str_to_date(t.fec_registro,"%Y-%m-%d") <= "'. $this->report_fhasta.'"'); }
                        
            return new CActiveDataProvider($this, array(
                        'criteria' => $criteria,
                        'sort' => array(
                            'defaultOrder' => 't.fec_registro DESC',
                        ),
                    ));
        }
}