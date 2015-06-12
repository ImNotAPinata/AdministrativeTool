<?php

/**
 * This is the model class for table "ac_tarea".
 *
 * The followings are the available columns in table 'ac_tarea':
 * @property string $id_tarea
 * @property string $gm_id
 * @property string $id_menu
 * @property string $nom_tarea
 * @property string $des_tarea
 * @property integer $es_activa
 */
class Tarea extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AcTarea the static model class
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
		return 'ac_tarea';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('es_activa', 'numerical', 'integerOnly'=>true),
			array('gm_id, id_menu', 'length', 'max'=>10),
			array('nom_tarea', 'length', 'max'=>65),
			array('des_tarea', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_tarea, gm_id, id_menu, nom_tarea, des_tarea, es_activa', 'safe', 'on'=>'search'),
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
			'id_tarea' => 'Id Tarea',
			'gm_id' => 'Gm',
			'id_menu' => 'Id Menu',
			'nom_tarea' => 'Nom Tarea',
			'des_tarea' => 'Des Tarea',
			'es_activa' => 'Es Activa',
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

		$criteria->compare('id_tarea',$this->id_tarea,true);
		$criteria->compare('gm_id',$this->gm_id,true);
		$criteria->compare('id_menu',$this->id_menu,true);
		$criteria->compare('nom_tarea',$this->nom_tarea,true);
		$criteria->compare('des_tarea',$this->des_tarea,true);
		$criteria->compare('es_activa',$this->es_activa);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}