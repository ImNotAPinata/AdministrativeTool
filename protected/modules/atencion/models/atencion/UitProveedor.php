<?php

/**
 * This is the model class for table "t017_atn_uit_proveedor".
 *
 * The followings are the available columns in table 't017_atn_uit_proveedor':
 * @property integer $pk_uitproveedor
 * @property integer $fk_uit
 * @property integer $fk_proveedor
 * @property string $fec_ccp_solicitud
 * @property string $fec_ccp_atencion
 * @property integer $cod_ccp
 * @property string $num_ccp
 * @property string $num_orden
 * @property integer $cod_servicio_estado
 * @property string $fec_servicio_orden
 * @property string $fec_servicio_atencion
 * @property string $fec_servicio_usuario
 * @property integer $cod_patrimonial_calificacion
 * @property string $num_importe
 * @property string $fec_registro
 * @property integer $val_activo
 *
 * The followings are the available model relations:
 * @property Proveedor $proveedor
 * @property Uit $uit
 * @property UitFactura[] $uitfactura
 * @property Uitbien $uitbien
 * 
 */
class UitProveedor extends CActiveRecord
{
        /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return T017AtnUitProveedor the static model class
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
		return 't016atn_uitproveedor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
                return array(
			array('fk_uit, fk_proveedor', 'required'),
			array('fk_uit, fk_proveedor, cod_ccp, cod_servicio_estado, cod_patrimonial_calificacion, val_activo', 'numerical', 'integerOnly'=>true),
			array('num_ccp, num_orden', 'length', 'max'=>50),
                        array('num_importe', 'length', 'max'=>18),
			array('fec_ccp_solicitud, fec_ccp_atencion, fec_servicio_orden, fec_servicio_atencion, fec_servicio_usuario', 'safe'),
                        array('fec_ccp_solicitud, fec_ccp_atencion, fec_servicio_orden, fec_servicio_atencion, fec_servicio_usuario', 'type', 'type'=>'date','dateFormat'=>'d/m/yyyy', 'message'=>'El formato correcto es d/m/yyyy'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pk_uitproveedor, fk_uit, fk_proveedor, fec_ccp_solicitud, fec_ccp_atencion, cod_ccp, num_ccp, num_orden, cod_servicio_estado, fec_servicio_orden, fec_servicio_atencion, fec_servicio_usuario, cod_patrimonial_calificacion, fec_registro, val_activo', 'safe', 'on'=>'search'),
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
			'proveedor' => array(self::BELONGS_TO, 'Proveedor', 'fk_proveedor'),
			'uit' => array(self::BELONGS_TO, 'Uit', 'fk_uit'),
			'uitfactura' => array(self::HAS_MANY, 'UitFactura', 'fk_uitproveedor','condition'=>'uitfactura.val_activo!=0'),
                        'uitbien' => array(self::HAS_ONE, 'Uitbien', 'fk_uitproveedor'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
                return array(
			'pk_uitproveedor' => 'ID Uitproveedor',
			'fk_uit' => 'ID Uit',
			'fk_proveedor' => 'ID Proveedor',
			'fec_ccp_solicitud' => 'F. de Solicitud CCP',
			'fec_ccp_atencion' => 'F. de Atención CCP',
			'cod_ccp' => 'Estado de la CCP',
			'num_ccp' => 'Nro. CCP',
			'num_orden' => 'O/C - O/S',
			'cod_servicio_estado' => 'Estado RQ.',
			'fec_servicio_orden' => 'Fecha O/C - O/S',
			'fec_servicio_atencion' => 'F. de Atención',
			'fec_servicio_usuario' => 'F. At. Area Usuario',
			'cod_patrimonial_calificacion' => 'Es Bien Patrimonial?',
                        'num_importe' => 'Importe Real (S/.)',
			'fec_registro' => 'Fec Registro',
			'val_activo' => 'Val Activo',
		);
	}
        
        public function getToSelect()
        {
            return $this->proveedor->des_identificacion . " -  RUC:" . $this->proveedor->des_ruc;
        }

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search() {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('pk_uitproveedor',$this->pk_uitproveedor);
		$criteria->compare('fk_uit',$this->fk_uit);
		$criteria->compare('fk_proveedor',$this->fk_proveedor);
		$criteria->compare('fec_ccp_solicitud',$this->fec_ccp_solicitud,true);
		$criteria->compare('fec_ccp_atencion',$this->fec_ccp_atencion,true);
		$criteria->compare('cod_ccp',$this->cod_ccp);
		$criteria->compare('num_ccp',$this->num_ccp,true);
		$criteria->compare('num_orden',$this->num_orden,true);
		$criteria->compare('cod_servicio_estado',$this->cod_servicio_estado);
		$criteria->compare('fec_servicio_orden',$this->fec_servicio_orden,true);
		$criteria->compare('fec_servicio_atencion',$this->fec_servicio_atencion,true);
		$criteria->compare('fec_servicio_usuario',$this->fec_servicio_usuario,true);
		$criteria->compare('cod_patrimonial_calificacion',$this->cod_patrimonial_calificacion);
		$criteria->compare('fec_registro',$this->fec_registro,true);
		$criteria->compare('val_activo',$this->val_activo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
                
        function beforeSave() {
            if (parent::beforeSave()) {
                $this->fec_ccp_atencion = F_TIME::setToMYSQLDate($this->fec_ccp_atencion);
                $this->fec_ccp_solicitud = F_TIME::setToMYSQLDate($this->fec_ccp_solicitud);
                
                $this->fec_servicio_orden = F_TIME::setToMYSQLDate($this->fec_servicio_orden);
                $this->fec_servicio_atencion = F_TIME::setToMYSQLDate($this->fec_servicio_atencion);
                $this->fec_servicio_usuario = F_TIME::setToMYSQLDate($this->fec_servicio_usuario);
                return true;
            }
            else
                return false;
        }

        function afterSave() {
            $this->fec_ccp_atencion = F_TIME::getFromMYSQLDate($this->fec_ccp_atencion);
            $this->fec_ccp_solicitud = F_TIME::getFromMYSQLDate($this->fec_ccp_solicitud);
            
            $this->fec_servicio_orden = F_TIME::getFromMYSQLDate($this->fec_servicio_orden);
            $this->fec_servicio_atencion = F_TIME::getFromMYSQLDate($this->fec_servicio_atencion);
            $this->fec_servicio_usuario = F_TIME::getFromMYSQLDate($this->fec_servicio_usuario);
        }

        function afterFind() {
            $this->fec_ccp_atencion = F_TIME::getFromMYSQLDate($this->fec_ccp_atencion);
            $this->fec_ccp_solicitud = F_TIME::getFromMYSQLDate($this->fec_ccp_solicitud);
            
            $this->fec_servicio_orden = F_TIME::getFromMYSQLDate($this->fec_servicio_orden);
            $this->fec_servicio_atencion = F_TIME::getFromMYSQLDate($this->fec_servicio_atencion);
            $this->fec_servicio_usuario = F_TIME::getFromMYSQLDate($this->fec_servicio_usuario);
        }
}