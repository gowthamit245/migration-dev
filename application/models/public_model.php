<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Public_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
	function clear_status(){
	$s="UPDATE  `source` SET status=0";
	$this->db->query($s);
	$s="UPDATE  `schemas` SET status=0";
	$this->db->query($s);
	$s="UPDATE  `tables` SET status=0";
	$this->db->query($s);
	$s="UPDATE  `target` SET status=0";
	$this->db->query($s);

	}
	function schema_list_updste($id,$session_id){
		// $arr = explode(",",$id);
	// 	foreach ($arr as $key => $value) {
	// $s="UPDATE  `schemas` SET status=1 where id in ($value)";
	// $this->db->query($s);
	// 	}
    // echo $id; 
    $arr1 = explode(',', $id);

      $sql = "DELETE FROM `job_schema` where  job_id='$session_id'";
     $ex=$this->db->query($sql);
    foreach ($arr1 as $key => $value) {
     
          $sql = "INSERT INTO `job_schema` (`schema_id`,`job_id`) VALUES ('$value',$session_id) ";
          $ex=$this->db->query($sql);
    }
     

	$s="UPDATE  `schemas` SET status=0";
	$this->db->query($s);
	$s="UPDATE  `schemas` SET status=1 where id in ($id)";
	$this->db->query($s);
		return 1;

	}
	function table_list_updste($id ,$session_id){
		// $arr = explode(",",$id);
	// 	foreach ($arr as $key => $value) {
	// $s="UPDATE  `schemas` SET status=1 where id in ($value)";
	// $this->db->query($s);
	// 	}
    $arr1 = explode(',', $id);

      $sql = "DELETE FROM `job_table` where  job_id='$session_id'";
     $ex=$this->db->query($sql);
    foreach ($arr1 as $key => $value) {
     
          $sql = "INSERT INTO `job_table` (`table_id`,`job_id`) VALUES ('$value',$session_id) ";
          $ex=$this->db->query($sql);
    }
	$s="UPDATE  `tables` SET status=0";
	$this->db->query($s);
	$s="UPDATE  `tables` SET status=1 where id in ($id)";
	$this->db->query($s);
		return 1;

	}
	function get_schema($id, $type)
	{
		$q="SELECT schemas.id, schema_list as 'label' FROM `schemas` INNER JOIN source on `schemas`.database_id = source.id where source.status = 1 and `schemas`.status = ". $type;
		$ex=$this->db->query($q);
		return $ex->result_array();
	}
	function get_table($id, $type)
	{
		$q="SELECT tables.id, table_list as 'label' FROM `schemas` INNER JOIN tables on tables.schema_id = schemas.id WHERE schemas.status = 1 and tables.status = ". $type;
		// echo $q;
		$ex=$this->db->query($q);
		return $ex->result_array();
	}
	function get_dbnames()
	{
		$q="SELECT id, database_list, status FROM `source`";
		$ex=$this->db->query($q);
		return $ex->result_array();
	}

  function get_target_dbnames()
  {
    $q="SELECT id, snow_flake, status FROM `target`";
    $ex=$this->db->query($q);
    return $ex->result_array();
  }
  function get_selected_source($id){
    $q="SELECT * FROM `source` where id='$id'";
    $ex=$this->db->query($q);
    return $ex->result_array();
  }

	 function set_schema_update($id)
	{
	$s="UPDATE  `source` SET status=0";
	$this->db->query($s);
	$s="UPDATE  `source` SET status=1 where id='$id'";
	$this->db->query($s);
	}
   function set_target_update($id)
  {
  $s="UPDATE  `target` SET status=0";
  $this->db->query($s);
  $s="UPDATE  `target` SET status=1 where id='$id'";
  $this->db->query($s);
  }
	 function get_data_sql()
  {
  	/*$query="SELECT *, configuration.id as 'config_id' FROM source INNER JOIN configuration ON source.id = configuration.database_id";*/
     $query="SELECT * from configuration  where database_id=3";
  	$ex=$this->db->query($query);
  	return $ex->result_array();
  }
  function get_data_mysql()
  {
    $query="SELECT * from configuration  where database_id=1";
    $ex=$this->db->query($query);
    return $ex->result_array();
  }
  function get_data_oracle()
  {
    $query="SELECT * from configuration  where database_id=2";
    $ex=$this->db->query($query);
    return $ex->result_array();
  }
  function get_data_netezza()
  {
    $query="SELECT * from configuration  where database_id=4";
    $ex=$this->db->query($query);
    return $ex->result_array();
  }
  function get_database_record($id)
  {
  	$query="SELECT * FROM configuration where id =$id";
  	$ex=$this->db->query($query);
  	return $ex->result_array();
  }
	function update_config($id,$type,$host,$port,$user,$password)
  {
    $sqll = "UPDATE `configuration` SET `hosturl`='$host',`port`='$port',`userid`='$user',`password`='$password',`database_id`='$type' WHERE id='$id'";
    $ex=$this->db->query($sqll);
  }
  function insert_config($name,$type,$host,$port,$user,$password)
  {
    $sql = "INSERT INTO `configuration`(`name`, `hosturl`, `port`, `userid`, `password`, `database_id`) VALUES ('$name','$host','$port','$user','$password','$type') ";
     $ex=$this->db->query($sql);
  }
  function get_db_config($id=0){
    $sql = "SELECT * FROM `configuration` WHERE `database_id` = $id ";
     $ex=$this->db->query($sql);
    return $ex->result_array();
  }
  function delete_config_rec($id)
  {
    $query="DELETE from configuration where id='$id'";
     $ex=$this->db->query($query);
  }
  function get_source_preview()
  {
  	$query="SELECT * FROM source where status =1";
  	$ex=$this->db->query($query);
  	return $ex->result_array();
  }
  function get_schema_preview()
  {
  	$query="SELECT * FROM  `schemas` where status =1";
  	$ex=$this->db->query($query);
  	return $ex->result_array();
  }
   function get_data_preview()
  {
    $q="SELECT database_list, schema_list , table_list FROM `schemas` INNER JOIN source on `schemas`.database_id = source.id  INNER JOIN `tables` on 
    `schemas`.id = tables.schema_id  where source.status = 1 AND `schemas`.`status`=1 and tables.status =1 ";
    $ex=$this->db->query($q);
   
    return $ex->result_array();
  }
   function get_tables_preview()
  {
  	$query="SELECT * FROM tables where status =1";
  	$ex=$this->db->query($query);
  	return $ex->result_array();
  }
  function get_target_preview()
  {
    $query="SELECT * FROM target where status =1";
    $ex=$this->db->query($query);
    return $ex->result_array();
  }
  function new_create_job($job_name)
  {
    $sql = "INSERT INTO `create_job` (`job_name`,`status`) VALUES ('$job_name','completed') ";
     $ex=$this->db->query($sql);
  }
  function get_job_data()
  {
    $sql="SELECT * from create_job order by id desc";
     $ex=$this->db->query($sql);
    // $this->db->insert_id();
     return $ex->result_array();
  }
  function get_connection_records($id)
  {
    $query="SELECT * FROM configuration where database_id ='$id'";
    $ex=$this->db->query($query);
    return $ex->result_array();
  }
  function get_job_source($id){
    $query="SELECT * FROM `create_job` INNER JOIN `job_source` on `create_job`.id = `job_source`.job_id   INNER JOIN `source` on 
    `job_source`.source_id = `source`.id   where job_id = $id ";
    $ex=$this->db->query($query);
    return $ex->result_array();
  }
  function get_job_schema($id){
    $query="SELECT * FROM `create_job` INNER JOIN `job_schema` on `create_job`.id = `job_schema`.job_id   INNER JOIN  `schemas` on 
    `job_schema`.schema_id = `schemas`.id   where job_id = $id ";
    $ex=$this->db->query($query);
    return $ex->result_array();
  }
  function get_job_tables($id){
    $query="SELECT * FROM `create_job` INNER JOIN job_table on `create_job`.id = `job_table`.job_id   INNER JOIN `tables` on 
    `job_table`.table_id = `tables`.id   where job_id = $id ";
    $ex=$this->db->query($query);
    return $ex->result_array();
  }
  function get_job_target($id){
    $query="SELECT * FROM `create_job` INNER JOIN job_target on `create_job`.id = `job_target`.job_id   INNER JOIN `target` on 
    `job_target`.target_id = `target`.id   where job_id = $id  ";
    $ex=$this->db->query($query);
    return $ex->result_array();
  }
  function get_job_list(){
    $query="SELECT * FROM `create_job` where  create_job.status = 'completed' ";
    $ex=$this->db->query($query);
    return $ex->result_array();
  }
   function get_schema_id($id, $session_id ){
    $sql = "SELECT * FROM `job_source` where  job_id='$session_id' ";
     $ex=$this->db->query($sql);
      $res =  $ex->result_array();
      if($res)
      {
        $s="UPDATE  `job_source` SET source_id=$id  where job_id='$session_id'";
        $this->db->query($s);
      }
        else
        {
          $sql = "INSERT INTO `job_source` (`source_id`,`job_id`) VALUES ('$id',$session_id) ";
          $ex=$this->db->query($sql);
        }
      
      //print_r($ex);exit();
   
  }
  function get_target_update($id, $session_id ){
    $sql = "SELECT * FROM `job_target` where  job_id='$session_id' ";
     $ex=$this->db->query($sql);
      $res =  $ex->result_array();
      if($res)
      {
        $s="UPDATE  `job_target` SET target_id=$id  where job_id='$session_id'";
        $this->db->query($s);
      }
        else
        {
          $sql = "INSERT INTO `job_target` (`target_id`,`job_id`) VALUES ('$id','$session_id') ";
          $ex=$this->db->query($sql);
        }
      
      //print_r($ex);exit();
   
  }
   function get_source_list()
  {
    $query="SELECT * FROM `source` ";
    $ex=$this->db->query($query);
    return $ex->result_array();
  }
   function get_schema_list()
  {
    $query="SELECT * FROM `schemas` ";
    $ex=$this->db->query($query);
    return $ex->result_array();
  }
   function get_tables_list()
  {
    $query="SELECT * FROM `tables` ";
    $ex=$this->db->query($query);
    return $ex->result_array();
  }
   function get_target_list()
  {
    $query="SELECT * FROM `target` ";
    $ex=$this->db->query($query);
    return $ex->result_array();
  }
}
?>