<?php 
	if($action == "credits"):
?>
	
	<div style="direction:ltr; text-align:left">
		<p>The system core management component:</p>
		<ul>
			<li>Settings - All in one system setting interface.</li>
			<li>Installer/Uninstaller - Install/Uninstall system packages</li>
			<li>System Information - Inform all the server assets by detail</li>
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
