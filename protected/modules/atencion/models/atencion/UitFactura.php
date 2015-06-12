<?php

/**
 * This is the model class for table "t018_atn_uit_factura".
 *
 * The followings are the available columns in table 't018_atn_uit_factura':
 * @property integer $pk_uitfactura
 * @property integer $fk_uitproveedor
 * @property string $des_descripcion
 * @property string $des_area
 * @property string $des_factura
 * @property string $num_gasto
 * @property string $fec_factura
 * @property string $fec_registro
 * @property integer $val_activo
 * 
 * The followings are the available model relations:
 * @property UitProveedor $uitproveedor
 */
class UitFactura extends CActiveRecord
{
        public $selected;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return T018AtnUitFactura the static model class
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
		return 't018atn_uitfactura';
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
			array('fk_uitproveedor, val_activo', 'numerical', 'integerOnly'=>true),
			array('des_factura,des_area', 'length', 'max'=>50),
			array('num_gasto', 'length', 'max'=>18),
			array('des_descripcion,fec_factura', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pk_uitfactura, fk_uitproveedor, des_descripcion, des_factura, num_gasto, fec_factura, fec_registro, val_activo', 'safe', 'on'=>'search'),
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
                        'uitproveedor' => array(self::BELONGS_TO, 'Uitproveedor', 'fk_uitproveedor'),
                );

	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_uitfactura' => 'ID Uit Factura',
			'fk_uitproveedor' => 'ID Uitproveedor',
			'des_descripcion' => 'Descripción del Evento',
                        'des_area' => 'Area',
			'des_factura' => 'Nro. de Factura',
			'num_gasto' => 'Gasto (S/.)',
                        'fec_factura' => 'Fecha de Factura',
			'fec_registro' => 'Fecha de Registro',
                        'selected' => 'Vincular factura con',
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

		$criteria->compare('pk_uitfactura',$this->pk_uit_factura);
		$criteria->compare('fk_uitproveedor',$this->fk_uitproveedor);
		$criteria->compare('des_descripcion',$this->des_descripcion,true);
		$criteria->compare('des_factura',$this->des_factura,true);
		$criteria->compare('num_gasto',$this->num_gasto,true);
		$criteria->compare('fec_registro',$this->fec_registro,true);
		$criteria->compare('val_activo',$this->val_activo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
        function beforeSave() {
            if (parent::beforeSave()) {
                $this->fec_factura = F_TIME::setToMYSQLDate($this->fec_factura);
                return true;
            }
            else
                return false;
        }

        function afterSave() {
            $this->fec_factura = F_TIME::getFromMYSQLDate($this->fec_factura);
        }

        function afterFind() {
            $this->fec_factura = F_TIME::getFromMYSQLDate($this->fec_factura);
        }
}