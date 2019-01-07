<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		require_once(APPPATH."controllers/inc/construct.php");
	}

	public function _remap($method)
	{
		require_once(APPPATH."controllers/inc/remap.php");
  }


	public function index($data)
	{
		$this->login($data);
	}

	public function login($data)
	{
		$this->load->view('/admin/login/login_form');
	}

	public function login_post($data)
	{

		$id = $this->input->post('id');
    $pwd = $this->input->post('pwd');

		$data["table"]="admin";
		$data["where"]="`id`=".$this->db->escape($id)." and `pwd`=".$this->db->escape($pwd);
		$login = $this->Admin_model->data_get($data);


		$row = array();

		if($login->num_rows() > 0):
			foreach($login->result() as $key):
				$row["id"] = $key->id;
				$row["pwd"] = $key->pwd;
				$name = $key->user;
			endforeach;
			$this->session->set_userdata(array('id'=>$id,'name'=>$name));
			redirect(HOME_PATH.'/admin/about', 'refresh');
		else:
			echo "<script>alert(\"로그인 실패\");</script>";
			redirect(HOME_PATH.'/admin', 'refresh');
		endif;

	}

	public function logout($data){
		$this->session->sess_destroy();
		redirect(HOME_PATH.'/admin');
	}

	public function auth($data){
		$data["table"]="admin";
		$data["where"]="`id`=".$this->db->escape($this->session->userdata('id'));
		$query = $this->Admin_model->data_get($data);

		if($query->num_rows() > 0):
			foreach($query->result() as $key):
				if($key->auth != "master"):
					return -1;
				endif;
			endforeach;
		endif;
	}

	public function about($data){

		$data["row"]["contents"]='';
		$data["table"]="about";
		$data["title"]="about";
		$ex_contents = $this->Admin_model->data_get($data);

		if($ex_contents->num_rows()):
			foreach($ex_contents->result() as $key):
				$data["row"]["contents"] = $key->contents;
			endforeach;
		endif;
		$this->load->view('/admin/form',$data);
	}

	public function about_procc($data)
	{

    $contents = $this->input->post('contents');
		$data["table"]="about";
		$ex_contents = $this->Admin_model->data_get($data);
		$row["contents"] = $contents;
		$data["auth_title"]="about";

		if($this->auth($data) != 0):
			echo "<script>alert(\"권한이 없습니다.\");</script>";
			redirect(HOME_PATH.'/admin/'.$data["table"], 'refresh');
		endif;

		if($ex_contents->num_rows()):
			$this->db->update('about',$row,'idx = 0' );
			echo "<script>alert(\"수정 성공\");</script>";
		else:
			$this->db->insert('about', $row);
			echo "<script>alert(\"입력 성공\");</script>";
		endif;

		redirect(HOME_PATH.'/admin/about', 'refresh');
	}

	public function personalinfo($data){

		$data["table"]="personalinfo";
		$query = $this->Admin_model->data_get($data);

		if($query->num_rows()):
			foreach($query->result() as $key):
				$data["name"] = $key->name;
				$data["birthday"] = $key->birthday;
				$data["adress"] = $key->adress;
				$data["email"] = $key->email;
				$data["phonenumber"] = $key->phonenumber;
			endforeach;
		endif;
		$this->load->view('admin/personalinfo',$data);
	}

	public function personalinfo_procc($data){
		$data["table"]="personalinfo";
		$query = $this->Admin_model->data_get($data);

		$name = $this->input->post('name');
		$birthday = $this->input->post('birthday');
		$adress = $this->input->post('adress');
		$email = $this->input->post('email');
		$phonenumber = $this->input->post('phonenumber');

		if($this->auth($data) != 0):
			echo "<script>alert(\"권한이 없습니다.\");</script>";
			redirect(HOME_PATH.'/admin/'.$data["table"], 'refresh');
		endif;

		if(!$query->num_rows()):
			$row["name"] = $name;
			$row["birthday"] = $birthday;
			$row["adress"] = $adress;
			$row["email"] = $email;
			$row["phonenumber"] = $phonenumber;

			$this->db->insert($data['subtitle'], $row);
			redirect(HOME_PATH.'/admin/'.$data['subtitle'], 'refresh');
		else:
			$row["name"] = $name;
			$row["birthday"] = $birthday;
			$row["adress"] = $adress;
			$row["email"] = $email;
			$row["phonenumber"] = $phonenumber;

			$this->db->update($data['subtitle'], $row);
			redirect(HOME_PATH.'/admin/'.$data['subtitle'], 'refresh');
		endif;
	}

	public function skill($data){
		$data["table"]="skill";
		$data["order_by"]="idx asc";

		$data["where"]="`party`='cp'";
		$query = $this->Admin_model->data_get($data);
		$data["cp_count"]=0;
		if($query->num_rows()):
			$i = 0;
			foreach($query->result() as $key):
				$data["cp"][$i]["party"] = $key->party;
				$data["cp"][$i]["contents"] = $key->contents;
				$data["cp"][$i]["gid"] = $key->gid;
				$i++;
			endforeach;
			$data["cp_count"]=$i;
		endif;


		$data["where"]="`party`='db'";
		$query = $this->Admin_model->data_get($data);
		$data["db_count"]=0;
		if($query->num_rows()):
			$i = 0;
			foreach($query->result() as $key):
				$data["db"][$i]["party"] = $key->party;
				$data["db"][$i]["contents"] = $key->contents;
				$data["db"][$i]["gid"] = $key->gid;
				$i++;
			endforeach;
			$data["db_count"]=$i;
		endif;


		$data["where"]="`party`='se'";
		$query = $this->Admin_model->data_get($data);
		$data["se_count"]=0;
		if($query->num_rows()):
			$i = 0;
			foreach($query->result() as $key):
				$data["se"][$i]["party"] = $key->party;
				$data["se"][$i]["contents"] = $key->contents;
				$data["se"][$i]["gid"] = $key->gid;
				$i++;
			endforeach;
			$data["se_count"]=$i;
		endif;

		$this->load->view('admin/'.$data['subtitle'],$data);
	}

	public function skill_procc($data){

		$data["table"]="skill";
		$query = $this->Admin_model->data_get($data);

		if($this->auth($data) != 0):
			echo "<script>alert(\"권한이 없습니다.\");</script>";
			redirect(HOME_PATH.'/admin/'.$data["table"], 'refresh');
		endif;

		if(!$query->num_rows()):
			$cp = $this->input->post('cp');
			if(isset($cp)):
				$cp_cout = count($cp);

				if($cp_cout>1):
					$row["party"]="cp";
					$i=0;
					foreach ($cp as $key => $value):
							if(!empty($value)):
								$row["gid"]=$i;
								$row["contents"]=$value;
								$this->db->insert($data['subtitle'], $row);
								$i++;
							endif;
					endforeach;
				endif;
			endif;


			$db = $this->input->post('db');
			if(isset($db)):
				$db_cout = count($db);

				if($db_cout>1):
					$row["party"]="db";
					$i=0;
					foreach ($db as $key => $value):
							if(!empty($value)):
								$row["gid"]=$i;
								$row["contents"]=$value;
								$this->db->insert($data['subtitle'], $row);
								$i++;
							endif;
					endforeach;
				endif;
			endif;


			$se = $this->input->post('se');
			if(isset($se)):
				$se_cout = count($se);

				if($se_cout>1):
					$row["party"]="se";
					$i=0;
					foreach ($se as $key => $value):
							if(!empty($value)):
								$row["gid"]=$i;
								$row["contents"]=$value;
								$this->db->insert($data['subtitle'], $row);
								$i++;
							endif;
					endforeach;
				endif;
			endif;

		else:
			$cp = $this->input->post('cp');
			$cp_count=count($cp);

			if($cp_count>0):
				$row["party"]="cp";
				foreach($cp as $key => $value):
					if(!empty($value)):
						$row["gid"]=$key;
						$row["contents"]=$value;
						$data["where"]="`party`='cp' and gid=".$this->db->escape($row["gid"]);
						$query = $this->Admin_model->data_get($data);
						if($query->num_rows()>0):
							$this->db->where('party', "cp");
							$this->db->where('gid', $row["gid"]);
							$this->db->update($data['subtitle'], $row);
						else:
							$this->db->insert($data['subtitle'], $row);
						endif;
					elseif(isset($cp[1]) && empty($cp[1])):
						$data["where"]="`party`='cp'";
						$query = $this->Admin_model->data_get($data);
						if($query->num_rows()>0):
							$this->db->where('party', "cp");
							$this->db->delete($data['subtitle']);
						endif;
					endif;
				endforeach;
			endif;


			$db = $this->input->post('db');

			$db_count=count($db);
			if($db_count>0):
				$row["party"]="db";
				foreach($db as $key => $value):
					if(!empty($value)):

						$row["gid"]=$key;
						$row["contents"]=$value;

						$data["where"]="`party`='db' and gid=".$this->db->escape($row["gid"]);

						$query = $this->Admin_model->data_get($data);

						if($query->num_rows()>0):
							$this->db->where('party', "db");
							$this->db->where('gid', $row["gid"]);
							$this->db->update($data['subtitle'], $row);
						else:
							$this->db->insert($data['subtitle'], $row);
						endif;
					elseif(isset($db[1]) && empty($db[1])):
						$data["where"]="`party`='db'";
						$query = $this->Admin_model->data_get($data);
						if($query->num_rows()>0):
							$this->db->where('party', "db");
							$this->db->delete($data['subtitle']);
						endif;
					endif;
				endforeach;
			endif;

			$se = $this->input->post('se');
			$se_count=count($se);
			if($se_count>0):
				$row["party"]="se";
				foreach($se as $key => $value):
					if(!empty($value)):

						$row["gid"]=$key;
						$row["contents"]=$value;

						$data["where"]="`party`='se' and gid=".$this->db->escape($row["gid"]);

						$query = $this->Admin_model->data_get($data);

						if($query->num_rows()>0):
							$this->db->where('party', "se");
							$this->db->where('gid', $row["gid"]);
							$this->db->update($data['subtitle'], $row);
						else:
							$this->db->insert($data['subtitle'], $row);
						endif;
					elseif(isset($se[1]) && empty($se[1])):
						$data["where"]="`party`='se'";
						$query = $this->Admin_model->data_get($data);
						if($query->num_rows()>0):
							$this->db->where('party', "se");
							$this->db->delete($data['subtitle']);
						endif;
					endif;
				endforeach;
			endif;
		endif;

		redirect(HOME_PATH.'/admin/'.$data['subtitle'], 'refresh');
	}

	public function portfolio($data){
		$data["contents"]='';

		$data["table"]="portfolio";
		$procc=$this->input->post('procc');
		if($procc=="search"):
			$search=$this->input->post('search');
			$data["where"]="`title` like '%".$this->db->escape($search)."%'";
			$query = $this->Admin_model->data_get($data);
		else:
			$query = $this->Admin_model->data_get($data);
		endif;


		$data["num"]=$query->num_rows();

		if($query->num_rows() > 0):
			$this->load->library('pagination');
			$config['base_url'] = '/admin/portfolio';
			$config['total_rows'] = $query->num_rows();
			$config['per_page'] = 6;
			$config['num_links'] = 2;
			$config['uri_segment']=3;
			$data['pageNum']=$page = $this->uri->segment(3,0);


			$config['first_tag_open']  = '<li class="page-item page-link">';
			$config['first_tag_close']  = '</li>';
			$config['last_tag_open']  = '<li class="page-item page-link">';
			$config['last_tag_close']  = '</li>';
			$config['cur_tag_open']  = '<li class="page-item page-link">';
			$config['cur_tag_close']  = '</li>';
			$config['next_tag_open']  = '<li class="page-item page-link">';
			$config['next_tag_close']  = '</li>';
			$config['prev_tag_open']  = '<span id=';
			$config['prev_tag_open']  = '<li class="page-item page-link">';
			$config['prev_tag_close']  = '</li>';
			$config['num_tag_open']  = '<li class="page-item page-link">';
			$config['num_tag_close']  = '</li>';

			$this->pagination->initialize($config);

			if($page>2):
				$start=(($page/$config['per_page']))*$config['per_page'];
				$data["num"]=$query->num_rows()-$page;
			else:
				$start = 0;
			endif;

			$data["start"]=$config['per_page'];
			$data["limit"]=$page;
			$data["table"]="portfolio";

			if($procc=="search"):
				$data["where"]="`title` like '%".$this->db->escape($search)."%'";
				$query = $this->Admin_model->data_get($data);
			else:
				$query = $this->Admin_model->data_get($data);
			endif;

			$data["pagination"] = $this->pagination->create_links();
			$data["list"] = $query->result();
		else:
			$data["stats"] = "검색된 글이 없습니다.";
		endif;
		$this->load->view('admin/portfolio',$data);

	}

	public function portfolio_procc($data) {
		$procc = $data["procc"]= $this->input->post('procc');
		$data["table"]="portfolio";


		if($procc !="view"):
			if($this->auth($data) != 0):
				echo "<script>alert(\"권한이 없습니다.\");</script>";
				redirect(HOME_PATH.'/admin/'.$data["table"], 'refresh');
			endif;
		endif;

		if($procc=="write"):

			$data["row"]["title"]="";
			$data["row"]["contents"]="";
			$data["row"]["idx"]="";
			$data["row"]["file_name"]="";
			$data["row"]["file_ext"]="";
			$data["row"]["thumbnail"]="";

			$this->load->view('admin/inc/head.php',$data);
			$this->load->view('admin/inc/edge.php',$data);
			$this->load->view('admin/form',$data);
			$this->load->view('admin/inc/foot.php',$data);
			$this->load->view('admin/inc/end.php',$data);
		elseif($procc =="write_procc"):
			$row["title"] = $this->input->post('title');
			$row["contents"] = $this->input->post('contents');
			$row["date"] = time();
			$config['upload_path']          = "./portfolio/";
			$config['allowed_types']        = 'jpg|gif|png|jpeg|JPG|PNG';

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload("thumbnail")):
				$error = array('error' => $this->upload->display_errors());
				$file_path="";
				$file_ext ="";
				$file_name="";
			else:
				$file_path="/"."portfolio"."/";
				$file_ext = $this->upload->data('file_ext');
				$file_name=$this->upload->data('raw_name');
			endif;

			$row["thumbnail"]=$file_path.$file_name.$file_ext;
			$row["file_name"]=$file_name;
			$row["file_ext"]=$file_ext;

			$this->db->insert("portfolio", $row);

			redirect(HOME_PATH.'/admin/portfolio', 'refresh');
		elseif($procc=="view"):
			$idx = $data["idx"]= $this->input->post('idx');
			$data["table"]="portfolio";
			$data["where"]="idx=".$this->db->escape($idx);
			$query = $this->Admin_model->data_get($data);

			$data["list"]=$query->result();
			$this->load->view('admin/inc/head.php',$data);
			$this->load->view('admin/inc/edge.php',$data);
			$this->load->view('admin/qa_view',$data);
			$this->load->view('admin/inc/foot.php',$data);
			$this->load->view('admin/inc/end.php',$data);
		elseif($procc == "delete"):
			$idx = $this->input->post('idx');
			$data["table"]="portfolio";
			$data["where"]="idx=".$this->db->escape($idx);
			$query = $this->Admin_model->data_get($data)->result_array();


			if($query[0]['thumbnail']!=""):
				unlink($_SERVER["DOCUMENT_ROOT"].$query[0]['thumbnail']);
			endif;

			$this->Admin_model->data_delete($data);
			echo "<script>alert(\"삭제 성공\");</script>";
			redirect(HOME_PATH.'/admin/portfolio', 'refresh');
		elseif($procc == "modify"):
			$idx = $this->input->post('idx');
			$data["table"]="portfolio";
			$data["where"]="idx=".$this->db->escape($idx);
			$query = $this->Admin_model->data_get($data);

			$data["list"]=$query->result();

			if($query->num_rows() > 0):
				foreach($query->result() as $key):
					$data["row"]["title"]=$key->title;
					$data["row"]["contents"]=$key->contents;
					$data["row"]["idx"]=$key->idx;
					$data["row"]["file_name"]=$key->file_name;
					$data["row"]["file_ext"]=$key->file_ext;
					$data["row"]["thumbnail"]=$key->thumbnail;
				endforeach;
			endif;

			$this->load->view('admin/inc/head.php',$data);
			$this->load->view('admin/inc/edge.php',$data);
			$this->load->view('admin/form',$data);
			$this->load->view('admin/inc/foot.php',$data);
			$this->load->view('admin/inc/end.php',$data);

		elseif($procc == "modify_procc"):
			$idx = $this->input->post('idx');
			$row["title"] = $this->input->post('title');
			$row["contents"] = $this->input->post('contents');
			$config['upload_path']          = "./portfolio/";
			$config['allowed_types']        = 'jpg|gif|png|jpeg|JPG|PNG';

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload("thumbnail")):
				$error = array('error' => $this->upload->display_errors());
				$file_path="";
				$file_ext ="";
				$file_name="";
			else:
				$file_path="/"."portfolio"."/";
				$file_ext = $this->upload->data('file_ext');
				$file_name=$this->upload->data('raw_name');

				$data["table"]="portfolio";
				$data["where"]="idx=".$this->db->escape($idx);
				$query = $this->Admin_model->data_get($data)->result_array();

				if($query[0]['thumbnail']!=""):
					unlink($_SERVER["DOCUMENT_ROOT"].$query[0]['thumbnail']);
				endif;
			endif;
			$row["thumbnail"]=$file_path.$file_name.$file_ext;
			$row["file_name"]=$file_name;
			$row["file_ext"]=$file_ext;

			$this->db->where('idx', $idx);
			$this->db->update('portfolio', $row);

			echo "<script>alert(\"수정 성공\");</script>";

			$data["table"]="portfolio";
			$data["where"]="idx=".$this->db->escape($idx);
			$query = $this->Admin_model->data_get($data);

			$data["list"]=$query->result();

			$this->load->view('admin/inc/head.php',$data);
			$this->load->view('admin/inc/edge.php',$data);
			$this->load->view('admin/qa_view',$data);
			$this->load->view('admin/inc/foot.php',$data);
			$this->load->view('admin/inc/end.php',$data);
		endif;
	}

	public function qanda($data){
		$data['title']='Q&A';
		$data['subtitle']='qanda';
		$data["contents"]='';

		$procc = $this->input->post('procc');
		$data["table"]="qanda";
		if($procc=="search"):
			$search=$this->input->post('search');
			$data["where"]="`title` like '%".$this->db->escape($search)."%'or `name` like '%".$this->db->escape($search)."%'";
			$query = $this->Admin_model->data_get($data);
		else:
			$query = $this->Admin_model->data_get($data);
		endif;
		$data["num"]=$query->num_rows();


		if($query->num_rows() > 0):
			$this->load->library('pagination');
			$config['base_url'] = '/admin/qanda';
			$config['total_rows'] = $query->num_rows();
			$config['per_page'] = 10;
			$config['num_links'] = 2;
			$config['uri_segment']=3;
	  	$data['pageNum']=$page = $this->uri->segment(3,0);

			$config['first_tag_open']  = '<li class="page-item page-link">';
			$config['first_tag_close']  = '</li>';
			$config['last_tag_open']  = '<li class="page-item page-link">';
			$config['last_tag_close']  = '</li>';
			$config['cur_tag_open']  = '<li class="page-item page-link">';
			$config['cur_tag_close']  = '</li>';
			$config['next_tag_open']  = '<li class="page-item page-link">';
			$config['next_tag_close']  = '</li>';
			$config['prev_tag_open']  = '<span id=';
			$config['prev_tag_open']  = '<li class="page-item page-link">';
			$config['prev_tag_close']  = '</li>';
			$config['num_tag_open']  = '<li class="page-item page-link">';
			$config['num_tag_close']  = '</li>';

			$this->pagination->initialize($config);

			if($page>2):
				$start=(($page/$config['per_page']))*$config['per_page'];
				$data["num"]=$query->num_rows()-$page;
			else:
				$start = 0;
			endif;

			$data["start"]=$config['per_page'];
			$data["limit"]=$page;
			$data["table"]="qanda";
			$data["order_by"]="gid desc, depth asc";
			if($procc=="search"):
				$data["where"]="`title` like '%".$this->db->escape($search)."%'or `name` like '%".$this->db->escape($search)."%'";
				$query = $this->Admin_model->data_get($data);
			else:
				$query = $this->Admin_model->data_get($data);
			endif;


			$data["pagination"] = $this->pagination->create_links();
			$data["list"] = $query->result();
		else:
			$data["stats"] = "검색된 글이 없습니다.";
		endif;

		$this->load->view('admin/qanda',$data);

	}
	public function qanda_procc($data){
		$procc = $data["procc"]= $this->input->post('procc');

		$data['title']='Q&A';
		$data['subtitle']='qanda';
		$data['table']='qanda';

		if($procc=="write"):
			$data["row"]["procc"]=$procc;

			$data["row"]["title"]="";
			$data["row"]["contents"]="";
			$data["row"]["idx"]="";
			$data["row"]["pid"]="";


			$this->load->view('admin/inc/head.php',$data);
			$this->load->view('admin/inc/edge.php',$data);
			$this->load->view('admin/form',$data);
			$this->load->view('admin/inc/foot.php',$data);
			$this->load->view('admin/inc/end.php',$data);
		elseif($procc =="write_procc"):
			$row["title"] = $this->input->post('title');
			$row["contents"] = $this->input->post('contents');
			$row["date"] = time();

			$query = $this->db->query("select pid from qanda order by idx desc limit 1");
			if($query->num_rows()>0):
				$pid = $query->result();
				$row["pid"]=$pid[0]->pid+1;
			else:
				$row["pid"]=0;
			endif;
			$row["gid"]=$row["pid"];
			$row["name"]=$this->session->userdata('name');
			$row["depth"]=1;

			$this->db->insert('qanda', $row);
			redirect(HOME_PATH.'/admin/qanda', 'refresh');

		elseif($procc == "view"):
			$idx = $data["idx"]= $this->input->post('idx');

			$data["table"]="qanda";
			$data["where"]="idx=".$this->db->escape($idx);
			$query = $this->Admin_model->data_get($data);

			$data["list"]=$query->result();

			$this->load->view('admin/inc/head.php',$data);
			$this->load->view('admin/inc/edge.php',$data);
			$this->load->view('admin/qa_view',$data);
			$this->load->view('admin/inc/foot.php',$data);
			$this->load->view('admin/inc/end.php',$data);

		elseif($procc == "delete"):
			$idx = $this->input->post('idx');

			$data["table"]="qanda";
			$data["where"]="idx=".$this->db->escape($idx);
			$query = $this->Admin_model->data_get($data);



			if($query->num_rows()>0):
				foreach($query->result() as $key):
					if($key->depth == "1"):

						if($this->auth($data) != 0):
							if($key->name != $this->session->userdata('name')):
								echo "<script>alert(\"권한이 없습니다.\");</script>";
								redirect(HOME_PATH.'/admin/'.$data["table"], 'refresh');
							endif;
						endif;


						$data["where"]="gid=".$this->db->escape($key->gid);
						$this->Admin_model->data_delete($data);
					endif;
				endforeach;
			endif;

			$this->Admin_model->data_delete($data);

			echo "<script>alert(\"삭제 성공\");</script>";
			redirect(HOME_PATH.'/admin/qanda', 'refresh');
		elseif($procc == "modify"):

			$idx = $this->input->post('idx');
			$data["table"]="qanda";
			$data["where"]="idx=".$this->db->escape($idx);
			$query=$this->Admin_model->data_get($data);
			$data["list"]=$query->result();

			if($query->num_rows() > 0):
				foreach($query->result() as $key):

					if($this->auth($data) != 0):
						if($key->name != $this->session->userdata('name')):
							echo "<script>alert(\"권한이 없습니다.\");</script>";
							redirect(HOME_PATH.'/admin/'.$data["table"], 'refresh');
						endif;
					endif;


					$data["row"]["title"]=$key->title;
					$data["row"]["contents"]=$key->contents;
					$data["row"]["idx"]=$key->idx;;
					$data["row"]["pid"]=$key->pid;
				endforeach;
			endif;


			$this->load->view('admin/inc/head.php',$data);
			$this->load->view('admin/inc/edge.php',$data);
			$this->load->view('admin/form',$data);
			$this->load->view('admin/inc/foot.php',$data);
			$this->load->view('admin/inc/end.php',$data);

		elseif($procc == "modify_procc"):
			$idx = $this->input->post('idx');
			$row["title"] = $this->input->post('title');
			$row["contents"] = $this->input->post('contents');



			$this->db->where('idx', $idx);
			$this->db->update('qanda', $row);

			echo "<script>alert(\"수정 성공\");</script>";

			$data["table"]="qanda";
			$data["where"]="idx=".$idx;
			$query=$this->Admin_model->data_get($data);

			$data["list"]=$query->result();

			$this->load->view('admin/inc/head.php',$data);
			$this->load->view('admin/inc/edge.php',$data);
			$this->load->view('admin/qa_view',$data);
			$this->load->view('admin/inc/foot.php',$data);
			$this->load->view('admin/inc/end.php',$data);
		elseif($procc == "answer"):
			$idx = $this->input->post('idx');
			$data["procc"]=$procc;

			$data["table"]="qanda";
			$data["where"]="idx=".$this->db->escape($idx);
			$query=$this->Admin_model->data_get($data);

			$data["list"]=$query->result();

			if($query->num_rows() > 0):
				foreach($query->result() as $key):
					$data["row"]["title"]="[".$key->title."]";
					$data["row"]["idx"]=$key->idx;;
					$data["row"]["pid"]=$key->pid;
					$data["row"]["contents"]="";
				endforeach;
			endif;

			$this->load->view('admin/inc/head.php',$data);
			$this->load->view('admin/inc/edge.php',$data);
			$this->load->view('admin/form',$data);
			$this->load->view('admin/inc/foot.php',$data);
			$this->load->view('admin/inc/end.php',$data);
		elseif($procc=="answer_procc"):
			$idx = $this->input->post('idx');
			$row["title"] = $this->input->post('title');
			$row["contents"] = $this->input->post('contents');
			$row["date"] = time();
			$row["name"]=$this->session->userdata('name');
			$data["table"]="qanda";
			$data["where"]="idx=".$this->db->escape($idx);
			$query=$this->Admin_model->data_get($data);

			if($query->num_rows()):
				foreach($query->result() as $key):
					$gid = $key->gid;
					$pid = $key->pid;
					$depth = $key->depth;
					$pwd = $key->pwd;

					$qry=$this->db->query("select max(pid) AS max_pid  from `qanda`");

					if($qry->num_rows()):
						foreach($qry->result() as $key2):
							$max_pid= $key2->max_pid;
						endforeach;
					endif;
						$row["gid"]=$pid;
						$row["depth"]=$depth+1;
						$row["pid"]=$max_pid+1;
						$row["pwd"]=$pwd;
				endforeach;
			endif;

			$this->db->insert('qanda', $row);
			redirect(HOME_PATH.'/admin/qanda', 'refresh');
			endif;
		}
}
