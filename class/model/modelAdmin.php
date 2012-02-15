<?php
require_once('builder/builderInterface.php');
define('sPrefix','twitterwidget_');
define('TWITTERWIDGET_SETTINGS', sPrefix . 'settings');


class modelAdmin extends Model
{
    public function execGetSettings()
    {
        $sSql = "SELECT * FROM " . TWITTERWIDGET_SETTINGS;
        return $this->query($sSql,'row');
    }

    public function execSave($aData)
    {
        $sSql = "INSERT INTO " . TWITTERWIDGET_SETTINGS .
                "(post_count,username)
                VALUES
                ({$aData['post_count']},'{$aData['username']}')
                ";
        return $this->query($sSql);
    }

    public function execUpdate($aData)
    {
        $sSql = "UPDATE " . TWITTERWIDGET_SETTINGS . "
            SET post_count = {$aData['post_count']},
            username = '{$aData['username']}'
            WHERE idx = {$aData['idx']}
        ";
        return $this->query($sSql);
    }

}