<div class="msg_suc_box" style="display:none" id="update_status_message">
                <p><span>Saved successfully.</span></p>
            </div>
            
            <div class="msg_suc_box" style="display:none" id="restore_status_message">
                <p><span>Setting Restored successfully.</span></p>
            </div>                  
            <!-- // message box -->
            
            <h3>Settings</h3>
            <p>Plugin ID : Simpletwitter</p>
            <p class="require"><span class="neccesary">*</span> Required</p>
            <!-- input area -->         

            <table border="1" cellspacing="0" class="table_input_vr">
            <colgroup>
                <col width="115px" />
                <col width="*" />
            </colgroup>
            <tr>
                <th><label for="show_html_value">Count of Post</label></th>
                <td class="move">

                    <input type="hidden" name="skin-hide"/>
                    <select title="select rows" class="rows" id="c_post" name="c_post" >
                        <option value="1" id="1" {if $aData.psd_count_status==1}selected{/if} value="1">1</option>
                        <option value="2" id="2"  {if $aData.psd_count_status==2}selected{/if} value="2">2</option>
                        <option value="3" id="3"  {if $aData.psd_count_status==3}selected{/if} value="3">3</option>
                        <option value="4" id="4"  {if $aData.psd_count_status==4}selected{/if} value="4">4</option>
                        <option value="5" id="5"  {if $aData.psd_count_status==5}selected{/if} value="5">5</option>
                        <option value="6" id="6"  {if $aData.psd_count_status==6}selected{/if} value="6">6</option>
                        <option value="7" id="7"  {if $aData.psd_count_status==7}selected{/if} value="7">7</option>
                        <option value="8" id="8"  {if $aData.psd_count_status==8}selected{/if} value="8">8</option>
                        <option value="9" id="9"  {if $aData.psd_count_status==9}selected{/if} value="9">9</option>
                        <option value="10" id="10"  {if $aData.psd_count_status==10 || $aData.psd_count_status==0}selected{/if}  value="10">10</option>
                    </select>
                    <span class="limit">
                        <span id="span-required" style="display:none;">Required Field</span>
                        <span id="span-letters" style="display:none;">Please Input Number</span>
                        <span id="span-max" style="display:none;">Maximum number is 10</span>
                        <span id="span-min" style="display:none;">Minimum number is 1</span>
                        <span id='span-limit'>write within 1 to 10</span>
                    </span>

                </td>
            </tr>
            <tr>
                <th><label for="show_html_value">Username</label></th>
                <td>
                    <span class="neccesary">*</span> <input type="text" id="username" value="{$aData.psd_username}" class="fix" name="username"/>
                    <br />&nbsp;&nbsp;&nbsp;E.G. (adietan63)
                    <span class="limit">
                        <span id="span-username" style="display:none;">Required Field</span>
                    </span>
                </td>
            </tr>
            <tr>
                <th>Width</th>
                <td class="move">
                    <div id="image_list_wrap">
                        <input type="hidden" name="plugin_url" id="plugin_url" value="{$PLUGIN_URL}">
                        <input type="radio" value="automatic" {if $aData.psd_width_type=='automatic' || $aData.psd_width_type==''}checked="checked"{/if} class="input_rdo" onclick="execAutomatic()" checked="checked"  id="automatic" name="plugin_width" /> <label class="lbl_rgt" for="automatic">Adjust Automatically</label>
                        <input type="radio" value="customized"  {if $aData.psd_width_type=='customized'}checked="checked"{/if} class="input_rdo" onclick="execCustomizedWidth()" id="customized"  name="plugin_width"/> <label  for="customized"class="lbl_rgt">Customize</label>
                        <p class="image" id="customized_form" {if $aData.psd_width_type=='automatic' ||  $aData.psd_width_type==''}style="display:none;"{/if}>
                            <span class="neccesary">*</span> 
                            <input type="text" class="fix" style="width:60px" id="width_size" value="{if $aData.psd_percent_pixel!=0}{$aData.psd_percent_pixel}{/if}" maxlength="4" size="4">
                            <select id="width_type">
                                <option id="1" value="pixel" {if $aData.psd_width_size_type=='pixel' || $aData.psd_width_size_type==''}selected="selected"{/if}>pixel</option>
                                <option id="2" value="percent"{if $aData.psd_width_size_type=='percent'}selected="selected"{/if}>percent</option>
                            </select>
                            <span class="neccesary" id="width_error"></span> 
                        </p>    
                    </div>
                </td>
            </tr>       
            <tr>
                <th>Template</th>
                <td class="move">           
                    <script type="text/javascript">
                    //<![CDATA[
                        function image_list(){
                        var list = document.getElementById('image_list_wrap');
                        var upload = document.getElementById('image_upload_wrap'); 
                            if(list.style.display == 'none'){
                                list.style.display='';
                                upload.style.display='none';
                            }
                        }
                        function image_upload(){
                        var list = document.getElementById('image_list_wrap');
                        var upload = document.getElementById('image_upload_wrap'); 
                            if(upload.style.display == 'none'){
                                list.style.display='none';
                                upload.style.display='';
                            }
                        }
                    //]]>
                    </script>
                    <!-- Select form The image List -->
                    <div id="image_list_wrap">
                        <input type="radio" value="0" class="input_rdo" checked="checked"  id="blue" name="choose_theme" {if $aData.psd_skin_flag eq 0}CHECKED{/if} /> <label class="lbl_rgt" for="blue">Blue</label>
                        <input type="radio" value="1" class="input_rdo" id="gray"  name="choose_theme" {if $aData.psd_skin_flag eq 1}CHECKED{/if}/> <label class="lbl_rgt" for="gray">Gray</label>
                        <p class="image">
                            <label for="blue"><img src="images/u121_original.png" alt="" /></label>
                            <label for="gray"><img src="images/u123_original.png" alt="" /></label>
                        </p>                        
                    </div>
                </td>
            </tr>
            </table>
            <script type="text/javascript"> 
            //<![CDATA[
            function chk_validate (){
                document.getElementById('module_label_wrap').className='warn_border';
            }
            //]]>
            </script>
            <div class="tbl_lb_wide_btn">
                <a href="#" class="btn_apply" title="Save changes" id="save-settings" >Save</a>
                <a href="#" class="add_link" id="restore-settings" title="Reset to default">Reset to Default</a>
            </div>