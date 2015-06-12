<?php

/**
 * This is the model class for table "administracion.ec_bien".
 *
 * The followings are the available columns in table 'administracion.ec_bien':
 * @property string $cod_bien
 * @property string $nombre
 * @property string $unidad
 * @property integer $stock
 * @property double $precio
 * @property integer $estado
 * @property integer $encontrado
 */
class bien_economato extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return bien_economato the static model class
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
		return 'administracion.ec_bien';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('stock, estado, encontrado', 'numerical', 'integerOnly'=>true),
			array('precio', 'numerical'),
			array('cod_bien, unidad', 'length', 'max'=>10),
			array('nombre', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cod_bien, nombre, unidad, stock, precio, estado, encontrado', 'safe', 'on'=>'search'),
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
			'cod_bien' => 'Código',
			'nombre' => 'Nombre',
			'unidad' => 'Unidad',
			'stock' => 'Stock',
			'precio' => 'Precio',
			'estado' => 'Estado',
			'encontrado' => 'Encontrado',
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

		$criteria->compare('cod_bien',$this->cod_bien,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('unidad',$this->unidad,true);
		$criteria->compare('stock',$this->stock);
		$criteria->compare('precio',$this->precio);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('encontrado',$this->encontrado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}