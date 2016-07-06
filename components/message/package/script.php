<?php 
	if($action == "credits"):
?>
	
	<div style="direction:ltr; text-align:left">
		<p>Message System Includes</p>
		<ul>
			<li>Message Composer</li>
			<li>Message Notifier</li>
			<li>Easy Forwarding & Reply</li>
			<li>Drafts</li>
			<li>CC & BCC</li>
			<li>Support Attachments</li>
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
