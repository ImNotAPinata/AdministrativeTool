<?php

/**
 * This is the model class for table "t000gen_servicio".
 *
 * The followings are the available columns in table 't000gen_servicio':
 * @property integer $pk_proveedorservicios
 * @property string $des_descripcion
 * @property string $des_categoria
 * @property string $fec_registro
 *
 * The followings are the available model relations:
 * @property Proveedor[] $proveedors
 */

class Servicio extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return T000genServicio the static model class
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
        return 't000gen_servicio';
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
            array('des_descripcion', 'length', 'max'=>200),
            array('des_categoria', 'length', 'max'=>50),
            array('fec_registro', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('pk_proveedorservicios, des_descripcion, des_categoria, fec_registro', 'safe', 'on'=>'search'),
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
            'proveedors' => array(self::MANY_MANY, 'Proveedor', 't000gen_proveedor_servicio(pk_servicio, pk_proveedor)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'pk_proveedorservicios' => 'Pk Proveedorservicios',
            'des_descripcion' => 'Des Descripcion',
            'des_categoria' => 'Des Categoria',
            'fec_registro' => 'Fec Registro',
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

        $criteria->compare('pk_proveedorservicios',$this->pk_proveedorservicios);
        $criteria->compare('des_descripcion',$this->des_descripcion,true);
        $criteria->compare('des_categoria',$this->des_categoria,true);
        $criteria->compare('fec_registro',$this->fec_registro,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
} 