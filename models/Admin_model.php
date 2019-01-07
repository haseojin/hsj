<?php
class Admin_model extends CI_Model {

    function __construct()
    {
        $this->load->database();
        parent::__construct();
    }

    function data_get($data){

      if(isset($data["where"])):
        $this->db->where($data["where"]);
      endif;

      if(isset($data["order_by"])):
        $this->db->order_by($data["order_by"]);
      else:
        $this->db->order_by('idx', 'desc');
      endif;
      if(isset($data["start"])&&isset($data["limit"])):
        $this->db->limit($data["start"],$data["limit"]);
      endif;
      return $this->db->get($data["table"]);
    }

    function data_delete($data){
      $this->db->where($data["where"]);
      $this->db->delete($data["table"]);
    }



}
