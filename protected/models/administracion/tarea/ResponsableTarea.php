<?php

/**
 * This is the model class for table "ac_responsabletarea".
 *
 * The followings are the available columns in table 'ac_responsabletarea':
 * @property string $id_tarea
 * @property string $reg_resp
 * @property integer $es_titular
 * @property integer $es_activo
 * @property string $fec_registro
 * @property string $fec_fin
 */
class Responsabletarea extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AcResponsabletarea the static model class
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
		return 'ac_responsabletarea';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('es_titular, es_activo', 'numerical', 'integerOnly'=>true),
			array('id_tarea', 'length', 'max'=>10),
			array('reg_resp', 'length', 'max'=>5),
			array('fec_registro, fec_fin', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_tarea, reg_resp, es_titular, es_activo, fec_registro, fec_fin', 'safe', 'on'=>'search'),
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
			'id_tarea' => 'Id Tarea',
			'reg_resp' => 'Reg Resp',
			'es_titular' => 'Es Titular',
			'es_activo' => 'Es Activo',
			'fec_registro' => 'Fec Registro',
			'fec_fin' => 'Fec Fin',
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

		$criteria->compare('id_tarea',$this->id_tarea,true);
		$criteria->compare('reg_resp',$this->reg_resp,true);
		$criteria->compare('es_titular',$this->es_titular);
		$criteria->compare('es_activo',$this->es_activo);
		$criteria->compare('fec_registro',$this->fec_registro,true);
		$criteria->compare('fec_fin',$this->fec_fin,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getTitularesFromIdTarea($idTarea)
        {
            $query = "select rp.nom_correo as correo from ac_responsabletarea rt 
                      inner join rh_persona rp on rt.reg_resp = rp.num_registro 
                      where rt.es_titular = 1 and rp.estado = 1 
                      and rt.es_activo = 1 and rt.id_tarea = $idTarea;";
        
            $query = Yii::app()->db->createCommand($query)->queryall();
            $responsables = array();
            foreach ($query as $row) {
                array_push($responsables, $row['correo']);
            }
            return $responsables;
        }
        
        public function getSuplentesFromIdTarea($idTarea)
        {
            $query = "select rp.nom_correo as correo from ac_responsabletarea rt 
                      inner join rh_persona rp on rt.reg_resp = rp.num_registro 
                      where rt.es_titular = 0 and rp.estado = 1 
                      and rt.es_activo = 1 and rt.id_tarea = $idTarea;";
        
            $query = Yii::app()->db->createCommand($query)->queryall();
            $responsables = array();
            foreach ($query as $row) {
                array_push($responsables, $row['correo']);
            }
            return $responsables;
        }
}