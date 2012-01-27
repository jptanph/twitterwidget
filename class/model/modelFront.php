<?php

require_once('builder/builderInterface.php');
define('sPrefix','twitterwidget_');
define('TWITTERWIDGET_SETTINGS', sPrefix . 'settings');

class modelFront  extends Model
{
    public function execGetUserInfo()
    {
         $sSql = "SELECT * FROM " . TWITTERWIDGET_SETTINGS;
        return $this->query($sSql,'row');
    }
}