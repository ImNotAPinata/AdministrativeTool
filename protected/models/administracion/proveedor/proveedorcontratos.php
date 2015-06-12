<?php

/**
 * This is the model class for table "administracion.sc_proveedor".
 *
 * The followings are the available columns in table 'administracion.sc_proveedor':
 * @property integer $idproveedor
 * @property string $ruc
 * @property string $razonsocial
 * @property string $direccion
 * @property string $telefono0
 * @property string $telefono1
 * @property string $telefono2
 * @property string $fax0
 * @property string $email0
 * @property string $email1
 * @property string $contacto
 * @property string $otrosdetalles
 * @property string $fdigita
 * @property string $usuario
 * @property string $pc
 */
class ProveedorSContratos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Proveedor the static model class
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
		return 'administracion.sc_proveedor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ruc', 'length', 'max'=>11),
			array('razonsocial, direccion, contacto', 'length', 'max'=>100),
			array('telefono0, telefono1, telefono2', 'length', 'max'=>12),
			array('fax0, usuario', 'length', 'max'=>15),
			array('email0, email1', 'length', 'max'=>45),
			array('otrosdetalles', 'length', 'max'=>120),
			array('pc', 'length', 'max'=>20),
			array('fdigita', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idproveedor, ruc, razonsocial, direccion, telefono0, telefono1, telefono2, fax0, email0, email1, contacto, otrosdetalles, fdigita, usuario, pc', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idproveedor' => 'Idproveedor',
			'ruc' => 'Ruc',
			'razonsocial' => 'Razonsocial',
			'direccion' => 'Direccion',
			'telefono0' => 'Telefono0',
			'telefono1' => 'Telefono1',
			'telefono2' => 'Telefono2',
			'fax0' => 'Fax0',
			'email0' => 'Email0',
			'email1' => 'Email1',
			'contacto' => 'Contacto',
			'otrosdetalles' => 'Otrosdetalles',
			'fdigita' => 'Fdigita',
			'usuario' => 'Usuario',
			'pc' => 'Pc',
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

		$criteria->compare('idproveedor',$this->idproveedor);
		$criteria->compare('ruc',$this->ruc,true);
		$criteria->compare('razonsocial',$this->razonsocial,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('telefono0',$this->telefono0,true);
		$criteria->compare('telefono1',$this->telefono1,true);
		$criteria->compare('telefono2',$this->telefono2,true);
		$criteria->compare('fax0',$this->fax0,true);
		$criteria->compare('email0',$this->email0,true);
		$criteria->compare('email1',$this->email1,true);
		$criteria->compare('contacto',$this->contacto,true);
		$criteria->compare('otrosdetalles',$this->otrosdetalles,true);
		$criteria->compare('fdigita',$this->fdigita,true);
		$criteria->compare('usuario',$this->usuario,true);
		$criteria->compare('pc',$this->pc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}