<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utilities extends MY_Controller
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

    public function __construct()
    {
        parent::__construct();

        // Load libs and other required stuff
        $this->load->library('migration');
    }

    public function do_migration($version)
    {
        $this->force_login();

        if(!$this->ion_auth->is_admin())
        {
            show_404();
        }
        else
        {
            $this->migration->version($version);
            $this->load->view('migration_complete');
        }
    }
}

/* End of file utilities.php */
/* Location: ./application/controllers/utilities.php */