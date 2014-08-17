<?php
/**
 * My custom controller: With Authentication features and default libraries loaded
 */

class MY_Controller extends CI_Controller
{
    protected $is_logged_in;

    function __construct()
    {
        parent::__construct();

        // Load classes to work with
        $this->load->helper('url');
        $this->load->library('ion_auth');
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters(
            $this->config->item('error_start_delimiter', 'ion_auth'),
            $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->helper('language');

        $this->is_logged_in = $this->ion_auth->logged_in();

        // Initialize
        $this->_init();
        $this->_init_sections();
    }

    private function _init()
    {
        // Set default template
        $this->output->set_template('bootstrap');

        // Load default assets
        $this->load->js('assets/themes/bootstrap/js/jquery.js');
        $this->load->js('assets/themes/bootstrap/js/bootstrap.min.js');
        $this->load->css('assets/themes/bootstrap/css/bootstrap.min.css');
        $this->load->css('assets/themes/bootstrap/css/style.css');
        $this->load->css('assets/themes/bootstrap/css/font.css');
        $this->load->css('assets/themes/bootstrap/css/extra-style.css');
    }

    private function _init_sections()
    {
        // Load default sections

        $this->load->section('nav_bar', 'themes/'.$this->output->get_template().'/nav-bar', array(
            'logged_in' => $this->is_logged_in,
            'is_admin' => $this->ion_auth->is_admin(),
            'user_id' => $this->ion_auth->get_user_id(),
            'is_organization' => $this->ion_auth->in_group('organizations'),
        ));
    }

    protected function force_login()
    {
        if(!$this->is_logged_in)
        {
            redirect('users/login');
        }
    }
}