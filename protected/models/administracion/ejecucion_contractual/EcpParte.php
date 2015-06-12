<?php

/**
 * This is the model class for table "sc_ecp_parte".
 *
 * The followings are the available columns in table 'sc_ecp_parte':
 * @property integer $pk_parte
 * @property integer $fk_documento
 * @property string $des_parte
 * @property string $des_html
 *
 * The followings are the available model relations:
 * @property EcpDocumento $documento
 */
class EcpParte extends CActiveRecord
{
        /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return ScEcpParte the static model class
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
            return 'sc_ecp_parte';
        }

        /**
        * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('fk_documento', 'required'),
                array('fk_documento', 'numerical', 'integerOnly'=>true),
                array('des_parte', 'length', 'max'=>100),
                array('des_html', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('pk_parte, fk_documento, des_parte, des_html', 'safe', 'on'=>'search'),
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
                'documento' => array(self::BELONGS_TO, 'ScEcpDocumento', 'fk_documento'),
            );
        }

        /**
        * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
                'pk_parte' => 'Pk Parte',
                'fk_documento' => 'Fk Documento',
                'des_parte' => 'Des Parte',
                'des_html' => 'Des Html',
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

            $criteria->compare('pk_parte',$this->pk_parte);
            $criteria->compare('fk_documento',$this->fk_documento);
            $criteria->compare('des_parte',$this->des_parte,true);
            $criteria->compare('des_html',$this->des_html,true);

            return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
            ));
        }
} 
?>