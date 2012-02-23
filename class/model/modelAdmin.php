<?php
require_once('builder/builderInterface.php');
define('sPrefix','twitterwidget_');
define('TWITTERWIDGET_SETTINGS', sPrefix . 'settings');


class modelAdmin extends Model
{
    public function execGetSettings($aOption)
    {
        $sSql = "SELECT * FROM " . TWITTERWIDGET_SETTINGS ." WHERE seq = " .$aOption['seq'];
        return $this->query($sSql,'row');
    }

    public function execSave($aData)
    {
        $sSql = "INSERT INTO " . TWITTERWIDGET_SETTINGS .
                "(seq,post_count,username)
                VALUES
                ({$aData['seq']},{$aData['post_count']},'{$aData['username']}')
                ";
        return $this->query($sSql);
    }

    public function execUpdate($aData)
    {
        $sSql = "UPDATE " . TWITTERWIDGET_SETTINGS . "
            SET post_count = {$aData['post_count']},
            username = '{$aData['username']}'
            WHERE idx = {$aData['idx']}
            AND seq = {$aData['seq']}
        ";
        return $this->query($sSql);
    }

    public function deleteContentsBySeq($aSeq)
    {
        $sSeqs = implode(',', $aSeq);
        $sQuery = "DELETE FROM " . TWITTERWIDGET_SETTINGS . " WHERE seq in($sSeqs)";
        $mResult = $this->query($sQuery);
        return $mResult;
    }

}