<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_data extends CI_Controller 
{	
	public function is_user_exist($username , $password)
	{
		$str = "SELECT * FROM users WHERE 
					username='$username' AND 
					PASSWORD='$password' and 1=1";
		if($this->db->query($str)->num_rows()>0)			
			return $this->db->query($str)->result();			
		else
		    return 0;
	}
	
	public function get_modules()
	{
	   $str = "select * from modules";
	   return $this->db->query($str)->result();
	}
	
	
}
?>	