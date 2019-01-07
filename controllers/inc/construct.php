<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

$this->load->database();
$this->load->model("Admin_model");
$this->load->library("session");
$this->load->library("upload");
$this->load->library("image_lib");
$this->load->library('zip');
$this->load->library('pagination');
$this->load->helper('directory');
$this->load->helper('file');
$this->load->helper("security");
$this->load->helper("form");
$this->load->helper("download");
$this->load->helper('array');
$this->load->helper('url');

define("HOME_PATH","http://hsj7861.cafe24.com");
?>
