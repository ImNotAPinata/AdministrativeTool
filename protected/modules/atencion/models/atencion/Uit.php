<?php

/**
 * This is the model class for table "t016_atn_uit".
 *
 * The followings are the available columns in table 't016_atn_uit':
 * @property integer $pk_uit
 * @property integer $cod_uit_generado
 * @property integer $cod_uit_estado
 * @property integer $cod_uit_tipo
 * @property string $des_area_solicitante
 * @property string $des_registro_solicitante
 * @property string $des_nombre_solicitante
 * @property string $num_uit_siged
 * @property string $des_uit_descripcion
 * @property string $fec_uit_siged
 * @property string $num_uit_importe
 * @property string $des_proyectado_por
 * @property string $fec_devolucion_siged
 * @property string $fec_recepcion_siged
 * @property string $fec_atencion_siged
 * @property string $fec_asignado_siged
 * @property string $fec_registro
 * @property integer $val_activo
 *
 * The followings are the available model relations:
 * @property UitProveedor[] $uitproveedors
 */
class Uit extends CActiveRecord
{
        public $report_pimporte;
        public $report_fimporte;
        public $report_fdesde;
        public $report_fhasta;
        
        /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return T016AtnUit the static model class
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
		return 't015atn_uit';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('des_area_solicitante, des_registro_solicitante, des_nombre_solicitante, num_uit_siged, des_uit_descripcion', 'required'),
			array('cod_uit_estado,cod_uit_tipo, val_activo', 'numerical', 'integerOnly'=>true),
			array('cod_uit_generado, des_area_solicitante, des_registro_solicitante, num_uit_siged, des_proyectado_por, fec_asignado_siged', 'length', 'max'=>50),
			array('des_nombre_solicitante', 'length', 'max'=>100),
			array('num_uit_importe', 'length', 'max'=>18),
                        //array('num_uit_importe','type','type'=>'decimal','numberFormat'=>'#.##', 'message'=>'Ingrese una cantidad valida en formato (numero no mayor a 18 digitos).(2 decimales) EJ: 199.99'),
			array('fec_uit_siged, fec_devolucion_siged, fec_recepcion_siged, fec_atencion_siged, selected_Proveedor', 'safe'),
                        array('fec_uit_siged, fec_devolucion_siged, fec_recepcion_siged, fec_atencion_siged','type','type'=>'date','dateFormat'=>'d/m/yyyy', 'message'=>'El formato correcto es d/m/yyyy'),
                        // elementos del reporte
                        array('report_fdesde, report_fhasta, report_pimporte, report_fimporte, report_uitmes, report_uitannio', 'safe'), 
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pk_uit, cod_uit_generado,cod_uit_tipo, cod_uit_estado, des_area_solicitante, des_registro_solicitante, des_nombre_solicitante, num_uit_siged, des_uit_descripcion, fec_uit_siged, num_uit_importe, des_proyectado_por, fec_devolucion_siged, fec_recepcion_siged, fec_atencion_siged, fec_asignado_siged, fec_registro, val_activo', 'safe', 'on'=>'search'),
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
			'uitproveedors' => array(self::HAS_MANY, 'UitProveedor', 'fk_uit','condition'=>'uitproveedors.val_activo=1'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_uit' => 'ID Uit',
			'cod_uit_generado' => 'Código UIT',
			'cod_uit_estado' => 'Estado de la UIT',
                        'cod_uit_tipo' => 'Acerca de la UIT',
			'des_area_solicitante' => 'Area',
			'des_registro_solicitante' => 'Nro. Registro',
			'des_nombre_solicitante' => 'Solicitante',
			'num_uit_siged' => 'Número de Siged',
			'des_uit_descripcion' => 'Descripción de la UIT',
			'fec_uit_siged' => 'Fecha de Emisión del Siged',
			'num_uit_importe' => 'Importe Proyectado (S/.)',
			'des_proyectado_por' => 'Proyectado Por',
			'fec_devolucion_siged' => 'F. Devolución (Siged)',
			'fec_recepcion_siged' => 'F. Recepción (Siged)',
			'fec_atencion_siged' => 'F. Atención (Siged)',
			'fec_asignado_siged' => 'F. Asignado (Siged)',
			'fec_registro' => 'Fecha de Registro',
                        'report_uitannio' => 'Año',
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

		$criteria->compare('pk_uit',$this->pk_uit);
		$criteria->compare('cod_uit_generado',$this->cod_uit_generado,true);
		$criteria->compare('cod_uit_estado',$this->cod_uit_estado);
                $criteria->compare('cod_uit_tipo',$this->cod_uit_tipo);
		$criteria->compare('des_area_solicitante',$this->des_area_solicitante,true);
		$criteria->compare('des_registro_solicitante',$this->des_registro_solicitante,true);
		$criteria->compare('des_nombre_solicitante',$this->des_nombre_solicitante,true);
		$criteria->compare('num_uit_siged',$this->num_uit_siged,true);
		$criteria->compare('des_uit_descripcion',$this->des_uit_descripcion,true);
		$criteria->compare('fec_uit_siged',$this->fec_uit_siged,true);
		$criteria->compare('num_uit_importe',$this->num_uit_importe,true);
		$criteria->compare('des_proyectado_por',$this->des_proyectado_por,true);
		$criteria->compare('fec_devolucion_siged',$this->fec_devolucion_siged,true);
		$criteria->compare('fec_recepcion_siged',$this->fec_recepcion_siged,true);
		$criteria->compare('fec_atencion_siged',$this->fec_atencion_siged,true);
		$criteria->compare('fec_asignado_siged',$this->fec_asignado_siged,true);
		$criteria->compare('fec_registro',$this->fec_registro,true);
		$criteria->compare('val_activo',$this->val_activo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function report_uit()
	{
            $criteria=new CDbCriteria;
            $criteria->with = array('uitproveedors');
            $criteria->together = true;
            $criteria->select = array('cod_uit_generado','cod_uit_estado','cod_uit_tipo','des_area_solicitante','des_nombre_solicitante',
                                      'num_uit_siged','des_uit_descripcion','des_proyectado_por','t.fec_registro',
                                      '(select sum(num_importe) from '.EDB::getAtenciondb(EDB::atn_uitproveedor).' where fk_uit = t.pk_uit) as report_pimporte',
                                      '(select sum(num_gasto) from '.EDB::getAtenciondb(EDB::atn_uitfactura).' where fk_uitproveedor = uitproveedors.pk_uitproveedor) as report_fimporte');
            
            $criteria->compare('cod_uit_estado',$this->cod_uit_estado);
            $criteria->compare('cod_uit_tipo',$this->cod_uit_tipo);
            $criteria->compare('des_area_solicitante',$this->des_area_solicitante,true);
            $criteria->compare('des_nombre_solicitante',$this->des_nombre_solicitante,true);
            $criteria->compare('num_uit_siged',$this->num_uit_siged,true);
            $criteria->compare('des_uit_descripcion',$this->des_uit_descripcion,true);
            $criteria->compare('fec_uit_siged',$this->fec_uit_siged,true);
            $criteria->compare('t.val_activo',EBooleano::si);
            
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
        
        public function getCustomCod()
        {
            return sprintf('%04d',$this->cod_uit_generado).' - '.F_Time::getFromMYSQLDate($this->fec_registro,'Y');
        }
        
        public function getPorcentajeAvanceUit()
        {
            $value = (($this->report_fimporte/100) * 100)/($this->report_pimporte/100);
            
            return round($value,2)." % ";
        }
        
        public function getSaldoDisponible()
        {
            return F_Number::FormatoNumeroDecimal($this->report_pimporte - $this->report_fimporte);
        }
        
        public function getUitCode()
        {
            // se ha rehusado el codigo de adminweb
            // max se comporta extraño a veces por lo que se debe de usar cast / mas info ver stack overflow
            $sql = "select 
                    CASE 
                    WHEN (ISNULL(max(cast(cod_uit_generado as UNSIGNED))) or year(now())!=year(fec_registro)) 
                        THEN 1   
                    ELSE 
                    ((select max(cast(cod_uit_generado as UNSIGNED))+1 from ".EDB::getAtenciondb(EDB::atn_uit)." where year(now())=year(fec_registro))) 
                        END as codigo 
                    from ".EDB::getAtenciondb(EDB::atn_uit)."
                    where year(fec_registro)=year(now())";
            
            $result = Yii::app()->db->createCommand($sql)->queryRow();
            return $result['codigo'];
        }
        
        public function UitHaveBienPatrimonial() {
            $itHas = false;
            foreach($this->uitproveedors as $uitProveedor)
            {
                if($uitProveedor->cod_patrimonial_calificacion == EBooleano::si)
                { $itHas = true; }
            }
            return $itHas;
        }
        
        function beforeSave() {
            if (parent::beforeSave()) {
                $this->fec_uit_siged = F_TIME::setToMYSQLDate($this->fec_uit_siged);
                $this->fec_asignado_siged = F_TIME::setToMYSQLDate($this->fec_asignado_siged);
                $this->fec_atencion_siged = F_TIME::setToMYSQLDate($this->fec_atencion_siged);
                $this->fec_recepcion_siged = F_TIME::setToMYSQLDate($this->fec_recepcion_siged);
                $this->fec_devolucion_siged = F_TIME::setToMYSQLDate($this->fec_devolucion_siged);
                $this->num_uit_importe = F_Number::RemoveFormatoNumero($this->num_uit_importe); // solo aplicable en algunos casos
                return true;
            }
            else
                return false;
        }
        function afterSave() {
            $this->fec_uit_siged = F_TIME::getFromMYSQLDate($this->fec_uit_siged);
            $this->fec_asignado_siged = F_TIME::getFromMYSQLDate($this->fec_asignado_siged);
            $this->fec_atencion_siged = F_TIME::getFromMYSQLDate($this->fec_atencion_siged);
            $this->fec_recepcion_siged = F_TIME::getFromMYSQLDate($this->fec_recepcion_siged);
            $this->fec_devolucion_siged = F_TIME::getFromMYSQLDate($this->fec_devolucion_siged);
        }
        function afterFind() {
            $this->fec_uit_siged = F_TIME::getFromMYSQLDate($this->fec_uit_siged);
            $this->fec_asignado_siged = F_TIME::getFromMYSQLDate($this->fec_asignado_siged);
            $this->fec_atencion_siged = F_TIME::getFromMYSQLDate($this->fec_atencion_siged);
            $this->fec_recepcion_siged = F_TIME::getFromMYSQLDate($this->fec_recepcion_siged);
            $this->fec_devolucion_siged = F_TIME::getFromMYSQLDate($this->fec_devolucion_siged);
            $this->num_uit_importe = F_Number::FormatoNumeroDecimal($this->num_uit_importe); // solo aplicable en algunos casos
        }
}