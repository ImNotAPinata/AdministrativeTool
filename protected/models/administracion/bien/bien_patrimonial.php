<?php

/**
 * This is the model class for table "administracion.bp_bien".
 *
 * The followings are the available columns in table 'administracion.bp_bien':
 * @property string $idbien
 * @property string $codpatrimonial
 * @property string $codanterior
 * @property string $descripcion
 * @property string $marca
 * @property string $modelo
 * @property string $serie
 * @property string $estado
 * @property string $fingreso
 * @property integer $migrado
 * @property string $fmigracion
 * @property string $fdigitacion
 * @property string $usuario
 * @property string $estacion
 * @property integer $eninventario
 */
class bien_patrimonial extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return bien_patrimonial the static model class
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
		return 'administracion.bp_bien';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fmigracion', 'required'),
			array('migrado, eninventario', 'numerical', 'integerOnly'=>true),
			array('codpatrimonial, codanterior, estacion', 'length', 'max'=>12),
			array('descripcion', 'length', 'max'=>120),
			array('marca', 'length', 'max'=>20),
			array('modelo', 'length', 'max'=>50),
			array('serie', 'length', 'max'=>30),
			array('estado', 'length', 'max'=>6),
			array('usuario', 'length', 'max'=>16),
			array('fingreso, fdigitacion', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idbien, codpatrimonial, codanterior, descripcion, marca, modelo, serie, estado, fingreso, migrado, fmigracion, fdigitacion, usuario, estacion, eninventario', 'safe', 'on'=>'search'),
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
			'idbien' => 'Idbien',
			'codpatrimonial' => 'Codpatrimonial',
			'codanterior' => 'Codanterior',
			'descripcion' => 'Descripcion',
			'marca' => 'Marca',
			'modelo' => 'Modelo',
			'serie' => 'Serie',
			'estado' => 'Estado',
			'fingreso' => 'Fingreso',
			'migrado' => 'Migrado',
			'fmigracion' => 'Fmigracion',
			'fdigitacion' => 'Fdigitacion',
			'usuario' => 'Usuario',
			'estacion' => 'Estacion',
			'eninventario' => 'Eninventario',
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

		$criteria->compare('idbien',$this->idbien,true);
		$criteria->compare('codpatrimonial',$this->codpatrimonial,true);
		$criteria->compare('codanterior',$this->codanterior,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('marca',$this->marca,true);
		$criteria->compare('modelo',$this->modelo,true);
		$criteria->compare('serie',$this->serie,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('fingreso',$this->fingreso,true);
		$criteria->compare('migrado',$this->migrado);
		$criteria->compare('fmigracion',$this->fmigracion,true);
		$criteria->compare('fdigitacion',$this->fdigitacion,true);
		$criteria->compare('usuario',$this->usuario,true);
		$criteria->compare('estacion',$this->estacion,true);
		$criteria->compare('eninventario',$this->eninventario);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}