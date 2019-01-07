<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bbs extends CI_Controller {

	public function __construct()
	{
 		parent::__construct();
		require_once(APPPATH."controllers/inc/construct.php");
 	}

	public function _remap($method)
	{
		require_once(APPPATH."controllers/inc/bbs_remap.php");
  }

	public function index($data)
	{
		$this->about($data);
	}

  public function about($data)
	{
		$data["title"] = "about";
		$data["table"]="about";
    $query=$this->Admin_model->data_get($data);

    if($query->num_rows()){
			foreach($query->result() as $key):
				$data["contents"] = $key->contents;
			endforeach;
		}
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

		$this->load->view('/about',$data);

	}

  public function skill($data)
  {

		$data["title"] = "skill";
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

    $this->load->view('/skill',$data);

  }

	public function portfolio_procc($data)
	{

		$data["title"] = "portfolio";

		$idx = $this->input->post('idx');

		if((!isset($idx))||(empty($idx))):
			echo "<script>alert('비정상적인 접근입니다');</script>";
			redirect('http://hsj7861.cafe24.com/bbs/'.$data["title"], 'refresh');
			exit;
		endif;

		$data["table"]="portfolio";
		$data["where"]="`idx` = ".$this->db->escape($idx);
		$query = $this->Admin_model->data_get($data);

		$data["list"]=$query->result();

		$this->load->view('/portfolio_view',$data);
	}

  public function portfolio($data)
  {
		$procc=$this->input->post('procc');
		$data["table"]="portfolio";

		if(isset($procc)):
			$search=$this->input->post('search');
			$data["where"]="`title` like ".$this->db->escape("%".$search."%");
			$query = $this->Admin_model->data_get($data);
		else:
			$query = $this->Admin_model->data_get($data);
		endif;

		$data["num"]=$query->num_rows();

		if($query->num_rows() > 0):
			$this->load->library('pagination');
			$config['base_url'] = '/bbs/portfolio';
			$config['total_rows'] = $query->num_rows();
			$config['per_page'] = 6;
			$config['num_links'] = 2;
			$config['uri_segment']=3;
			$data['pageNum']=$page = $this->uri->segment(3,0);

			$config['first_tag_open']  = '<li class="first">';
			$config['first_link'] = '<<';
			$config['first_tag_close']  = '</li>';
			$config['last_tag_open']  = '<li class="last">';
			$config['last_link'] = '>>';
			$config['last_tag_close']  = '</li>';
			$config['cur_tag_open']  = '<li class="num current">';
			$config['cur_tag_close']  = '</li>';
			$config['next_tag_open']  = '<li class="arrow right">';
			$config['next_tag_close']  = '</li>';
			$config['prev_tag_open']  = '<li class="arrow left">';
			$config['prev_tag_close']  = '</li>';
			$config['num_tag_open']  = '<li class="num">';
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


			if($procc=="search"):
				$data["where"]="`title` like ".$this->db->escape("%".$search."%");
				$query = $this->Admin_model->data_get($data);
			else:
				$query = $this->Admin_model->data_get($data);
			endif;

			$data["pagination"] = $this->pagination->create_links();
			$data["list"] = $query->result();
		else:
			$data["stats"] = "검색된 글이 없습니다.";
		endif;

    $this->load->view('/portfolio',$data);
  }


	public function qna_proc($data){
		$data["title"] = "qna";
		$procc =$data["procc"]= $this->input->get('procc');
		if(!isset($procc)):
			$procc = $data["procc"] =$this->input->post('procc');
		endif;

		$idx = $this->input->get('idx');
		if(!isset($idx)):
			$idx = $this->input->post('idx');
		endif;

		$pwd = $this->input->post('pwd');


		if((!isset($procc))||(empty($procc)) ||($procc=="null") || (!isset($idx))||(empty($idx)) ||($idx=="null")||(!isset($pwd))||(empty($pwd))):
			if($procc!="write" && $procc!="write_procc" && $procc!="view"):
				echo "<script>alert('비정상적인 접근입니다');</script>";
				redirect(HOME_PATH.'/bbs/'.$data["title"], 'refresh');
				exit;
			endif;
		endif;

		if($procc=="view"):
			$data["table"]="qanda";
			$data["where"]="`idx` = ".$this->db->escape($idx);
			$query = $this->Admin_model->data_get($data);
			$data["list"]=$query->result();

			if($query->num_rows() >0):
				foreach($data["list"] as $key):
					if($key->del=="y"):
						echo "<script>alert('비정상적인 접근입니다');</script>";
						redirect(HOME_PATH.'/bbs/'.$data["title"], 'refresh');
						exit;
					endif;
				endforeach;
			endif;

			$this->load->view('/qa_view',$data);

		elseif($procc=="write"):
			$data["procc"]=$procc;
			$this->load->view('/qa_write',$data);

		elseif($procc=="write_procc"):
			$row["title"]=$this->input->post('title');
			$row["name"]=$this->input->post('name');
			$row["pwd"]=hash("sha256", $this->input->post('pwd'));
			$row["name"]=$this->input->post('name');
			$row["contents"]=$this->input->post('contents');
			$row["date"] = time();

			$query = $this->db->query("select pid from qanda order by idx desc limit 1");
			if($query->num_rows()>0):
				$pid = $query->result();
				$row["pid"]=$pid[0]->pid+1;
			else:
				$row["pid"]=0;
			endif;
			$row["gid"]=$row["pid"];
			$row["depth"]=1;

			$this->db->insert('qanda', $row);
			redirect('http://hsj7861.cafe24.com/bbs/qna', 'refresh');

		elseif($procc=="modify"):
			$data["table"]="qanda";
			$data["where"]="`idx`=".$this->db->escape($idx);
			$query=$this->Admin_model->data_get($data);
			$data["list"]=$query->result();
			$this->load->view('/qa_write',$data);

		elseif($procc=="modify_procc"):
			$idx = $this->input->post('idx');
			$row["title"] = $this->input->post('title');
			$row["contents"] = $this->input->post('contents');
			$row["name"] = $this->input->post('name');

			$this->db->where('idx', $idx);
			$this->db->update('qanda', $row);

			echo "<script>alert(\"수정 성공\");</script>";

			$data["table"] = "qanda";
			$data["where"]="`idx`=".$this->db->escape($idx);
			$query=$this->Admin_model->data_get($data);
			$data["list"]=$query->result();
			$this->load->view('/qa_view',$data);

		elseif($procc=="delete"):
			$idx = $this->input->post('idx');

			$data["table"]="qanda";
			$data["where"]="`idx`=".$this->db->escape($idx);
			$query = $this->Admin_model->data_get($data);

			$row["del"] = "y";

			if($query->num_rows()>0):
				foreach($query->result() as $key):
					if($key->depth == "1"):
						$this->db->where('gid', $key->gid);
						$this->db->update('qanda', $row);

					endif;
				endforeach;
			endif;


			$row["del"] = "y";
			$this->db->where('idx', $idx);
			$this->db->update('qanda', $row);

			echo "<script>alert(\"삭제 성공\");</script>";
			redirect('http://hsj7861.cafe24.com/bbs/qna', 'refresh');
		endif;

	}


  public function qna($data)
  {
    $data["title"] = "qanda";
		$procc=$this->input->post('procc');
		$data["table"] = "qanda";

		if(isset($procc)):
			$search=$this->input->post('search');
			$data["where"]="`del`='n' and (`title` like ".$this->db->escape("%".$search."%")." or `name` like ".$this->db->escape("%".$search."%").") ";
			$data["order_by"]="gid desc, depth asc";
			$query = $this->Admin_model->data_get($data);
		else:
			$data["where"] = "`del`='n'";
			$data["order_by"]="gid desc, depth asc";
			$query = $this->Admin_model->data_get($data);
		endif;

    $data["num"]=$query->num_rows();


    if($query->num_rows() > 0):
      $config['base_url'] = '/bbs/qna';
      $config['total_rows'] = $query->num_rows();
      $config['per_page'] = 10;
      $config['num_links'] = 2;
      $config['uri_segment']=3;
      $data['pageNum']=$page = $this->uri->segment(3,0);

			$config['first_tag_open']  = '<li class="first">';
			$config['first_link'] = '<<';
			$config['first_tag_close']  = '</li>';
			$config['last_tag_open']  = '<li class="last">';
			$config['last_link'] = '>>';
			$config['last_tag_close']  = '</li>';
			$config['cur_tag_open']  = '<li class="num current">';
			$config['cur_tag_close']  = '</li>';
			$config['next_tag_open']  = '<li class="arrow right">';
			$config['next_tag_close']  = '</li>';
			$config['prev_tag_open']  = '<li class="arrow left">';
			$config['prev_tag_close']  = '</li>';
			$config['num_tag_open']  = '<li class="num">';
			$config['num_tag_close']  = '</li>';

      $this->pagination->initialize($config);

      if($page>2):
        $start=(($page/$config['per_page']))*$config['per_page'];
        $data["num"]=$query->num_rows()-$page;
      else:
        $start = 0;
      endif;

			$data["where"] = "`del`='n'";
			$data["start"]=$config['per_page'];
			$data["limit"]=$page;
			$data["table"]="qanda";
			$data["order_by"]="gid desc, depth asc";

			if($procc=="search"):
				$data["where"]="`del`='n' and (`title` like ".$this->db->escape("%".$search."%")." or `name` like ".$this->db->escape("%".$search."%").") ";
				$query = $this->Admin_model->data_get($data);
			else:
				$query = $this->Admin_model->data_get($data);
			endif;

      $data["pagination"] = $this->pagination->create_links();
      $data["list"] = $query->result();
    else:
      $data["stats"] = "검색된 글이 없습니다.";
    endif;

    $this->load->view('/qanda',$data);

  }
}
