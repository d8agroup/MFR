<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Organization extends MY_Controller {

    const account_type_user = 2;
    const account_type_organization = 3;

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
            show_404();
        }
    }

    private  function validate_is_project_user($project_id, $user_id)
    {
        return $this->projects_model->is_member($user_id, $project_id);
    }

    public function index()
    {
        show_404();
    }

    public function project_users($project_id)
    {
        $current_user_id = $this->ion_auth->get_user_id();

        if(!$this->validate_is_project_user($project_id, $current_user_id))
            show_404();

        $this->load->library("gravatar");

        $organization_sidebar = $this->load->view('partials/organization-sidebar', null, true);
        $users = $this->projects_model->get_users($project_id);
        $flash_message = $this->session->flashdata('flash_message');

        foreach($users['project'] as &$user)
        {
            $user->gravatar = $this->gravatar->get_gravatar($user->email);
        }

        foreach($users['organization'] as &$user)
        {
            $user->gravatar = $this->gravatar->get_gravatar($user->email);
        }

        $this->load->view('organization/project_users',
            array('organization_sidebar' => $organization_sidebar, 'users' => $users,
                'flash_message' => $flash_message, 'project_id' => $project_id));
    }

    public function users()
    {
        $this->load->library("gravatar");

        $organization_sidebar = $this->load->view('partials/organization-sidebar', null, true);
        $users = $this->organizations_model->get_users($this->ion_auth->get_user_id());
        $flash_message = $this->session->flashdata('flash_message');

        foreach($users as &$user)
        {
            $user->gravatar = $this->gravatar->get_gravatar($user->email);
        }

        $this->load->view('organization/users',
            array('organization_sidebar' => $organization_sidebar, 'users' => $users,
                'flash_message' => $flash_message));
    }

    public function add_project_user()
    {
        $post_vars = $this->input->post();

        if($post_vars)
        {
            $project_id = $post_vars['project_id'];

            $current_user_id = $this->ion_auth->get_user_id();

            if(!$this->validate_is_project_user($project_id, $current_user_id))
                show_404();

            $email_address = $post_vars["email_address"];
            $email_address_array = explode(",", $email_address);

            $result = false;

            if(is_array($email_address_array))
            {
                foreach($email_address_array as $email_item)
                {
                    $user = $this->projects_model->get_user_by_email(trim($email_item));

                    if(isset($user->id))
                    {
                        $this->projects_model->add_project_user($project_id, $this->ion_auth->get_user_id());
                    }
                }

                $result = true;
            }
            else
            {
                $user = $this->projects_model->get_user_by_email(trim($email_address));

                if(isset($user->id))
                {
                    $result = $this->projects_model->add_project_user($project_id, $this->ion_auth->get_user_id());
                }
            }

            redirect('organization/project_users/'.$project_id);
        }
        else
        {
            show_404();
        }
    }

    public function add_organization_user()
    {
        $post_vars = $this->input->post();

        if($post_vars)
        {
            $email_address = $post_vars["email_address"];
            $email_address_array = explode(",", $email_address);

            $result = false;

            // Multiple addresses?
            if(is_array($email_address_array))
            {
                foreach($email_address_array as $email_item)
                {
                    $this->organizations_model->add_organization_user_by_email($this->ion_auth->get_user_id(),
                        trim($email_item));
                }

                $result = true;
            }
            else
            {
                $result = $this->organizations_model->add_organization_user_by_email($this->ion_auth->get_user_id(),
                    trim($email_address));
            }

            if($result)
            {
                $this->session->set_flashdata('flash_message', 'User has been added to project');
            }
            else
            {
                $this->session->set_flashdata('flash_message', 'User specified does not exist');
            }

            redirect('organization/users');
        }
        else
        {
            show_404();
        }
    }
}