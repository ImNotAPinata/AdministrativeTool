<?php

/**
 * This is the model class for table "ac_correo".
 *
 * The followings are the available columns in table 'ac_correo':
 * @property string $id_correo
 * @property integer $revision
 * @property string $fec_revision
 */
class Correo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AcCorreo the static model class
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
		return 'ac_correo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('revision', 'numerical', 'integerOnly'=>true),
			array('fec_revision', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_correo, revision, fec_revision', 'safe', 'on'=>'search'),
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
			'id_correo' => 'Id Correo',
			'revision' => 'Revision',
			'fec_revision' => 'Fec Revision',
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

		$criteria->compare('id_correo',$this->id_correo,true);
		$criteria->compare('revision',$this->revision);
		$criteria->compare('fec_revision',$this->fec_revision,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}