<div class="box-header with-border">
	<b><?php P("CORE.APPLICATION_SETTINGS"); ?></b>
</div>
<br/>
<?php 
	$config = new Configuration("core");
	
	echo Form::_("text",T("CORE.IW.GLOBAL_NAME"),"IW.GLOBAL_NAME")->value( $config->get("IW.GLOBAL_NAME") )->required();
	echo Form::_("boolean",T("CORE.IW.ROOT_AUTO_DETECT"),"IW.ROOT_AUTO_DETECT")->select( $config->get("IW.ROOT_AUTO_DETECT") );
	echo Form::_("text",T("CORE.IW.ROOT"),"IW.ROOT")->value( $config->get("IW.ROOT") )->required();
	
	$langs = Language::getLangList();
	echo Form::_("select",T("CORE.IW.DEFAULT_LANG"),"IW.DEFAULT_LANG")->options($langs)->select( $config->get("IW.DEFAULT_LANG") )->required();
	echo Form::_("text",T("CORE.IW.ROOT"),"IW.ROOT")->value( $config->get("IW.ROOT") )->required();
	echo Form::_("boolean",T("CORE.IW.DEVELOPER"),"IW.DEVELOPER")->select( $config->get("IW.DEVELOPER") );
?>



<div class="box-header with-border">
	<b><?php P("CORE.SESSION_SETTINGS"); ?></b>
</div>
<br/>
<?php 
	echo Form::_("text",T("CORE.SESSION.NAME"),"SESSION.NAME")->value( $config->get("SESSION.NAME") )->required();
	echo Form::_("number",T("CORE.SESSION.EXPIRE"),"IW.EXPIRE")->value( $config->get("SESSION.EXPIRE") )->required();
?>


<div class="box-header with-border">
	<b><?php P("CORE.PAGE_SETTINGS"); ?></b>
</div>
<br/>
<?php 
	echo Form::_("text",T("CORE.PAGE.LOGO"),"PAGE.LOGO")->value( $config->get("PAGE.LOGO") )->required();
	echo Form::_("text",T("CORE.PAGE.MOBILE.LOGO"),"PAGE.MOBILE.LOGO")->value( $config->get("PAGE.MOBILE.LOGO") )->required();
?>


<div class="box-header with-border">
	<b><?php P("CORE.SMS_SETTINGS"); ?></b>
</div>
<br/>
<?php 
	$drivers = [];
	$files = File::scanDir(PATH_BASE.DS."libraries".DS."SMS".DS."driver");
	foreach($files as $item){
		$raw = explode(".",$item);
		$drivers[ $raw[0] ] = ucwords($raw[0]);
	}
	echo Form::_("select2",T("USERS.LANGUAGE"),"lang")->options($drivers)->select($config->get("SMS.DRIVER"));
	echo Form::_("text",T("CORE.SMS.CONNECTION_STRING"),"SMS.CONNECTION_STRING")->value( $config->get("SMS.CONNECTION_STRING") )->required();
	
?>
