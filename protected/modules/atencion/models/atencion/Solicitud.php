<?php

/**
 * This is the model class for table "t011_atn_solicitud".
 *
 * The followings are the available columns in table 't011_atn_solicitud':
 * @property integer $pk_solicitud
 * @property string $cod_solicitud
 * @property string $des_reg_solicitante
 * @property string $des_area_solicitante
 * @property string $des_nom_solicitante
 * @property string $des_descripcion
 * @property integer $cod_estado
 * @property integer $cod_prioridad
 * @property integer $cod_calidad
 * @property string $des_observacion
 * @property integer $fk_proceso
 * @property string $fec_registro
 * @property integer $val_activo
 *
 * The followings are the available model relations:
 * @property Proceso $proceso
 * @property Registro[] $registros
 * @property Tramite $tramite
 * 
 */
class Solicitud extends CActiveRecord
{
        public $report_fdesde;
        public $report_fhasta;
        public $report_fdemora;
        public $report_formato;
        
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return T011AtnSolicitud the static model class
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
		return 't011atn_solicitud';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('des_descripcion, fk_proceso', 'required'),
			array('cod_estado, cod_prioridad, cod_calidad, fk_proceso, val_activo', 'numerical', 'integerOnly'=>true),
			array('cod_solicitud, des_reg_solicitante, des_area_solicitante', 'length', 'max'=>50),
			array('des_nom_solicitante', 'length', 'max'=>100),
			array('des_observacion, fec_registro', 'safe'),
                        array('report_fdesde, report_fhasta, report_formato', 'safe'), // elementos del reporte
                        //array('report_fdesde, report_fhasta, report_formato','type','type'=>'date','dateFormat'=>'d/m/yyyy', 'message'=>'El formato correcto es d/m/yyyy'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pk_solicitud, cod_solicitud, des_reg_solicitante, des_area_solicitante, des_nom_solicitante, des_descripcion, cod_estado, cod_prioridad, cod_calidad, des_observacion, fk_proceso, fec_registro, val_activo', 'safe', 'on'=>'search'),
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
                        'proceso' => array(self::BELONGS_TO, 'Proceso', 'fk_proceso'),
			'registros' => array(self::HAS_MANY, 'Registro', 'fk_solicitud'),
			'tramite' => array(self::HAS_ONE, 'Tramite', 'fk_solicitud'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_solicitud' => 'ID Solicitud',
			'cod_solicitud' => 'Nro. Solicitud',
			'des_reg_solicitante' => 'Nro. Registro del Sol.',
			'des_area_solicitante' => 'Area',
			'des_nom_solicitante' => 'Nombre & Apellidos Sol.',
			'des_descripcion' => 'Descripción de la Solicitud',
			'cod_estado' => 'Estado',
			'cod_prioridad' => 'Prioridad',
			'cod_calidad' => 'Calidad',
			'des_observacion' => 'Observacion',
			'fk_proceso' => 'Proceso',
			'fec_registro' => 'Fecha',
			'val_activo' => 'Es Activo',
                        
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

		$criteria->compare('pk_solicitud',$this->pk_solicitud);
		$criteria->compare('cod_solicitud',$this->cod_solicitud,true);
		$criteria->compare('des_reg_solicitante',$this->des_reg_solicitante,true);
		$criteria->compare('des_area_solicitante',$this->des_area_solicitante,true);
		$criteria->compare('des_nom_solicitante',$this->des_nom_solicitante,true);
		$criteria->compare('des_descripcion',$this->des_descripcion,true);
		$criteria->compare('cod_estado',$this->cod_estado);
		$criteria->compare('cod_prioridad',$this->cod_prioridad);
		$criteria->compare('cod_calidad',$this->cod_calidad);
		$criteria->compare('des_observacion',$this->des_observacion,true);
		$criteria->compare('fk_proceso',$this->fk_proceso);
		$criteria->compare('fec_registro',$this->fec_registro,true);
		$criteria->compare('val_activo',$this->val_activo);
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}        
        
        public function misPedidos()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

