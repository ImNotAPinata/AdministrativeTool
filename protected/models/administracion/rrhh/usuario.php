<?php

/**
 * This is the model class for table "administracion.usuario".
 *
 * The followings are the available columns in table 'administracion.usuario':
 * @property integer $idusuario
 * @property string $cusuario
 * @property string $cpass
 * @property string $cnombre
 * @property string $nombres
 * @property string $apellidos
 * @property string $registro
 * @property string $ctipo
 * @property string $area
 * @property integer $perfil
 * @property integer $estado
 * @property string $fregistro
 * @property string $usuario
 * @property string $estacion
 * 
 * CustomActiveRecord
 */
class Usuario extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return usuario the static model class
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
		return 'usuario';
	}
        /*
        public function getDbConnection()
        {
            return self::getAdministracionDbConnection();
        }*/


	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('perfil, estado', 'numerical', 'integerOnly'=>true),
			array('cusuario', 'length', 'max'=>40),
			array('cpass, cnombre, nombres, apellidos', 'length', 'max'=>255),
			array('registro, ctipo', 'length', 'max'=>4),
			array('area', 'length', 'max'=>11),
			array('usuario, estacion', 'length', 'max'=>15),
			array('fregistro', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idusuario, cusuario, cpass, cnombre, nombres, apellidos, registro, ctipo, area, perfil, estado, fregistro, usuario, estacion', 'safe', 'on'=>'search'),
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
			'idusuario' => 'Idusuario',
			'cusuario' => 'Cusuario',
			'cpass' => 'Cpass',
			'cnombre' => 'Cnombre',
			'nombres' => 'Nombres',
			'apellidos' => 'Apellidos',
			'registro' => 'Registro',
			'ctipo' => 'Ctipo',
			'area' => 'Area',
			'perfil' => 'Perfil',
			'estado' => 'Estado',
			'fregistro' => 'Fregistro',
			'usuario' => 'Usuario',
			'estacion' => 'Estacion',
                        'UsuarioFullname'=>'Nombre & Apellidos',
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

		$criteria->compare('idusuario',$this->idusuario);
		$criteria->compare('cusuario',$this->cusuario,true);
		$criteria->compare('cpass',$this->cpass,true);
		$criteria->compare('cnombre',$this->cnombre,true);
		$criteria->compare('nombres',$this->nombres,true);
		$criteria->compare('apellidos',$this->apellidos,true);
		$criteria->compare('registro',$this->registro,true);
		$criteria->compare('ctipo',$this->ctipo,true);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('perfil',$this->perfil);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('fregistro',$this->fregistro,true);
		$criteria->compare('usuario',$this->usuario,true);
		$criteria->compare('estacion',$this->estacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getUsuariobyUsername($user)
        {
            return Usuario::model()->findByAttributes(
                    array('cusuario' => $user)
                    ); 
        }
        
        public function getUsuarioFullname()
        {
            return $this->apellidos.', '.$this->nombres;
        }
        
        public function validatePassword($password)
        {
            return $this->hashPassword($password)===$this->cpass;
        }
        
        private function hashPassword($password)
        {
            return md5($password);
        }
}