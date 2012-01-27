var adminPageSettings = {
    execSave : function(){
        if(oValidator.formName.getMessage('twitterwidget_settings_form')){
            document.twitterwidget_settings_form.submit();
        }
        
    },execReset : function(){
        $("#username").val('');
        $("select#post_count").val(10);
    }
}