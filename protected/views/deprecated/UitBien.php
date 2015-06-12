<?php

/**
 * This is the model class for table "t010_doc_uit_bien".
 *
 * The followings are the available columns in table 't010_doc_uit_bien':
 * @property integer $pk_bienuit
 * @property integer $pk_uit
 * @property integer $fk_proveedor
 * @property string $des_bien
 * @property string $des_marca
 * @property string $num_cantidad
 * @property string $num_precio
 * @property string $cod_temporal
 * @property string $des_umedida
 * @property string $fec_solicitud
 * @property string $fec_recep
 * @property string $fec_registro
 * @property integer $val_solicitado
 * @property integer $val_califica
 * @property integer $val_etiquetado
 * @property integer $val_actualizado

 *
 * The followings are the available model relations:
 * @property Uit $uit
 * @property Proveedor $proveedor
 */
class asdsdsaUitBien extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return T010DocUitBien the static model class
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
		return 't010_doc_uit_bien';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
                return array(
                    array('pk_uit, fk_proveedor', 'required'),
                    array('pk_uit, fk_proveedor, val_solicitado, val_califica, val_etiquetado, val_actualizado', 'numerical', 'integerOnly'=>true),
                    array('des_bien, des_marca, cod_temporal, des_umedida', 'length', 'max'=>50),
                    array('num_cantidad, num_precio', 'length', 'max'=>18),
                    array('fec_solicitud, fec_recep, fec_registro', 'safe'),
                    // The following rule is used by search().
                    // Please remove those attributes that should not be searched.
                    array('pk_bienuit, pk_uit, fk_proveedor, des_bien, des_marca, num_cantidad, num_precio, cod_temporal, des_umedida, fec_solicitud, fec_recep, fec_registro, val_solicitado, val_califica, val_etiquetado, val_actualizado', 'safe', 'on'=>'search'),
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
			'uit' => array(self::BELONGS_TO, 'Uit', 'pk_uit'),
			'proveedor' => array(self::BELONGS_TO, 'Proveedor', 'fk_proveedor'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
                    'pk_bienuit' => 'Pk Bienuit',
                    'pk_uit' => 'Pk Uit',
                    'fk_proveedor' => 'Fk Proveedor',
                    'des_bien' => 'Des Bien',
                    'des_marca' => 'Des Marca',
                    'num_cantidad' => 'Num Cantidad',
                    'num_precio' => 'Num Precio',
                    'cod_temporal' => 'Cod Temporal',
                    'des_umedida' => 'Des Umedida',
                    'fec_solicitud' => 'Fec Solicitud',
                    'fec_recep' => 'Fec Recep',
                    'fec_registro' => 'Fec Registro',
                    'val_solicitado' => 'Val Solicitado',
                    'val_califica' => 'Val Califica',
                    'val_etiquetado' => 'Val Etiquetado',
                    'val_actualizado' => 'Val Actualizado',
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

            $criteria->compare('pk_bienuit',$this->pk_bienuit);
            $criteria->compare('pk_uit',$this->pk_uit);
            $criteria->compare('fk_proveedor',$this->fk_proveedor);
            $criteria->compare('des_bien',$this->des_bien,true);
            $criteria->compare('des_marca',$this->des_marca,true);
            $criteria->compare('num_cantidad',$this->num_cantidad,true);
            $criteria->compare('num_precio',$this->num_precio,true);
            $criteria->compare('cod_temporal',$this->cod_temporal,true);
            $criteria->compare('des_umedida',$this->des_umedida,true);
            $criteria->compare('fec_solicitud',$this->fec_solicitud,true);
            $criteria->compare('fec_recep',$this->fec_recep,true);
            $criteria->compare('fec_registro',$this->fec_registro,true);
            $criteria->compare('val_solicitado',$this->val_solicitado);
            $criteria->compare('val_califica',$this->val_califica);
            $criteria->compare('val_etiquetado',$this->val_etiquetado);
            $criteria->compare('val_actualizado',$this->val_actualizado);

            return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
            ));
        }
}