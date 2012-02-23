<?php

require_once('builder/builderInterface.php');
define('sPrefix','twitterwidget_');
define('TWITTERWIDGET_SETTINGS', sPrefix . 'settings');

class modelFront  extends Model
{
    public function execGetUserInfo($aOption)
    {
         $sSql = "SELECT * FROM " . TWITTERWIDGET_SETTINGS . " WHERE seq = " . $aOption['seq'] ;
        return $this->query($sSql,'row');
    }
}