<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
if(isset($method)):
  if($method=="index"):
    $data["title"] = "about";
    $this->load->view('/inc/head.php',$data);
    $this->load->view('/inc/edge.php',$data);
    $this->{"{$method}"}($data);
    $this->load->view('/inc/foot.php',$data);
    $this->load->view('/inc/end.php',$data);
  elseif($method=="qna"):
    $data["title"] = "qanda";
    $this->load->view('/inc/head.php',$data);
    $this->load->view('/inc/edge.php',$data);
    $this->{"{$method}"}($data);
    $this->load->view('/inc/foot.php',$data);
    $this->load->view('/inc/end.php',$data);
  else:
    $tmp = explode('_' , $method);
    $data["title"]=$tmp[0];

    if($data["title"] == "qna"):
      $data["title"] = "qanda";
    endif;

    $this->load->view('/inc/head.php',$data);
    $this->load->view('/inc/edge.php',$data);
    $this->{"{$method}"}($data);
    $this->load->view('/inc/foot.php',$data);
    $this->load->view('/inc/end.php',$data);
  endif;
endif;
?>
