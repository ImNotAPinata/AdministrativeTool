<?php

/**
 * This is the model class for table "tgen_proveedorservicio".
 *
 * The followings are the available columns in table 'tgen_proveedorservicio':
 * @property integer $pk_proveedorservicios
 * @property integer $fk_proveedor
 * @property string $des_descripcion
 * @property string $fec_registro
 *
 * The followings are the available model relations:
 * @property TgenProveedor $proveedor
 */
class ProveedorServicio extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TgenProveedorservicio the static model class
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
		return 't000gen_proveedorservicio';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_proveedor, des_descripcion', 'required'),
			array('fk_proveedor', 'numerical', 'integerOnly'=>true),
			array('des_descripcion', 'length', 'max'=>200),
			array('fec_registro', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pk_proveedorservicios, fk_proveedor, des_descripcion, fec_registro', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_proveedorservicios' => 'Pk Proveedorservicios',
			'fk_proveedor' => 'Fk Proveedor',
			'des_descripcion' => 'Des Descripcion',
			'fec_registro' => 'Fec Registro',
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

		$criteria->compare('pk_proveedorservicios',$this->pk_proveedorservicios);
		$criteria->compare('fk_proveedor',$this->fk_proveedor);
		$criteria->compare('des_descripcion',$this->des_descripcion,true);
		$criteria->compare('fec_registro',$this->fec_registro,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}