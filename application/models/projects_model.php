<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects_Model extends CI_Model
{
    const table_organizations = 'organizations';
    const table_projects = 'projects';
    const table_project_team = 'project_team';
    const table_organization_team = 'organizations_users';
    const table_users = 'users';

    public function __construct()
    {
        parent::__construct();

        $this->load->library('utilities');
    }

    public function add_project($name, $description, $owner_id, $organization_id, $active = 1, $deleted = 0)
    {
        $slug = $this->utilities->slugify($name);

        $row = $this->db->get_where(self::table_projects,
            array('owner_id' => $owner_id, "organization_id" => $organization_id, "slug" => $slug))->row();

        if(isset($row->id))
            return 0;

        $this->db->insert(self::table_projects, array(
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
            'owner_id' => $owner_id,
            'organization_id' => $organization_id,
            'active' => $active,
            'deleted' => $deleted,
        ));

        return $this->db->insert_id();
    }

    public function get_users($project_id, $user_id = 0)
    {
        $this->load->model('organizations_model');

        if($user_id == 0)
        {
            $project_users = $this->db
                ->join(self::table_projects, self::table_projects.".id = ".self::table_project_team.".project_id")
                ->join(self::table_users, self::table_project_team.".user_id = ".self::table_users.".id")
                ->where('project_id', $project_id)
                ->get(self::table_project_team)
                ->result();

            $project_owner = null;
            $organization_users = array();

            $project = $this->db->get_where(self::table_projects, array('id' => $project_id))->row();

            if(isset($project->id))
            {
                $project_owner = $project->owner_id;
                $organization_users = $this->organizations_model->get_users($project_owner);
            }

            return array('project' => $project_users, 'organization' => $organization_users);
        }
        else
        {
            return $this->db->select("*")->from(self::table_project_team)
                ->join(self::table_projects)
                ->where('project_id', $project_id)
                ->where('user_id', $user_id)
                ->row();
        }
    }

    public function get_projects($user_id)
    {
        return $this->db->join(self::table_projects, self::table_project_team.".project_id = ".self::table_projects.".id")
            ->where('user_id', $user_id)
            ->order_by('name')
            ->get(self::table_project_team)
            ->result();
    }

    public function get_project($project_id)
    {
        return $this->db->get_where(self::table_projects, array('id' => $project_id))->row();
    }

    public function get_owned_projects($user_id)
    {
        return $this->db->join(self::table_projects, self::table_project_team.".project_id = ".self::table_projects.".id")
            ->where('owner_id', $user_id)
            ->order_by('name')
            ->get(self::table_project_team)
            ->result();
    }

    public function get_user_by_email($email_address)
    {
        return $this->db->get_where(self::table_users, array('email' => $email_address))->row();
    }

    public function add_project_user($project_id, $user_id, $type = 1, $active = 1, $deleted = 0)
    {
        $user = $this->db->get_where(self::table_project_team, array(
            'user_id' => $user_id,
            'project_id' => $project_id,
        ))->row();

        if(!isset($user->id))
        {
            $this->db->insert(self::table_project_team, array(
                'user_id' => $user_id,
                'project_id' => $project_id,
                'active' => $active,
                'role_id' => $type,
                'deleted' => $deleted,
            ));

            return $this->db->insert_id();
        }

        return $user->id;
    }

    public function is_member($user_id, $project_id)
    {
        // Owns project?
        $owner = $this->db->get_where(self::table_projects, array('id' => $project_id, 'owner_id' => $user_id))->row();

        if(isset($owner->id))
            return true;

        // Is team member?
        $team = $this->db->get_where(self::table_project_team, array('project_id' => $project_id, 'user_id' => $user_id))->row();

        if(isset($team->id))
            return true;

        return false;
    }

    public function create_project($project_name, $project_description, $owner_id, $organization_id)
    {
        $project_slug = $this->utilities->slugify($project_name);

        $this->db->insert('projects', array(
            'name' => $project_name,
            'slug' => $project_slug,
            'description' => $project_description,
            'owner_id' => $owner_id,
            'organization_id' => $organization_id,
            'active' => 1,
            'deleted' => 0,
        ));

        return $this->db->insert_id();
    }
}