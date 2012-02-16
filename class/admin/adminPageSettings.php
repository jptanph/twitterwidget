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
        usbuilder()->init($this, $aArgs);
        usbuilder()->getFormAction($sPrefix . 'settings_form','adminExecSave');

        usbuilder()->validator(array('form' => $sPrefix. 'settings_form'));
        /** usbuilder initializer.**/

        $aResult =common()->modelAdmin()->execGetSettings();

        $this->importJs(__CLASS__);
        $this->assign('sImagePath',$sImagePath);
        $this->assign('sPrefix',$sPrefix);
        $this->assign('sUsername',$aResult['username']);
        $this->assign('iPostCount',$aResult['post_count']);
        $this->assign('iIdx',$aResult['idx']);

        $this->view(__CLASS__);
    }
}