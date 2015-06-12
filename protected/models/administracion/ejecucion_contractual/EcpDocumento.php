<?php

/**
 * This is the model class for table "sc_ecp_documento".
 *
 * The followings are the available columns in table 'sc_ecp_documento':
 * @property integer $pk_documento
 * @property string $des_documento
 * @property integer $cod_tipo
 *
 * The followings are the available model relations:
 * @property EcpParte[] $ecpPartes
 */
class EcpDocumento extends CActiveRecord
{
        /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return ScEcpDocumento the static model class
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
            return 'sc_ecp_documento';
        }

        /**
        * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('cod_tipo', 'numerical', 'integerOnly'=>true),
                array('des_documento', 'length', 'max'=>200),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('pk_documento, des_documento, cod_tipo', 'safe', 'on'=>'search'),
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
                'ecpPartes' => array(self::HAS_MANY, 'ScEcpParte', 'fk_documento'),
            );
        }

        /**
        * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
                'pk_documento' => 'Pk Documento',
                'des_documento' => 'Des Documento',
                'cod_tipo' => 'Cod Tipo',
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

            $criteria->compare('pk_documento',$this->pk_documento);
            $criteria->compare('des_documento',$this->des_documento,true);
            $criteria->compare('cod_tipo',$this->cod_tipo);

            return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
            ));
        }
} 