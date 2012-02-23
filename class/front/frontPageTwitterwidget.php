<?php
require_once('builder/builderInterface.php');

class frontPageTwitterwidget extends Controller_Front
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

        if(!$aResult || strpos($xTweetInfo,'Not found')==55 || strpos($xTweetInfo,'Not authorized')==55 || $xTweetInfo=='' || strpos($xTweetInfo,'Rate limit exceeded.')==55){
            $this->fetchClear();
        }else{
            $xData = simplexml_load_string($xTweetInfo);
             foreach($xData as $rows){
                $sTime = date('D M j @ g:i A', strtotime($rows->created_at) + 0 * 60);
                $sMessage = $this->twitter_links($rows->text);
                $aData[] = array(
                    'sImage' => $rows->user->profile_image_url,
                    'sTimeTweet' => $sTime,
                    'sMessage' => $this->twitter_links($rows->text),
                    'sUsername' => $aResult['username'],
                    'sUserTwitterUrl' => "http://www.twitter.com/{$aResult['username']}"
                );
            }
            $this->loopFetch($aData);
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

