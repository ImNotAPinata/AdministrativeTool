<?php

/**
 * This is the model class for table "t015_atn_movimiento".
 *
 * The followings are the available columns in table 't015_atn_movimiento':
 * @property integer $pk_movimiento
 * @property string $des_movimiento
 * @property string $des_naturaleza
 * @property string $des_reg_responsable
 * @property integer $val_activo
 *
 * The followings are the available model relations:
 * @property Tramite[] $tramites
 */
class Movimiento extends CActiveRecord
{
        /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return T015AtnMovimiento the static model class
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
            return 't014atn_movimiento';
        }

        /**
        * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('des_movimiento', 'required'),
                array('val_activo', 'numerical', 'integerOnly'=>true),
                array('des_movimiento, des_naturaleza', 'length', 'max'=>50),
                array('des_reg_responsable', 'length', 'max'=>100),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('pk_movimiento, des_movimiento, des_naturaleza, des_reg_responsable, val_activo', 'safe', 'on'=>'search'),
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
                'tramites' => array(self::HAS_MANY, 'T013AtnTramite', 'fk_movimiento'),
            );
        }

        /**
        * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
                'pk_movimiento' => 'ID Movimiento',
                'des_movimiento' => 'Descripción',
                'des_naturaleza' => 'Naturaleza',
                'des_reg_responsable' => 'Responsable',
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

            $criteria->compare('pk_movimiento',$this->pk_movimiento);
            $criteria->compare('des_movimiento',$this->des_movimiento,true);
            $criteria->compare('des_naturaleza',$this->des_naturaleza,true);
            $criteria->compare('des_reg_responsable',$this->des_reg_responsable,true);
            $criteria->compare('val_activo',$this->val_activo);

            return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
            ));
        }
} 

?>