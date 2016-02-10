<?php $this->load->view("header"); ?>

	<h1 style="background-color:#2fdc02;">
	User Manage</h1>

	<div id="body">
		<p>
			<?php echo $this->session->userdata('usr_mng_user');?>&nbsp;&nbsp;
			<a href="<?php echo site_url();?>/home/logout">Logout</a>
		</p>
		
		<br/>
		<div style="border:1px solid #006666;overflow:scroll;height:400px;">         		
			<div id="menus"></div>	
		</div>
	</div>
	
	<?php $this->load->view("footer");?>
	
	
	<script type="text/javascript">
	$(document).ready(function(){
	
	    $("#menus").load("<?php echo site_url();?>/home/get_submenu" , 
		function(){});
		
		
	});
	</script>

