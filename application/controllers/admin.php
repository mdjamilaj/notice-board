<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {

  public function home()
  {
    $this->load->view('header');
    $this->load->view('home');
    $this->load->view('footer');
  }
  public function aboutus()
  {
    $this->load->view('header');
    $this->load->view('about_us');
    $this->load->view('footer');
  }
  public function admission()
  {
    $this->load->view('header');
    $this->load->view('addmission');
    $this->load->view('footer');
  }

  public function contectus()
  {
    $this->load->view('header');
    $this->load->view('contectus');
    $this->load->view('footer');
  }

  public function courses()
  {
    $this->load->view('header');
    $this->load->view('courses');
    $this->load->view('footer');
  }

}