	        if(!Yii::app()->user->tieneFullAcceso()) { $criteria->compare('cod_reg',Yii::app()->user->getUserReg()); }
		$criteria->compare('des_nom_solicitante',$this->des_nom_solicitante,true);
		$criteria->compare('cod_prioridad',$this->cod_prioridad);
                $criteria->compare('des_descripcion',$this->des_descripcion,true);
		$criteria->compare('cod_estado',$this->cod_estado);
		$criteria->compare('fec_registro',$this->fec_registro,true);
		$criteria->compare('fk_proceso',$this->fk_proceso);
		$criteria->compare('val_activo',$this->val_activo);
                $criteria->compare('des_area_solicitante',$this->des_area_solicitante,true);
                $criteria->compare('des_nom_solicitante',$this->des_nom_solicitante,true);
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array( 
                                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']), 
                        ), 
                        'sort'=>array( 
                            'defaultOrder'=>'t.fec_registro DESC', 
                        ) 
		));
	}
        
        public function pedidosNoAprobados()
        {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

            $criteria=new CDbCriteria;
            $criteria->compare('cod_estado', EEstadoSolicitud::Registrado,false,'OR');
            $criteria->compare('cod_estado', EEstadoSolicitud::Modificado,false,'OR');
            $criteria->compare('des_area_solicitante',$this->des_area_solicitante,true);
            $criteria->compare('des_nom_solicitante',$this->des_nom_solicitante,true);
            $criteria->compare('des_descripcion',$this->des_descripcion,true);
            $criteria->compare('cod_prioridad',$this->cod_prioridad);
            //$criteria->order = 'fec_registro DESC'; 
            
            return new CActiveDataProvider($this, array(
                        'criteria'=>$criteria,
                        'pagination'=>array( 
                                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']), 
                        ),
                        'sort'=>array( 
                                    'defaultOrder'=>'t.fec_registro DESC', 
                        )
            ));
        }
        
        public function pedidosEsDesignado()
        {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

            $criteria=new CDbCriteria;
            $criteria->with = array('tramite');
            $criteria->compare('des_area_solicitante',$this->des_area_solicitante,true);
            $criteria->compare('des_nom_solicitante',$this->des_nom_solicitante,true);
            $criteria->compare('des_descripcion',$this->des_descripcion,true);
            $criteria->compare('cod_estado', EEstadoSolicitud::EnAtención);
            $criteria->compare('cod_prioridad',$this->cod_prioridad);
            $criteria->compare('tramite.es_vigente', ETramiteVigente::si);
            $criteria->compare('fk_proceso',$this->fk_proceso);
            //$criteria->order = 't.fec_registro DESC'; 
            
            if(!Yii::app()->user->tieneFullAcceso()) { $criteria->compare('cod_destinatario',Yii::app()->user->getUserReg()); }
            
            return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
                'pagination'=>array( 
                                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']), 
                ), 
                'sort'=>array( 
                            'defaultOrder'=>'t.fec_registro DESC', 
                )
            ));
        }
        
        /*
         * gets Personalizados
         */
        
        public function getCustomCod()
        {
            return sprintf('%04d',$this->cod_solicitud).' - '.F_Time::getFromMYSQLDate($this->fec_registro,'Y');
        }
        
        public function getEstado()
        {
            return nl2br(EEstadoSolicitud::getEstadoFromSolicitudArray($this->cod_estado));//[$this->cod_estado]);
        }
        
        public function getSolicitante()
        {
            return persona::getFullNameByReg($this->des_reg_solicitante);
        }
        
        public function getPrioridad()
        {
            return nl2br(EPrioridadSolicitud::getPrioridadFromSolicitudArray($this->cod_prioridad));
        }
        
        public function getSolicitudCode()
        {
            // se ha rehusado el codigo de adminweb
            // max se comporta extrannio a veces por lo que se debe de usar cast / mas info ver stack overflow
            $sql = "select 
                    CASE 
                    WHEN (ISNULL(max(cast(cod_solicitud as UNSIGNED))) or year(now())!=year(fec_registro)) 
                        THEN 1   
                    ELSE 
                    ((select max(cast(cod_solicitud as UNSIGNED))+1 from ".EDB::getAtenciondb(EDB::atn_solicitud)." where year(now())=year(fec_registro))) 
                        END as codigo 
                    from ".EDB::getAtenciondb(EDB::atn_solicitud)."
                    where year(fec_registro)=year(now())";
            
            $result = Yii::app()->db->createCommand($sql)->queryRow();
            return $result['codigo'];
        }
        
        public function checkIfSolicitudHaveUIT($solicitud)
        {
            $criteria=new CDbCriteria;
            $criteria->select = 'pk_uit';
            $criteria->condition='fk_solicitud=:fk_solicitud and val_activo=1';
            $criteria->params=array(':fk_solicitud'=>$solicitud->pk_solicitud);
            $criteria->limit = 1; // toda solicitud tendra un formulario uit unico
            
            $model = Uit::model()->find($criteria);
            if($model === null) { return null; } else { return $model; }
        }
        
        public function checkIfSolicitudHaveAtencion($pksolicitud)
        {   
            $criteria=new CDbCriteria;
            $criteria->select = 'cod_prioridad';
            $criteria->condition='pk_solicitud=:pk_solicitud';
            $criteria->params=array(':pk_solicitud'=>$pksolicitud);
            $criteria->limit = 1;  // cuando el pedido pasa a atencion se le asigna una prioridad
            
            $model = self::model()->find($criteria);
            
            if($model->cod_prioridad === null) { return EEstadoSolicitud::Modificado; } 
            else { return EEstadoSolicitud::EnAtención; }
        }
        
        public function report_DiasAtencion()
        {   
            $criteria=new CDbCriteria;
            $criteria->with = array('proceso');
            if ($this->report_formato == '2') {
                $criteria->select = array('proceso.des_descripcion','cod_solicitud', 'des_area_solicitante', 'des_nom_solicitante', 'des_descripcion', 'fec_registro', 'cod_estado', 'timediff((select fec_registro from t013atn_tramite where val_activo = 1 and fk_solicitud = t.pk_solicitud order by fec_registro DESC limit 1 ),fec_registro) as report_fdemora');
            } else {
                $criteria->select = array('proceso.des_descripcion','cod_solicitud', 'des_area_solicitante', 'des_nom_solicitante', 'des_descripcion', 'fec_registro', 'cod_estado', 'datediff((select fec_registro from t013atn_tramite where val_activo = 1 and fk_solicitud = t.pk_solicitud order by fec_registro DESC limit 1 ),fec_registro) as report_fdemora');
            }
            
            $criteria->compare('des_nom_solicitante',$this->des_nom_solicitante,true);
            $criteria->compare('des_area_solicitante',$this->des_area_solicitante,true);
            $criteria->compare('cod_estado',$this->cod_estado,true);
            $criteria->compare('t.des_descripcion',$this->des_descripcion,true);
            $criteria->compare('fk_proceso',$this->fk_proceso);
            $criteria->compare('t.val_activo', EBooleano::si);
            
            if($this->report_fdesde!='') { $criteria->addCondition('str_to_date(fec_registro,"%Y-%m-%d") >= "'. $this->report_fdesde.'"'); }
            if($this->report_fhasta!='') { $criteria->addCondition('str_to_date(fec_registro,"%Y-%m-%d") <= "'. $this->report_fhasta.'"'); }
            
            
            return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
                'pagination'=>array( 
                                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']), 
                ),
                'sort'=>array( 
                            'defaultOrder'=>'t.fec_registro DESC', 
                )
            ));
        }
        
        public function report_Pendientes()
        {   
            $criteria=new CDbCriteria;
            $criteria->compare('des_nom_solicitante',$this->des_nom_solicitante,true);
            $criteria->compare('des_area_solicitante',$this->des_area_solicitante,true);
            $criteria->compare('des_descripcion',$this->des_descripcion,true);
            $criteria->compare('cod_estado','!='.EEstadoSolicitud::Rechazado,false,'OR');
            $criteria->compare('cod_estado','!='.EEstadoSolicitud::NoSeAtendió,false,'OR');
            $criteria->compare('val_activo', EBooleano::si);
            
            return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
                'pagination'=>array( 
                                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']), 
                ),
                'sort'=>array( 
                            'defaultOrder'=>'t.fec_registro DESC', 
                )
            ));
        }
}