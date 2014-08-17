<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Initialize extends CI_Controller
{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */

    public function index()
    {
        $this->load->library('migration');

        if($this->db->table_exists('users') && $this->db->table_exists('groups'))
        {
            show_404();
        }
        else
        {
            $this->migration->version(1);
            $this->load->view('migration_complete');
        }
    }
}

/* End of file initialize.php */
/* Location: ./application/controllers/initialize.php */