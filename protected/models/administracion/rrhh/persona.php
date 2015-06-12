<?php

/**
 * This is the model class for table "administracion.rh_persona".
 *
 * The followings are the available columns in table 'administracion.rh_persona':
 * @property string $idpersona
 * @property string $num_registro
 * @property string $nom_persona
 * @property string $ape_persona
 * @property string $nom_sobrenombre
 * @property string $cod_tipdocumento
 * @property string $num_docidentidad
 * @property string $dir_persona
 * @property string $num_telefono
 * @property string $num_celular
 * @property string $num_anexo
 * @property string $fec_nacimiento
 * @property string $sex_persona
 * @property string $cod_parentesco
 * @property string $nom_apoderado
 * @property string $num_dniapoderado
 * @property string $cod_educacion
 * @property string $nom_universidad
 * @property string $cod_especialidad
 * @property string $cod_uuoo
 * @property string $cod_tipmodalidad
 * @property string $cod_categoria
 * @property string $nom_correo
 * @property integer $estado
 * @property string $cod_usumodif
 * @property string $fec_usumodif
 * @property string $maq_usumodif
 * 
 * CustomActiveRecord
 */
class Persona extends CActiveRecord
{
        /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return persona the static model class
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
		return 'rh_persona';
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
			array('maq_usumodif', 'required'),
			array('estado', 'numerical', 'integerOnly'=>true),
			array('num_registro', 'length', 'max'=>4),
			array('nom_persona, ape_persona, nom_apoderado, nom_universidad', 'length', 'max'=>80),
			array('nom_sobrenombre, nom_correo', 'length', 'max'=>50),
			array('cod_tipdocumento, cod_parentesco, cod_educacion, cod_especialidad, cod_tipmodalidad, cod_categoria', 'length', 'max'=>5),
			array('num_docidentidad', 'length', 'max'=>20),
			array('dir_persona', 'length', 'max'=>120),
			array('num_telefono, num_celular, num_anexo', 'length', 'max'=>12),
			array('sex_persona', 'length', 'max'=>1),
			array('num_dniapoderado', 'length', 'max'=>8),
			array('cod_uuoo', 'length', 'max'=>6),
			array('cod_usumodif, maq_usumodif', 'length', 'max'=>16),
			array('fec_nacimiento, fec_usumodif, cargo', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idpersona, num_registro, nom_persona, ape_persona, nom_sobrenombre, cod_tipdocumento, num_docidentidad, dir_persona, num_telefono, num_celular, num_anexo, fec_nacimiento, sex_persona, cod_parentesco, nom_apoderado, num_dniapoderado, cod_educacion, nom_universidad, cod_especialidad, cod_uuoo, cod_tipmodalidad, cod_categoria, nom_correo, estado, cod_usumodif, fec_usumodif, maq_usumodif', 'safe', 'on'=>'search'),
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
			'idpersona' => 'Idpersona',
			'num_registro' => 'Registro',
			'nom_persona' => 'Nombres',
			'ape_persona' => 'Apellidos',
			'nom_sobrenombre' => 'Sobrenombre',
			'cod_tipdocumento' => 'Tipo de Documento de Identidad',
			'num_docidentidad' => 'Numero de Documento de Identidad',
			'dir_persona' => 'Dirección de la Persona',
			'num_telefono' => 'Telefono',
			'num_celular' => 'Celular',
			'num_anexo' => 'Anexo',
			'fec_nacimiento' => 'Fecha de Nacimiento',
			'sex_persona' => 'Sexo',
			'cod_parentesco' => 'Cod Parentesco',
			'nom_apoderado' => 'Nom Apoderado',
			'num_dniapoderado' => 'Num Dniapoderado',
			'cod_educacion' => 'Cod Educacion',
			'nom_universidad' => 'Nom Universidad',
			'cod_especialidad' => 'Cod Especialidad',
			'cod_uuoo' => 'Cod Uuoo',
			'cod_tipmodalidad' => 'Cod Tipmodalidad',
			'cod_categoria' => 'Cod Categoria',
			'nom_correo' => 'Nom Correo',
			'estado' => 'Estado',
			'cod_usumodif' => 'Cod Usumodif',
			'fec_usumodif' => 'Fec Usumodif',
			'maq_usumodif' => 'Maq Usumodif',
                        'cargo' => 'Cargo'
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

		$criteria->compare('idpersona',$this->idpersona,true);
		$criteria->compare('num_registro',$this->num_registro,true);
		$criteria->compare('nom_persona',$this->nom_persona,true);
		$criteria->compare('ape_persona',$this->ape_persona,true);
		$criteria->compare('nom_sobrenombre',$this->nom_sobrenombre,true);
		$criteria->compare('cod_tipdocumento',$this->cod_tipdocumento,true);
		$criteria->compare('num_docidentidad',$this->num_docidentidad,true);
		$criteria->compare('dir_persona',$this->dir_persona,true);
		$criteria->compare('num_telefono',$this->num_telefono,true);
		$criteria->compare('num_celular',$this->num_celular,true);
		$criteria->compare('num_anexo',$this->num_anexo,true);
		$criteria->compare('fec_nacimiento',$this->fec_nacimiento,true);
		$criteria->compare('sex_persona',$this->sex_persona,true);
		$criteria->compare('cod_parentesco',$this->cod_parentesco,true);
		$criteria->compare('nom_apoderado',$this->nom_apoderado,true);
		$criteria->compare('num_dniapoderado',$this->num_dniapoderado,true);
		$criteria->compare('cod_educacion',$this->cod_educacion,true);
		$criteria->compare('nom_universidad',$this->nom_universidad,true);
		$criteria->compare('cod_especialidad',$this->cod_especialidad,true);
		$criteria->compare('cod_uuoo',$this->cod_uuoo,true);
		$criteria->compare('cod_tipmodalidad',$this->cod_tipmodalidad,true);
		$criteria->compare('cod_categoria',$this->cod_categoria,true);
		$criteria->compare('nom_correo',$this->nom_correo,true);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('cod_usumodif',$this->cod_usumodif,true);
		$criteria->compare('fec_usumodif',$this->fec_usumodif,true);
		$criteria->compare('maq_usumodif',$this->maq_usumodif,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getFullName()
        {
            return F_String::getUpperStartedLowerFollowedWord($this->ape_persona.', '.$this->nom_persona);
        }
        
        public function getFullNameByReg($reg)
        {
            if($reg !== null){
                $criteria=new CDbCriteria;
                $criteria->select='nom_persona,ape_persona';
                $criteria->condition='num_registro=:num_registro and estado=1';
                $criteria->params=array(':num_registro'=>$reg);

                $model = self::model()->find($criteria);
                if($model === null) { return "Nro. de registro cambiado o eliminado"; }
                else { return F_String::getUpperStartedLowerFollowedWord($model->ape_persona.', '.$model->nom_persona); }
            }
            else { return "Persona no existe"; }
        }
        
        public function getPersonalByUuoo($uuoo = null)
        {
            if($uuoo == null) { $uuoo = Yii::app()->params->defaultArea;}
            
            $criteria=new CDbCriteria;
            $criteria->select='nom_persona,ape_persona,num_registro,cod_uuoo,cargo,nom_correo';
            $criteria->condition='cod_uuoo=:cod_uuoo and estado=1 and idpersona != (select idpersona from rh_jefe where cod_uuoo = "'.$uuoo.'" and fec_fin is null )';
            $criteria->order='cargo';
            $criteria->params=array(':cod_uuoo'=>$uuoo);
            
            $model = self::model()->findall($criteria);
            if($model === null) { return null; }
            else { return $model; }
        }
        
        public function getJefeByUuoo($uuoo = null)
        {
            //como el sistema es para los procesos internos de administracion todos los pedidos van a percy directamente
            //tanto internos como externos, en caso de que se decida cambiar eso los pedidos irian a los jefes de las uuoo
            //especificiadas
            if($uuoo == null) { $uuoo = Yii::app()->params->defaultArea;}
            
            $criteria=new CDbCriteria;
            $criteria->select='nom_persona,ape_persona,num_registro';
            $criteria->condition='cod_uuoo=:cod_uuoo and estado=1 and idpersona = (select idpersona from rh_jefe where cod_uuoo = "'.$uuoo.'" and fec_fin is null )';
            $criteria->params=array(':cod_uuoo'=>$uuoo);
            
            $model = self::model()->find($criteria);
            if($model === null) { return null; }
            else { return $model; }
        }
        
        public function getPersonaByReg($reg)
        {
            $model =  Persona::model()->findByAttributes(
                    array('num_registro' => $reg)
                    );
            if($model === null) { return null; }
            else { return $model; }
        }
        
        public function getResponsablesUIT()
        {
            $sql1 = "select 'Area Usuaria' as valor ";
            $sql2 = "union ";
            $sql3 = "select concat(ape_persona,' ',nom_persona) as valor from rh_persona
                     where cargo = 'Requerimiento < 3 UIT' or cargo = 'Economato & Bienes Patrimoniales'";
            
            $query = Yii::app()->db->createCommand($sql1 . $sql2 . $sql3)->queryall();
            $responsables = array();
            foreach ($query as $row) {
                $data = F_String::getUpperStartedLowerFollowedWord($row['valor']);
                $responsables += array($data=>$data);
            }
            return $responsables;
        }
        
        public function getSelectedInfoFormPersona($select,$reg)
        {
            $criteria=new CDbCriteria;
            if($select != null) { $criteria->select=$select; }
            $criteria->condition='num_registro=:num_registro and estado=1';
            $criteria->params=array(':num_registro'=>$reg);
            
            $model = self::model()->find($criteria);
            if($model === null) { return null; }
            else { return $model; }
        }
        
        public function getUsuariosFromArea($area = null)
        {
            if($area == null) { $area = Yii::app()->params->defaultArea;}
            
            $sql = "select cusuario from administracion.rh_persona p inner join administracion.usuario u on p.num_registro = u.registro where p.cod_uuoo = '$area'";
            
            $result = Yii::app()->db->createCommand($sql)->queryColumn();
            return $result;
        }
        
}