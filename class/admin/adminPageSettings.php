<?php
require_once('builder/builderInterface.php');

class adminPageSettings extends Controller_Admin
{
    protected function run($aArgs)
    {
        $sAppId = $this->Request->getAppID();
        $sImagePath = "/_sdk/img/$sAppId/";
        $sPrefix = $sAppId . '_';

        /** usbuilder initializer.**/
        $sInitScript = usbuilder()->init($this->Request->getAppID(), $aArgs);
        $sFormScript = usbuilder()->getFormAction($sPrefix . 'settings_form','adminExecSave');
        $this->writeJs($sFormScript);
        $this->writeJs($sInitScript);
        usbuilder()->validator(array('form' => $sPrefix. 'settings_form'));
        /** usbuilder initializer.**/
        $model = new modelAdmin();
        $aResult = $model->execGetSettings();


        $this->importJs(__CLASS__);
        $this->assign('sImagePath',$sImagePath);
        $this->assign('sPrefix',$sPrefix);
        $this->assign('sUsername',$aResult['username']);
        $this->assign('iPostCount',$aResult['post_count']);
        $this->assign('iIdx',$aResult['idx']);

        $this->view(__CLASS__);
    }
}