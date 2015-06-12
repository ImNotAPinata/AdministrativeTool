<?php

// uncomment the following to define a path alias
//Yii::setPathOfAlias('local','http://pcg050:8080/appwebadministracion/');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Centro de Atención - Oficina de Soporte Administrativo',

	// preloading 'log' component
	'preload'=>array('log','bootstrap'),
        'language'=>'es',
        'charset' => 'ISO-8859-1',
    
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
                'application.extensions.*',
                'application.helpers.*',
                'application.models.administracion.rrhh.*',
                'application.models.administracion.tarea.*',
                'application.models.administracion.bien.*',
                'application.models.administracion.proveedor.*',
                'application.models.administracion.enums.*',
                'application.models.administracion.tarea.enums.*',
                'application.models.administracion.ejecucion_contractual.*',
                'application.models.resource.upload.*',
	),

	'modules'=>array(
		'atencion',
                'mantenedores',
                //'reportes',
                // uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'12345',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
                        'generatorPaths'=>array('bootstrap.gii'),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
                        'class' => 'WebUser',
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
                        'showScriptName'=>false,
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                        ),
		),
                
            
		'db'=>array(
			'connectionString' => 'mysql:host=127.0.0.1;port=3306;dbname=administracion',//'mysql:host=localhost;dbname=dbatencion',
			'emulatePrepare' => true,
			'username' => 'local',
			'password' => '1234', //admin en PCJERRY
			'charset' => 'latin1',
                        'enableParamLogging'=>true 
		),
                
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
                    'errorAction'=>'site/error',
                ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),*/
				
			),
		),
                'coreMessages'=>array(
                        'basePath'=>null, 
                ),
                'bootstrap'=>array(
                    'class'=>'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
                ),
                'mailer' => array(
                    'class' => 'application.extensions.mailer.EMailer',
                    'pathViews' => 'application.views.email',
                    'pathLayouts' => 'application.views.email.layouts'
                ),
	),

	// application-level parameters that can be accessed
        // using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'maker' => 'Jerry Enrique Sanchez Betancourt',
                'email' => 'jerrysb7788@gmail.com', // Por si tienen alguna duda, me pueden contactar
                'cel' => '943989899',
            
                'showDebugInfo'=> true, // mostrar los mensajes de excepciones trycatch etc. (false en produccion)
                'currentWebMaster' => 'admin', // usuario webmaster
                'currentWebMasterMail'=> 'prac-jsanchezb@sunat.gob.pe',
                'currentJefeAdministracion' => 'pfernand', // current jefe de administracion
                'currentFotoPath' => "http://pce256/administracion/admindoc/repositorio/recursoshumanos/fotos/",
                'defaultWebLocation' => 'http://pce256/Xadministracion/', //localizacion por defecto
                'defaultUploadLocation' => 'E:\\Apache2\\htdocs\\Xadministracion\\archivos\\', //localizacion por defecto
                'defaultArea' => '400300',  // area administrativa
                'defaultPrioridad' => '3', // normal
                'defaultPageSize' => '10', // tamaño de la pagina
                'defaultErrorMessage' => 'Se ha producido un error. Si el problema persiste, comuníquese con el administrador',
                'defaultErrorPageMessage' => 'La página solicitida no existe. Contáctese con el administrador.',
                
	),
        // NOTAS:
        // 1. Debido a que yii declara muchas de clases como privado, este no muestra la informacion del contenido
        // Pero si se desea ver se debe instanciar una variable que contenga el contenido de $model->attributes
        // 2. Para usar el debugger se debe de descomentar lo siguiente -->;zend_extension = "D:\Programas\xampp\php\ext\php_xdebug.dll"
        // del archivo de configuracion php.ini, aunque usar el debugger vuelve lento la pagina web, por lo que solo se debe de usar en
        // en desarrollo, mas no en testing.
        // 3. existe un bug con datepicker cuando se trata de buscar la informacion en el sgte. formato d/m/yyyy , al serializar
        // no se serializa correctamente ese formato por lo cual se puede parchar  'usando' el formato 'yy-mm-dd',
        // por motivo de tiempo lo dejo parchado, pero no creo que sea dificil arreglar ese bug.
        //
);  