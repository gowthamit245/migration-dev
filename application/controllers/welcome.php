<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function general(){

		$data['layout'] = 'layout/layout';
		$data['header'] = 'layout/header';
		$data['footer'] = 'layout/footer';
		$data['leftside']='layout/leftside';

		/*$data['source']=$this->public_model->get_source_list();
		$data['schema']=$this->public_model->get_schema_list();
		$data['tables']=$this->public_model->get_tables_list();
		$data['target']= $this->public_model->get_target_list();*/

		$data['source']=$this->public_model->get_source_preview();
		$data['schema']=$this->public_model->get_schema_preview();
		$data['tables']=$this->public_model->get_tables_preview();
		$data['target']= $this->public_model->get_target_preview();
		$data['job_list']= $this->public_model->get_job_list();
		return $data;
	}
	public function index()
	{
		$data = $this->general();
		 $this->session->sess_destroy();
		$data['rec']= $this->public_model->clear_status();
		//print_r($data['rec']);exit();
		$data['pagename']='home';
		$data['body']='static/home';
		$this->load->view('welcome',$data);
	}
	public function migration($sel = '')
	{
		$data = $this->general();
		 $this->session->sess_destroy();
		$data['rec']= $this->public_model->clear_status();
		//print_r($data['rec']);exit();
		$data['pagename']='migration';
		$data['result']='';
		if($sel){
			$data['result']='Migration has been completed';
		}
		$data['body']='static/migration';
		$this->load->view('welcome',$data);
	}
	public function preview()
	{
		
		$data = $this->general();
		$data['rec']=$this->public_model->get_data_preview();
		$data['rec_target']=$this->public_model->get_target_preview();
		$data['pagename']='preview';
		$data['body']='static/preview';
		$this->load->view('welcome',$data);
	}
	public function create_job($id = 0)
	{
		$data = $this->general();
		$data['selected_id'] = 0;
		$data['connect_db'] =[];
		if($id){	
			$data['selected_id'] = $id;		
			$this->public_model->set_schema_update($id);
			$data['connect_db'] = $this->public_model->get_db_config($id);
		}
		$data['rec']= $this->public_model->get_dbnames();
		foreach ($data['rec'] as $key => $value) {
			if($value['status'] == 1){
				$data['selected_id'] = $value['id'];					
			}
		}
		$data['pagename']='current_job';
		$data['body']='static/create-job';
		$this->load->view('welcome',$data);
	}

	public function target($id=0)
	{
		
		$data = $this->general();
		$data['selected_id'] = 0;
		$data['selected_targetname'] = "";
		if($id){	
			$data['selected_id'] = $id;

			 $this->public_model->set_target_update($id);
			 $session_id=$this->session->userdata('job_id');	
			 $this->public_model->get_target_update($id,$session_id);
		}
		$data['rec']= $this->public_model->get_target_dbnames();
		foreach ($data['rec'] as $key => $value) {
			// print_r($value);
			if($value['status'] == 1){
				$data['selected_id'] = $value['id'];
		$data['selected_targetname'] = $value['snow_flake'];					
			}
		}
		$data['pagename']='target';
		$data['body']='static/target';
		$this->load->view('welcome',$data);
	}
	
		function config()
	{
		if(isset($_POST['id']))
		{
		  $id=$_POST['id'];
		  $this->public_model->delete_config_rec($id);
		}

		if($this->input->post('update'))
		{
			$config_id=$this->input->post('config_id');
			$db_type=$this->input->post('type');
			$host=$this->input->post('host');
			$port=$this->input->post('port');
			$user=$this->input->post('user');
			$password=$this->input->post('password');
			$this->public_model->update_config($config_id,$db_type,$host,$port,$user,$password);

		}
		if($this->input->post('insert'))
		{
			$name=$this->input->post('name');
			$db_type=$this->input->post('type');
			$host=$this->input->post('new_host');
			$port=$this->input->post('new_port');
			$user=$this->input->post('new_user');
			$password=$this->input->post('new_password');
			$this->public_model->insert_config($name,$db_type,$host,$port,$user,$password);
		}
		$data = $this->general();
		$data['pagename']='config';
		$data['body']='static/config';		
		$data['mysql']=$this->public_model->get_data_mysql();
		$data['oracle']=$this->public_model->get_data_oracle();
		$data['sql']=$this->public_model->get_data_sql();
		$data['netezza']=$this->public_model->get_data_netezza();

		$data['dbNameList']= $this->public_model->get_dbnames();
		$this->load->view('welcome',$data);
	}
	function get_database_record($id)
	{
		$rec=$this->public_model->get_database_record($id);
		echo json_encode($rec);
	}
	function get_connection_data($id){
		$rec=$this->public_model->get_connection_records($id);
		echo json_encode($rec);
	}
	function demo()
	{
		$data['layout']='layout/layout';
		$data['header']='layout/header';
		$data['footer']='layout/footer';
		$data['body']='static/demo';
		$this->load->view('welcome',$data);
	}
	function schema_list($id = 0)
	{
		if($id){
			$session_id=$this->session->userdata('job_id');
			$rec['schema_id'] =$this->public_model->get_schema_id($id, $session_id );


		} else {
			redirect('/create-job');
		}
		$data = $this->general();
	
		$data['pagename']='SchemaList';
		$data['body']='static/schema';
		$this->load->view('welcome',$data);
	}
	public function schemas($id=1)
	{
		$rec = array();
		$rec['schema'] = $this->public_model->get_schema($id, 0);
		$rec['schema_selected'] =$this->public_model->get_schema($id, 1);
		// $rec['schema_selected'] = [];
		$rec['status'] = "success";
		$rec['code'] = "1001";
		
		echo json_encode($rec);
	}
	public function schemas_update($id=0)
	{
		$schema = $this->input->post('id');

		//print_r($schema);exit();
		$session_id=$this->session->userdata('job_id');
		$rec = array();

		$rec['status'] = "success";
		$rec['code'] = "1001";
			$this->public_model->schema_list_updste($schema,$session_id);

		echo json_encode($rec);
	}
	public function table_update($id=0)
	{
		$schema = $this->input->post('id');
		$session_id=$this->session->userdata('job_id');
		$rec = array();

		$rec['status'] = "success";
		$rec['code'] = "1001";
			$this->public_model->table_list_updste($schema,$session_id);
		echo json_encode($rec);
	}
	public function table_list($id=1)
	{
		$rec = array();
		$rec['schema'] = $this->public_model->get_table($id, 0);
		$rec['schema_selected'] =$this->public_model->get_table($id, 1);
		// $rec['schema_selected']  = [];
		$rec['status'] = "success";
		$rec['code'] = "1001";
		
		echo json_encode($rec);
	}
	public function table()
	{
		$data = $this->general();
	
		$data['pagename']='TableList';
		$data['body']='static/table';
		$this->load->view('welcome',$data);
		
	}
	public function source_update($id)
	{
		
		 $this->public_model->set_schema_update($id);
	
	}
	public function new_crete_job()
	{
		if($this->input->post('submit'))
		{
			$job_name=$this->input->post('job_name');
			 $this->public_model->new_create_job($job_name);
			 $x= $this->public_model->get_job_data();
			 	   $jobdata = array(
                    'jobname' =>$x[0]['job_name'],
					'job_id'=>$x[0]['id'],
                    'status'=>'completed'
                                
                );

               $this->session->set_userdata($jobdata);
              /* print_r($this->session->userdata('jobname'));
               exit;*/
			 redirect('/create-job');

		}
		
	}

	public function migration_process($id){
		$data = $this->general();
		$data['rec_source']=$this->public_model->get_job_source($id);
		$data['rec_schema']=$this->public_model->get_job_schema($id);
		$data['rec_tables']=$this->public_model->get_job_tables($id);
		// print_r($data['rec_tables']);exit();
		$data['rec_target']=$this->public_model->get_job_target($id);
		$data['pagename']='migration_process';
		$data['body']='static/migration_process';
		$this->load->view('welcome',$data);
	}
	
}
