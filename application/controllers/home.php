<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller 
{	

	public function index()
	{
		if($this->session->userdata('usr_mng_user')!="") 
	    {	
           $this->load->model("home_data");		
           $data['modules'] = $this->home_data->get_modules();
		   $this->load->vars($data);						
		   $this->load->view('home_view');
		}
		else
		{
		    redirect("home/logout","refresh");
		}	
	}

	
	
	public function get_submenu()
	{
	  $this->load->model("home_data");
		$modules = $this->home_data->get_modules();
    ?>    
	<table>
	<tr>
	<td>
    <ul style="list-style:none;">
	<?php
	foreach($modules  as    $module)  
	{
	?>	  		
			<?php 
			$str = "select * from sub_menus where mmid=".$module->id ; 
			$res = $this->db->query($str)->result();
			//print_r($res);
			if($this->db->query($str)->num_rows()>0)
			{
			?>
			    <li><input type="checkbox" class="chk" id="<?php echo $module->id .'#0';?>" value="<?php echo $module->id;?>"/><?php echo $module->module;?>
				    <ul  style="list-style:none;">
					   <?php foreach($res as $r){ ?>
					   <li><input type="checkbox" class="chk" id="<?php echo $module->id .'#'. $r->smid;?>" value="<?php echo $module->id .'#'. $r->smid;?>"/><?php echo $r->name; ?></li>
					   <?php } ?>
					</ul>				
				</li>
			<?php
			}
			else
			{
			?>
				<li><input type="checkbox" id="<?php echo $module->id .'#0';?>" value="<?php echo $module->id .'#';?>"/><?php echo $module->module;?></li>
			<?php 	
			}
	}
	?>	
	</ul>
	</td>
	</tr>
	<tr>
	<td>&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="button" id="menu_perm_btn" value="Save"/>
	</td>
	</tr>
	</table>
	<script type="text/javascript">
	$(document).ready(function(){
	
		$(".chk").click(function(){
		   var sel_id = $(this).attr('id');
		   //alert(sel_id);
		});	
		
		$("#menu_perm_btn").click(function(){
		    var v = [];
		    $(".chk").each(function(){
				var sid = $(this).attr('id');
				if($(this).is(':checked')==true) 
				{
					v.push(sid);
				}
			});		
			alert(v);
		});
	});
	</script>
	
	<?php 
	}
	

	public function login()
	{
	    if($this->session->userdata('usr_mng_user')=="") 
	    {
		  $this->load->view('login_view');
	    }else{
	      redirect("home/","refresh");
	    }	
	}
	
	
	public function login_check() 
	{
	   $username = $this->input->post("username");
	   $password = $this->input->post("password");
	   
	   
	   $this->load->model("home_data");
	   $is_exist = (int)$this->home_data->is_user_exist($username , $password);
	   if($is_exist == 1 ) 
	   {
	     $this->session->set_userdata('usr_mng_user',$username);
	     $this->session->set_userdata('login_ip' , $_SERVER['REMOTE_ADDR']);
		 $this->session->set_userdata('login_time' , date('Y-m-d H:i:s'));
		 echo 1;
	   }
	   else
	   {
	     echo 0;
	   }	   
	}
	
	
	public function logout()
	{
	   $this->session->unset_userdata('usr_mng_user');
	   $this->session->unset_userdata('login_ip');
	   $this->session->unset_userdata('login_time');
	   redirect("home/login","refresh");
	}
	
	
}