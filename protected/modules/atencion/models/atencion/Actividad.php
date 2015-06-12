<?php

/**
 * This is the model class for table "t010_atn_actividad".
 *
 * The followings are the available columns in table 't010_atn_actividad':
 * @property integer $pk_actividad
 * @property string $des_actividad
 * @property string $des_tipo
 * @property integer $val_activo
 *
 * The followings are the available model relations:
 * @property Registro[] $registros
 */

class Actividad extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return T010AtnActividad the static model class
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
		return 't010atn_actividad';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('des_actividad', 'required'),
			array('val_activo', 'numerical', 'integerOnly'=>true),
			array('des_actividad, des_tipo', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pk_actividad, des_actividad, des_tipo, val_activo', 'safe', 'on'=>'search'),
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
			'registros' => array(self::HAS_MANY, 'Registro', 'fk_actividad'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_actividad' => 'ID Actividad',
			'des_actividad' => 'Actividades en Proceso',
			'des_tipo' => 'Proceso',
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

		$criteria->compare('pk_actividad',$this->pk_actividad);
		$criteria->compare('des_actividad',$this->des_actividad,true);
		$criteria->compare('des_tipo',$this->des_tipo,true);
		$criteria->compare('val_activo',$this->val_activo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function load()
        {
           $models=self::model()->findAll();
           return $models;
        }
}