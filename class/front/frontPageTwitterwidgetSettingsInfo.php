<?php
require_once('builder/builderInterface.php');

class frontPageTwitterwidgetSettingsInfo extends Controller_Front
{
    protected function run($aArgs)
    {
        $sAppId = $this->Request->getAppID();
        $sImagePath = "/_sdk/img/$sAppId/";
        usbuilder()->init($this, $aArgs);
        $aData = array();
        $aOption['seq'] = $this->getSequence();
        $aResult = common()->modelFront()->execGetUserInfo($aOption);
        $sTwitterUrl = "http://api.twitter.com/1/statuses/user_timeline/".$aResult['username'].".xml?count=".$aResult['post_count']."";
        $xTweetInfo = $this->twitterApi($sTwitterUrl);
        $xData = simplexml_load_string($xTweetInfo);
        $sHtml = '';
        $sHtml .= "<input type='hidden' value='{$aResult['username']}' id='sUsername'  name='sUsername'>";
        $sHtml .= "<input type='hidden' value='{$aResult['post_count']}' id='iDbTweet' name='iDbTweet'>";
        $sHtml .= "<input type='hidden' value='" . count($xData) . "'  id='iTotalTweet' name='iTotalTweet'>";
        $this->assign('sSettingsInfo',$sHtml);
        $this->assign('sUsername',$aResult['username']);
        $this->assign('iDbTotalTweet',$aResult['post_count']);
        $this->assign('iTotalTweet',count($xData));

    }

    public function twitterApi($sUrl)
    {
        $ch = curl_init(); //initialize the CURL library.
        curl_setopt($ch, CURLOPT_URL, $sUrl); // set the URL to post to.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    public function twitter_links($text)
    {
        # convert URLs into links
        $text = preg_replace(
                "#(https?://([-a-z0-9]+\.)+[a-z]{2,5}([/?][-a-z0-9!\#()/?&+]*)?)#i", "<a href='$1' target='_blank'>$1</a>",
                $text);
        # convert protocol-less URLs into links
        $text = preg_replace(
                "#(?!https?://|<a[^>]+>)(^|\s)(([-a-z0-9]+\.)+[a-z]{2,5}([/?][-a-z0-9!\#()/?&+.]*)?)\b#i", "$1<a href='http://$2'>$2</a>",
                $text);

        return $text;
    }
}

