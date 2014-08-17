<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends MY_Controller {

    const account_type_user = 2;
    const account_type_organization = 3;

    private $group_id = 0;
    private $user;

    public $id = null;

    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('users/login', 'refresh');
        }

        $this->user = $this->ion_auth->user();

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

    private  function validate_is_project_user($project_id, $user_id)
    {
        return $this->projects_model->is_member($user_id, $project_id);
    }

    public function create_project()
    {
        $variables = array();

        if($this->group_id == self::account_type_user) {
            $variables['messages'] = array("You can not create projects as a user account. Only organizations can do so");
            $variables['show_create_form'] = false;
        }
        else if($this->group_id == self::account_type_organization)
        {
            $variables['show_create_form'] = true;

            $post_variables = $this->input->post();

            if($post_variables)
            {
                if(trim($post_variables['project_name']) == '')
                {
                    $variables['messages'][] = "Project name unspecified";
                }
                else
                {
                    $project_id = $this->projects_model->create_project(
                        $post_variables['project_name'],
                        $post_variables['project_description'],
                        $this->ion_auth->get_user_id(),
                        $this->ion_auth->get_user_id()
                    );
                    redirect('home');
                }
            }
        }

        $this->load->view('project/create_project', $variables);
    }

    public function search_projects()
    {
        $this->load->view('project/search_project');
    }

    public function view($project_id)
    {
        $current_user_id = $this->ion_auth->get_user_id();

        if(!$this->validate_is_project_user($project_id, $current_user_id))
            show_404();

        $organization_sidebar = null;
        $project_sidebar = $this->load->view('partials/project-sidebar', array('project_id' => $project_id), true);

        if($this->group_id == self::account_type_organization)
        {
            $organization_sidebar = $this->load->view('partials/organization-project-sidebar',
                array('project_id' => $project_id) , true);
        }

        $this->load->view('project/view', array('organization_sidebar' => $organization_sidebar,
            'project_sidebar' => $project_sidebar));
    }

    public function dashboard($project_id)
    {
        $current_user_id = $this->ion_auth->get_user_id();

        if(!$this->validate_is_project_user($project_id, $current_user_id))
            show_404();

        $organization_sidebar = null;
        $project_sidebar = $this->load->view('partials/project-sidebar', array('project_id' => $project_id), true);

        if($this->group_id == self::account_type_organization)
        {
            $organization_sidebar = $this->load->view('partials/organization-project-sidebar',
                array('project_id' => $project_id) , true);
        }

        $this->load->view('project/dashboard', array('organization_sidebar' => $organization_sidebar,
            'project_sidebar' => $project_sidebar));
    }

    public function view_progress($project_id)
    {
        $this->load->view('project/view_progress');
    }

    public function enter_data($project_id)
    {
        $this->load->view('project/enter_data');
    }

    public function generate_reports($project_id)
    {
        $this->load->view('project/generate_reports');
    }

    // Discussions

    public function start_a_discussion($project_id)
    {
        $this->load->view('project/start_a_discussion');
    }

    public function view_discussions($project_id)
    {
        // View active discussions
    }

    public function open_discussion($discussion_id)
    {
        // Open a discussion
    }

    // Files

    public function upload_a_file($project_id)
    {
        $this->load->view('project/upload_a_file');
    }

    public function view_files($project_id)
    {
        // View files
    }

    public function download_file($file_id)
    {
        // Download a file
    }

    // Reports

    public function view_reports($project_id)
    {
        $this->load->view('project/view_reports');
    }

    // Timeline

    public function timeline($project_id)
    {
        $this->load->view('project/timeline');
    }
}