<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

$data = array();
$data["name"] = "";
$data["birthday"] = "";
$data["adress"] = "";
$data["email"] = "";
$data["phonenumber"] = "";


$segment = $this->uri->segment(2,0);
if( ($segment!="login") && ($segment!="login_post") ):
  if ($this -> session -> userdata('id') == FALSE):
    echo "<script>alert(\"로그인 후 이용하세요\");</script>";
    redirect(HOME_PATH.'/admin/', 'refresh');
    exit;
  endif;
endif;

$data["title"]="About";
$data["subtitle"]=$data["subtitle"]="about";

if( ($method=="login") || ($method=="index") ):
  if(empty($this->session->userdata('id'))):

    $data["title"]="Login";
    $data["subtitle"]=$data["subtitle"]="login";

    $this->load->view('/admin/inc/head.php',$data);
    $this -> {"{$method}"}($data);
    $this->load->view('/admin/inc/foot.php',$data);
    $this->load->view('/admin/inc/end.php',$data);
  else:
    $data["title"]="About";
    $data["subtitle"]=$data["subtitle"]="about";
    $method="about";
    $this->load->view('/admin/inc/head.php',$data);
    $this->load->view('/admin/inc/edge.php',$data);

    $this->{"{$method}"}($data);

    $this->load->view('/admin/inc/foot.php',$data);
    $this->load->view('/admin/inc/end.php',$data);
  endif;
elseif(($method=="about") || ($method=="personalinfo") || ($method=="skill") || ($method=="portfolio") || ($method=="qanda")):
  $data["title"]=ucwords($method);
  $data["subtitle"]=$data["subtitle"]=$method;

  if($method=="qanda"):
    $data["title"]="Q&A";
    $data["subtitle"]=$data["subtitle"]="Q&A";
  endif;


  $this->load->view('/admin/inc/head.php',$data);
  $this->load->view('/admin/inc/edge.php',$data);

  $this->{"{$method}"}($data);

  $this->load->view('/admin/inc/foot.php',$data);
  $this->load->view('/admin/inc/end.php',$data);
else:
  if (method_exists($this, $method)):

    $tmp = explode('_' , $method);
    $data["title"]=ucwords($tmp[0]);
    $data["subtitle"]=$data["subtitle"]=$tmp[0];

    if($tmp[0]=="login"):
      $data["title"]="About";
      $data["subtitle"]=$data["subtitle"]="about";

      $this->load->view('/admin/inc/head.php',$data);
      $this->load->view('/admin/inc/edge.php',$data);

      $this->{"{$method}"}($data);

      $this->load->view('/admin/inc/foot.php',$data);
      $this->load->view('/admin/inc/end.php',$data);

    else:
      if($tmp[0]=="qanda"):
        $data["title"]="Q&A";
        $data["subtitle"]=$data["subtitle"]="Q&A";
      endif;
      $this->{"{$method}"}($data);
    endif;
  endif;
endif;
?>
