<?php

/**
 * This is the model class for table "t009_atn_proceso".
 *
 * The followings are the available columns in table 't009_atn_proceso':
 * @property integer $pk_proceso
 * @property string $des_descripcion
 * @property string $des_proceso
 * @property string $des_nivel
 * @property integer $val_activo
 *
 * The followings are the available model relations:
 * @property Solicitud[] $solicituds
 */
class Proceso extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return T009AtnProceso the static model class
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
		return 't009atn_proceso';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('des_descripcion', 'required'),
			array('val_activo', 'numerical', 'integerOnly'=>true),
			array('des_descripcion, des_proceso, des_nivel', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pk_proceso, des_descripcion, des_proceso, des_nivel, val_activo', 'safe', 'on'=>'search'),
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
			'solicituds' => array(self::HAS_MANY, 'Solicitud', 'fk_proceso'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_proceso' => 'ID Proceso',
			'des_descripcion' => 'Descripción',
			'des_proceso' => 'Proceso',
			'des_nivel' => 'Nivel',
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

		$criteria->compare('pk_proceso',$this->pk_proceso);
		$criteria->compare('des_descripcion',$this->des_descripcion,true);
		$criteria->compare('des_proceso',$this->des_proceso,true);
		$criteria->compare('des_nivel',$this->des_nivel,true);
		$criteria->compare('val_activo',$this->val_activo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function load()
        {
           $nivel =  Yii::app()->user->getUserCategoriasDisponibles();
           
           $criteria=new CDbCriteria;
           $criteria->condition='des_nivel = :des_nivel or des_proceso is null and val_activo=1';
           $criteria->params=array(':des_nivel'=>$nivel);
           
           $models=self::model()->findAll($criteria);
           return $models;
        }
}