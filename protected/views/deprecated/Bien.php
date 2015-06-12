<?php

/**
 * This is the model class for table "t006_atn_bien".
 *
 * The followings are the available columns in table 't006_atn_bien':
 * @property integer $pk_bien
 * @property string $nom_bien
 * @property string $des_marca
 * @property string $fec_registro
 * @property string $val_activo
 */
class Bien extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return T006AtnBien the static model class
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
		return 't006_atn_bien';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nom_bien, des_marca, val_activo', 'length', 'max'=>50),
			array('fec_registro', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pk_bien, nom_bien, des_marca, fec_registro, val_activo', 'safe', 'on'=>'search'),
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
			'pk_bien' => 'Pk Bien',
			'nom_bien' => 'Nom Bien',
			'des_marca' => 'Des Marca',
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

		$criteria->compare('pk_bien',$this->pk_bien);
		$criteria->compare('nom_bien',$this->nom_bien,true);
		$criteria->compare('des_marca',$this->des_marca,true);
		$criteria->compare('fec_registro',$this->fec_registro,true);
		$criteria->compare('val_activo',$this->val_activo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}