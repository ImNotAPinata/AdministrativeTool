<?php

/**
 * This is the model class for table "t012_atn_registro".
 *
 * The followings are the available columns in table 't012_atn_registro':
 * @property integer $pk_registro
 * @property integer $fk_solicitud
 * @property integer $fk_actividad
 * @property string $cod_id
 * @property string $des_controller
 * @property string $des_reg
 * @property string $des_name
 * @property string $des_descripcion
 * @property string $fec_registro
 * @property integer $val_activo
 *
 * The followings are the available model relations:
 * @property Solicitud $solicitud
 * @property Actividad $actividad
 */
class Registro extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return T012AtnRegistro the static model class
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
		return 't012atn_registro';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_solicitud, fk_actividad, cod_id, des_controller', 'required'),
			array('fk_solicitud, fk_actividad, val_activo', 'numerical', 'integerOnly'=>true),
			array('cod_id, des_controller, des_reg, des_name', 'length', 'max'=>50),
			array('des_descripcion', 'length', 'max'=>150),
			array('fec_registro', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pk_registro, fk_solicitud, fk_actividad, cod_id, des_controller, des_descripcion, fec_registro, val_activo', 'safe', 'on'=>'search'),
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
			'solicitud' => array(self::BELONGS_TO, 'Solicitud', 'fk_solicitud'),
			'actividad' => array(self::BELONGS_TO, 'Actividad', 'fk_actividad'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pk_registro' => 'ID Registro',
			'fk_solicitud' => 'ID Solicitud',
			'fk_actividad' => 'ID Actividad',
			'cod_id' => 'ID TablaProceso',
			'des_controller' => 'Controlador',
                        'des_reg' => 'Registro de la persona',
                        'des_name' => 'Nombre de la persona',
			'des_descripcion' => 'Descripción',
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

		$criteria->compare('pk_registro',$this->pk_registro);
		$criteria->compare('fk_solicitud',$this->fk_solicitud);
		$criteria->compare('fk_actividad',$this->fk_actividad);
		$criteria->compare('cod_id',$this->cod_id,true);
                $criteria->compare('des_controller',$this->des_controller,true);
                $criteria->compare('des_reg',$this->des_reg,true);
                $criteria->compare('des_name',$this->des_name,true);
                $criteria->compare('des_descripcion',$this->des_descripcion,true);
                $criteria->compare('fec_registro',$this->fec_registro,true);
                $criteria->compare('val_activo',$this->val_activo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function searchActividades()
        {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

            $criteria=new CDbCriteria;
            $criteria->with = array('actividad');
            $criteria->compare('fk_solicitud',$this->fk_solicitud);
            $criteria->compare('t.val_activo',1);
            $criteria->compare('actividad.val_activo',1);

            return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
            ));
        }  
        
        public function searchSpecificActividadinSolcitud($sid,$docid)
        {
            $criteria=new CDbCriteria;
            $criteria->select = 'cod_id';
            $criteria->condition='fk_solicitud=:fk_solicitud and fk_actividad=:fk_actividad and val_activo=1';
            $criteria->params=array(':fk_solicitud'=>$sid,':fk_actividad'=>$docid);
            $criteria->limit = 1; // toda solicitud tendra un formulario uit unico
            
            $model = self::model()->find($criteria);
            if($model === null) { return null; } else { return $model->cod_id; }
        }
}