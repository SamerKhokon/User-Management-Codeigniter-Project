<?php $this->load->view("header"); ?>

	<h1 style="background-color:#2fdc02;">Sign In</h1>

	<div id="body">
		<table border="0" align="center">
		<tr>
			<td>Username</td>
			<td><input type="text" id="username"/></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" id="password"/></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="button" id="user_login" value="Login"/></td>
		</tr>		
		</table>
	</div>
	
	<?php $this->load->view("footer");?>
	
	
	<script type="text/javascript">
	$(document).ready(function(){
	    $("#username").focus();
	    
		
		$("#username").keypress(function(ex){
		    if(ex.which == 13) 
			{
				var username = $("#username").val();
				if(username=="") {
					alert("Enter username");
					$("#username").focus();
					return false;
				}else{
				   $("#password").focus();
				}			
			}
		});
		
		
		$("#password").keypress(function(ex){
		    if(ex.which == 13) 
			{
				var password = $("#password").val();
				if(password=="") 
				{
					alert("Enter password");
					$("#password").focus();
					return false;
				}else{
				   $("#user_login").focus();
				}			
			}
		});
		
	    $("#user_login").click(function(){
		   var username = $("#username").val();
		   var password = $("#password").val();
		   var dataStr = "username="+username+
		   "&password="+password;
		   
		    if(username==""){
		     alert("Enter username");
			 $("#username").focus();
			 return false;
		    }else if(password=="") {
		     alert("Enter password");
			 $("#password").focus();
			 return false;		   
		    }else{
		       	
				$.ajax({
				   type:"post" ,
				   url:"<?php echo site_url();?>/home/login_check" ,
				   data:dataStr ,
				   cache:false ,
				   dataType: 'text' ,
				   success:function(st)
				   {
				       resets();
				       if(st==1)
					   location.href= "<?php echo site_url();?>/home/";
					   else
					   location.reload();
				   }
				});
				
				
				function resets()
				{
				    $("#username").val("");
					$("#password").val("");
					$("#username").focus();
				}
				//alert(dataStr);	      
		    }
		});
	
	});
	</script>

