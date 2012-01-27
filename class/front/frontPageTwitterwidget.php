<?php
require_once('builder/builderInterface.php');

class frontPageTwitterwidget extends Controller_Front
{
    protected function run($aArgs)
    {
        $sAppId = $this->Request->getAppID();
        $sImagePath = "/_sdk/img/$sAppId/";

        $model = new modelFront();

        $aResult = $model->execGetUserInfo();
        $sTwitterUrl = "http://api.twitter.com/1/statuses/user_timeline/".$aResult['username'].".xml?count=".$aResult['post_count']."";
        $xTweetInfo = $this->twitterApi($sTwitterUrl);

        $sHtml = '';
        $sHtml.="<div id='sdk_twitterwidget_wrap' style='width:100%'>";
        $sHtml.="	<div class='sdk_twitterwidget_h_outer_g'>";
        $sHtml.="		<div class='sdk_twitterwidget_h_inner'>";
        $sHtml.="			<p class='sdk_twitterwidget_header'><span class='sdk_twitterwidget_title'>Twitter Widget</span></p>";
        $sHtml.="		</div>";
        $sHtml.="	</div>";
        $sHtml.="	<div class='sdk_twitterwidget_c_outer'>";
        $sHtml.="		<div class='sdk_twitterwidget_c_inner'>";
        $sHtml.="			<div class='sdk_twitterwidget_c_area'>";
        $sHtml.="				<div class='sdk_twitterwidget_content'>";
        $sHtml.="					<div class='sdk_twitterwidget_stockinfo'>";
        $sHtml.="						<div class='sdk_twitterwidget_stockinfo_maincontent'>";
        $sHtml.="							<div id='sdk_twitterwidget_holder'>";
        $sHtml.="								<div id='sdk_twitterwidget_container_blue'>";
        $sHtml.="									<div id='sdk_twitterwidget_expand'>";
        if(!$aResult || strpos($xTweetInfo,'Not found')==55 || strpos($xTweetInfo,'Not authorized')==55 || $xTweetInfo=='' || strpos($xTweetInfo,'Rate limit exceeded.')==55){
                $sHtml.="										<center><b>&nbsp;&nbsp;Please check your configuration settings.</b></center>";
        }else{
       		$xData = simplexml_load_string($xTweetInfo);
            $sHtml.="											<ul class='sdk_twitterwidget_feeds' style='overflow-x:hidden;overflow-y:auto;'>";


            foreach($xData as $rows){
                $sTime = date('D M j @ g:i A', strtotime($rows->created_at) + 0 * 60);
                $sMessage = $this->twitter_links($rows->text);

                $sHtml.="												<li class='sdk_twitterwidget_item'  style='width:97%;border-bottom:1'>";
                $sHtml.="													<img src='{$rows->user->profile_image_url}' style='width:30px;height:30px;'/>";
                $sHtml.="													<div>";
                $sHtml.="		                								<p class='sdk_twitterwidget_text'><strong class='sdk_twitterwidget_user'><a target='_blank' href='http://www.twitter.com/'>{$aResult['username']}</a></strong>{$sMessage}</p>";
                $sHtml.="														<p><span class='sdk_twitterwidget_stamp'>{$sTime}</span></p>";
                $sHtml.="													</div>";
                $sHtml.="												</li>";
            }
            $sHtml.="										    </ul>";
        }
        $sHtml.="									</div>";
        $sHtml.="								</div>";
        $sHtml.="							</div>";
        $sHtml.="						</div>";
        $sHtml.="					</div>";
        $sHtml.="				</div>";
        $sHtml.="			</div>";
        $sHtml.="		</div>";
        $sHtml.="	</div>";
        $sHtml.="</div>";
        $this->importCss(__CLASS__);
        $this->assign('sImagePath',$sImagePath);
        $this->assign('twitterwidget',$sHtml);
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

