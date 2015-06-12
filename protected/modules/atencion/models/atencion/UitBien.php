<?php

/**
 * This is the model class for table "t019_atn_uit_bien".
 *
 * The followings are the available columns in table 't019_atn_uit_bien':
 * @property integer $pk_uitbien
 * @property integer $fk_uitproveedor
 * @property integer $cod_patrimonial_solicitado
 * @property integer $cod_patrimonial_recepcionado
 * @property string $fec_patrimonial_solicitud
 * @property string $fec_patrimonial_recepcionado
 * @property string $fec_registro
 * @property integer $val_activo
 *
 * The followings are the available model relations:
 * @property UitFactura $uitfactura
 */
class UitBien extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return T019AtnUitBien the static model class
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
		return 't017atn_uitbien';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_uitproveedor', 'required'),
			array('fk_uitproveedor, cod_patrimonial_solicitado, cod_patrimonial_recepcionado, val_activo', 'numerical', 'integerOnly'=>true),
			array('fec_patrimonial_solicitud, fec_patrimonial_recepcionado', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pk_uitbien, fk_uitproveedor, cod_patrimonial_solicitado, cod_patrimonial_recepcionado, fec_patrimonial_solicitud, fec_patrimonial_recepcionado, fec_registro, val_activo', 'safe', 'on'=>'search'),
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
                    'uitfactura' => array(self::BELONGS_TO, 'UitFactura', 'fk_uit_factura'),
                );

	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_uitbien' => 'Pk Uitbien',
			'fk_uitproveedor' => 'Fk Uitproveedor',
			'cod_patrimonial_solicitado' => 'Solicitado?',
			'cod_patrimonial_recepcionado' => 'Recepcionado?',
			'fec_patrimonial_solicitud' => 'Fecha de Solicitud',
			'fec_patrimonial_recepcionado' => 'Fecha de Recepción',
			'fec_registro' => 'Fec Registro',
			'val_activo' => 'Val Activo',
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

		$criteria->compare('pk_uitbien',$this->pk_uitbien);
		$criteria->compare('fk_uitproveedor',$this->fk_uitproveedor);
		$criteria->compare('cod_patrimonial_solicitado',$this->cod_patrimonial_solicitado);
		$criteria->compare('cod_patrimonial_recepcionado',$this->cod_patrimonial_recepcionado);
		$criteria->compare('fec_patrimonial_solicitud',$this->fec_patrimonial_solicitud,true);
		$criteria->compare('fec_patrimonial_recepcionado',$this->fec_patrimonial_recepcionado,true);
		$criteria->compare('fec_registro',$this->fec_registro,true);
		$criteria->compare('val_activo',$this->val_activo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        function beforeSave() {
            if (parent::beforeSave()) {
                $this->fec_patrimonial_recepcionado = F_TIME::setToMYSQLDate($this->fec_patrimonial_recepcionado);
                $this->fec_patrimonial_solicitud = F_TIME::setToMYSQLDate($this->fec_patrimonial_solicitud);
                return true;
            }
            else
                return false;
        }

        function afterSave() {
            $this->fec_patrimonial_recepcionado = F_TIME::getFromMYSQLDate($this->fec_patrimonial_recepcionado);
            $this->fec_patrimonial_solicitud = F_TIME::getFromMYSQLDate($this->fec_patrimonial_solicitud);
        }

        function afterFind() {
            $this->fec_patrimonial_recepcionado = F_TIME::getFromMYSQLDate($this->fec_patrimonial_recepcionado);
            $this->fec_patrimonial_solicitud = F_TIME::getFromMYSQLDate($this->fec_patrimonial_solicitud);
        }
}