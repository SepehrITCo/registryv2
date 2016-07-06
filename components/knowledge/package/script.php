<?php 
	if($action == "credits"):
?>
	
	<div style="direction:ltr; text-align:left">
		<p>Knwoledge Base Component includes</p>
		<ul>
			<li>Static Help System</li>
			<li>Dynamic Help Desk</li>
			<li>Q&A System</li>
		</ul>
	</div>
	
<?php endif; ?>

<?php if($action == "install"): ?>

<?php endif; ?>

<?php if($action == "uninstall"): ?>
	<?php Fail( T("ERROR.REMOVE_SYSTEM_NOT_ALLOWED") ); ?>
<?php endif; ?>

<?php if($action == "upgrade"): ?>
	
<?php endif; ?>
