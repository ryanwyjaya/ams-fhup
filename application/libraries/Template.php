<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Template
{
    protected $_ci;

    function __construct()
    {
        $this->_ci = &get_instance();
    }

    function render_page($content, $data = NULL)
    {
       
        
        $this->_ci->load->view('templates/header', $data);
        $this->_ci->load->view('templates/navbar', $data);
        $this->_ci->load->view('templates/sidebar', $data);
        $this->_ci->load->view($content, $data);
        $this->_ci->load->view('templates/footer', $data);
    }

    function render_auth($content, $data = NULL)
    { 
        $this->_ci->load->view('templates/auth_header1', $data);
        $this->_ci->load->view($content, $data);
        $this->_ci->load->view('templates/auth_footer1', $data);
    }

    function front_page($content, $data = NULL)
    {
       
        
        $this->_ci->load->view('frontend/template/header', $data);
        $this->_ci->load->view('frontend/template/topbar', $data);
        $this->_ci->load->view('frontend/template/navbar', $data);
        $this->_ci->load->view($content, $data);
        $this->_ci->load->view('frontend/template/footer', $data);
    }
     function print($content, $data = NULL)
    {
        $this->_ci->load->view('templates/header_print', $data);
        $this->_ci->load->view($content, $data);
        $this->_ci->load->view('templates/footer_print', $data);
    }
}
