<?php
require_once('builder/builderInterface.php');

class adminExecSave extends Controller_AdminExec
{
    protected function run($aArgs)
    {
        usbuilder()->init($this, $aArgs);
        usbuilder()->getAppInfo('seq');

        $sUrl = usbuilder()->getUrl('adminPageSettings');

        $aResult = common()->modelAdmin()->execGetSettings($aArgs);

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