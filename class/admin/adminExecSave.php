<?php
require_once('builder/builderInterface.php');

class adminExecSave extends Controller_AdminExec
{
    protected function run($aArgs)
    {
        usbuilder()->init($this, $aArgs);

        $sUrl = usbuilder()->getUrl('adminPageSettings');

        $aResult = common()->modelAdmin()->execGetSettings();

        if($aResult)
        {
            $bResult = common()->modelAdmin()->execUpdate($aArgs);
        }
        else
        {
            $bResult = common()->modelAdmin()->execSave($aArgs);
        }
        if($bResult===false){
            usbuilder()->message('Saved failed!', 'warning');
        }else{
            usbuilder()->message('Saved succesfully!', 'success');
        }
        usbuilder()->jsMove($sUrl);
    }
}