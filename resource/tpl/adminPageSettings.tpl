<form id="<?php echo $sPrefix;?>settings_form" class="<?php echo $sPrefix?>settings_form" name="<?php echo $sPrefix;?>settings_form" method="post">
<input type="hidden" name="idx" id="idx" value="<?php echo $iIdx;?>">
<p class="require"><span class="neccesary">*</span> Required</p>
<table border="1" cellspacing="0" class="table_input_vr" style="margin-bottom:3px;">
<colgroup>
	<col width="115px" />
	<col width="*" />
</colgroup>
<tr>
	<th><label for="show_html_value">Count of Post</label></th>
	<td class="move">

		<input type="hidden" name="skin-hide"/>&nbsp;&nbsp;
		<select title="select rows" class="rows" id="post_count" name="post_count" >
			<?php for($i = 1 ; $i <=10 ; $i++){?>
				<option value="<?php echo $i;?>" id="<?php echo $i;?>" <?php if($iPostCount==$i){ ?> selected="selected"<?php } ?>><?php echo $i;?></option>
			<?php }?>
		</select>
	</td>
</tr>
<tr>
	<th><label for="show_html_value">Username</label></th>
	<td>
		<span class="neccesary">*</span> <input type="text" fw-filter="isFill"  id="username" value="<?php echo $sUsername; ?>" class="fix" name="username" maxlength="15"/>
		<br />&nbsp;&nbsp;&nbsp;E.G. (adietan63)
		<span class="limit">
			<span id="span-username" style="display:none;">Required Field</span>
		</span>
	</td>
</tr>
</table>
</form>

<script type="text/javascript">
//<![CDATA[
function chk_validate (){
	document.getElementById('module_label_wrap').className='warn_border';
}
//]]>
</script>
<div class="tbl_lb_wide_btn">
	<a href="#" class="btn_apply" title="Save changes" id="save-settings" onclick="adminPageSettings.execSave();" >Save</a>
	<a href="#" class="add_link" id="restore-settings" title="Reset to default" onclick="adminPageSettings.execReset();">Reset to Default</a>
</div>