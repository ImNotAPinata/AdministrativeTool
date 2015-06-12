<?php

/**
 * This is the model class for table "t000gen_proveedor".
 *
 * The followings are the available columns in table 't000gen_proveedor':
 * @property integer $pk_proveedor
 * @property string $des_identificacion
 * @property string $des_ruc
 * @property string $des_descripcion
 * @property string $des_direccion
 * @property string $des_telefono_1
 * @property string $des_telefono_2
 * @property string $des_fax
 * @property string $des_celular
 * @property string $des_RPM
 * @property string $des_RPC
 * @property string $des_contacto_1
 * @property string $des_contacto_2
 * @property string $fec_registro
 * @property integer $val_activo
 *
 * The followings are the available model relations:
 * @property Servicio[] $servicios
 * @property Uitproveedor[] $uitproveedors
 * 
 */
class Proveedor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return T000GenProveedor the static model class
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
		return 't000gen_proveedor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('des_ruc', 'required'),
                        array('val_activo', 'numerical', 'integerOnly'=>true),
                        array('des_identificacion, des_contacto_1, des_contacto_2', 'length', 'max'=>100),
                        array('des_ruc', 'length', 'max'=>11),
                        array('des_descripcion, des_telefono_1, des_telefono_2, des_fax, des_celular, des_RPM, des_RPC', 'length', 'max'=>50),
                        array('des_direccion', 'length', 'max'=>150),
                        array('fec_registro', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pk_proveedor, des_identificacion, des_ruc, des_descripcion, des_direccion, des_telefono_1, des_telefono_2, des_fax, des_celular, des_RPM, des_RPC, des_contacto_1, des_contacto_2, fec_registro, val_activo', 'safe', 'on'=>'search'),
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
			'uitProveedors' => array(self::HAS_MANY, 'UitProveedor', 'fk_proveedor'),
                        'servicios' => array(self::MANY_MANY, 'Servicio', 't000gen_proveedor_servicio(pk_proveedor, pk_servicio)'),
                        //'proveedorServicios' => array(self::HAS_MANY, 'ProveedorServicio', 'fk_proveedor'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_proveedor' => 'ID Proveedor',
			'des_identificacion' => 'Razón Social/Nombre Completo',
			'des_ruc' => 'RUC',
			'des_direccion' => 'Dirección',
                        'des_descripcion' => 'Descripción',
			'des_telefono_1' => 'Teléfono 1',
			'des_telefono_2' => 'Teléfono 2',
			'des_fax' => 'Fax',
                        'des_celular' => 'Celular',
                        'des_RPM' => 'RPM',
			'des_RPC' => 'RPC',
			'des_contacto_1' => 'Contacto Principal',
			'des_contacto_2' => 'Otro Contacto (Opcional)',
			'fec_registro' => 'Fecha de Registro',
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

		$criteria->compare('pk_proveedor',$this->pk_proveedor);
                $criteria->compare('des_identificacion',$this->des_identificacion,true);
                $criteria->compare('des_ruc',$this->des_ruc,true);
                $criteria->compare('des_descripcion',$this->des_descripcion,true);
                $criteria->compare('des_direccion',$this->des_direccion,true);
                $criteria->compare('des_telefono_1',$this->des_telefono_1,true);
                $criteria->compare('des_telefono_2',$this->des_telefono_2,true);
                $criteria->compare('des_fax',$this->des_fax,true);
                $criteria->compare('des_celular',$this->des_celular,true);
                $criteria->compare('des_RPM',$this->des_RPM,true);
                $criteria->compare('des_RPC',$this->des_RPC,true);
                $criteria->compare('des_contacto_1',$this->des_contacto_1,true);
                $criteria->compare('des_contacto_2',$this->des_contacto_2,true);
                $criteria->compare('fec_registro',$this->fec_registro,true);
                $criteria->compare('val_activo',$this->val_activo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}

