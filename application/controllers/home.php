<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

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

    const account_type_user = 2;
    const account_type_organization = 3;

    private $group_id = 0;

    public $id = null;

    // Constructor

    public function __construct()
    {
        parent::__construct();

        $this->load->model('organizations_model');
        $this->load->model('projects_model');

        if($this->ion_auth->in_group('organizations'))
        {
            $this->group_id = self::account_type_organization;
        }
        else if($this->ion_auth->in_group('members'))
        {
            $this->group_id = self::account_type_user;
        }
    }

    // Utility functions

    private function get_projects($user_id = 0)
    {
        $current_user_id = $this->ion_auth->get_user_id();

        return $this->organizations_model->get_owned_projects($user_id == 0 ? $current_user_id : $user_id);
    }

    private function get_user_projects($user_id = 0)
    {
        $current_user_id = $this->ion_auth->get_user_id();

        return $this->projects_model->get_projects($user_id == 0 ? $current_user_id : $user_id);
    }

    private function validate_is_organization_owner($organization_id, $user_id)
    {
        $this->organizations_model->is_organization_for_user($user_id, $organization_id);
    }

    private function validate_is_project_for_organization($organization_id, $project_id)
    {
        $this->organizations_model->is_project_for_organization($organization_id, $project_id);
    }

    private  function validate_is_project_user($project_id, $user_id)
    {
        return $this->projects_model->is_member($user_id, $project_id);
    }

    // Controllers

	public function index()
	{
        $view_loaded = false;

        switch($this->group_id)
        {
            case self::account_type_organization:
                $organization_sidebar = $this->load->view('partials/organization-sidebar', null, true);
                $project_sidebar = $this->load->view('partials/project-sidebar', null, true);

                $this->load->view('organization_landing', array(
                    'projects' => $this->get_projects(),
                    'organization_sidebar' => $organization_sidebar,
                    'projects_sidebar' => $project_sidebar,
                ));

                $view_loaded = true;
                break;
            case self::account_type_user:
                $project_sidebar = $this->load->view('partials/project-sidebar', null, true);

                $this->load->view('user_landing', array(
                    'projects' => $this->get_user_projects(),
                    'project_sidebar' => $project_sidebar,
                ));

                $view_loaded = true;
                break;
        }

        if(!$view_loaded)
            $this->load->view('index');
	}

    public function organization_projects($organization_id)
    {
        $current_user_id = $this->ion_auth->get_user_id();

        if(!$this->validate_is_organization_owner($organization_id, $current_user_id))
            show_404();

        // Show projects
        $projects = $this->organizations_model->get_projects($organization_id);
        $this->load->view('organization_projects', array('projects' => $projects));
    }

    public function project_landing($project_id)
    {
        $current_user_id = $this->ion_auth->get_user_id();

        if(!$this->validate_is_project_user($project_id, $current_user_id))
            show_404();

        // Load project landing
        $project = $this->projects_model->get_project($project_id);

        $this->load->view('project_landing', array(
            'project' => $project,
        ));
    }

    public function my_organizations()
    {
        if (!$this->ion_auth->logged_in() || $this->ion_auth->in_group('organizations'))
        {
            show_404();
        }

        $user = $this->ion_auth->user();
        $user_id = $user->id;

        $organizations = $this->organizations_model->get_organizations($user_id);

        $this->load->view('my_organizations', array('organizations' => $organizations));
    }
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
