<?php
class register_model extends CI_Model
{

	function reg($u,$e,$p)
	{
		$q="INSERT into reg (uname,email,password) values ('$u','$e','$p')";
		$this->db->query($q);
	}
	function log($e,$p)
	{
		$q="SELECT * from reg where email='$e'";
		$ex=$this->db->query($q);
		return $ex->result();
	}
	function alldata_submit($m,$g,$edu,$add,$img,$id)
	{
		$q="UPDATE  reg set mobile='$m',gender='$g',education='$edu',address='$add',image='$img' where id='$id'";
		$this->db->query($q);
	}
	function display_data()
	{
		$s="SELECT * from reg";
		$d=$this->db->query($s);
		return $d->result_array();
	}
	function edit_data($id)
	{
		$s="SELECT * from reg where id='$id'";
		$q=$this->db->query($s);
		return $q->result();

	}
	function edit_code_data($u,$e,$p,$id,$m,$g,$edu,$add,$img)
	{
		$s="UPDATE reg set uname='$u',email='$e',password='$p',mobile='$m',gender='$g',education='$edu',address='$add',image='$img' where id='$id'";
		$this->db->query($s);
	}
	function delete_data($id)
	{
		$s="DELETE from reg where id='$id'";
		$this->db->query($s);
	}
	function update_pwd($p,$id)
	{
		$s="UPDATE reg set password='$p' where id='$id'";
		$this->db->query($s);
	}
	function delete_img($id)
	{
		
		$s="UPDATE reg set image='' where id='$id'";
		$r=$this->db->query($s);
		//return $r->result();
	}
	function saverecords($name,$email,$password)
	{
		$query="INSERT INTO reg (uname,email,password) 
		VALUES ('$name','$email','$password')";
		$this->db->query($query);
	}

}


?>