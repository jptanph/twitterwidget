<?php
require_once('builder/builderInterface.php');

class frontPageTwitterwidgetNoTweet extends Controller_Front
{
    protected function run($aArgs)
    {
        $sAppId = $this->Request->getAppID();
        $sImagePath = "/_sdk/img/$sAppId/";
        $aData = array();
        $model = new modelFront();

        $aResult = $model->execGetUserInfo();
        $sTwitterUrl = "http://api.twitter.com/1/statuses/user_timeline/".$aResult['username'].".xml?count=".$aResult['post_count']."";
        $xTweetInfo = $this->twitterApi($sTwitterUrl);

        if(!$aResult || strpos($xTweetInfo,'Not found')==55 || strpos($xTweetInfo,'Not authorized')==55 || $xTweetInfo=='' || strpos($xTweetInfo,'Rate limit exceeded.')==55){

        }else{
            $this->fetchClear();
        }

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

