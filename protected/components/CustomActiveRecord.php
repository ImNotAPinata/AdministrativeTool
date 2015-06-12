<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class CustomActiveRecord extends CActiveRecord {
    
    private static $dbadministracion = null;
 
    /*Este */
    protected static function getAdministracionDbConnection()
    {
        if (self::$dbadministracion !== null)
            return self::$dbadministracion;
        else
        {
            self::$dbadministracion = Yii::app()->dbadministracion;
            if (self::$dbadministracion instanceof CDbConnection)
            {
                self::$dbadministracion->setActive(true);
                return self::$dbadministracion;
            }
            else
                throw new CDbException(Yii::t('yii','Active Record requires a "db" CDbConnection application component.'));
        }
    }
            
}

?>
