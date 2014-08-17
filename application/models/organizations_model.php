<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Organizations_Model extends CI_Model
{
    const table_organizations = 'users';
    const table_projects = 'projects';
    const table_organization_users = 'organizations_users';
    const table_users = 'users';

    public function __construct()
    {
        parent::__construct();

        $this->load->library('utilities');
    }

    public function add_organization($name, $description, $owner_id, $type = 0, $active = 1, $deleted = 0)
    {
        $slug = $this->utilities->slugify($name);

        $row = $this->db->get_where(self::table_organizations, array('owner_id' => $owner_id, "slug" => $slug))->row();

        if(isset($row->id))
            return 0;

        $this->db->insert(self::table_organizations, array(
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
            'owner_id' => $owner_id,
            'type' => $type,
            'active' => $active,
            'deleted' => $deleted,
        ));

        return $this->db->insert_id();
    }

    public function get_projects($organization_id, $project_id = 0)
    {
        if($project_id == 0)
        {
            return $this->db->join(self::table_organizations, self::table_projects.".organization_id = ".self::table_organizations.".id")
                ->where('organization_id', $organization_id)
                ->get(self::table_projects)
                ->result();
        }
        else
        {
            return $this->db->join(self::table_organizations, self::table_projects.".organization_id = ".self::table_organizations.".id")
                ->where('organization_id', $organization_id)
                ->where('project_id', $project_id)
                ->get(self::table_projects)
                ->row();
        }
    }

    public function get_owned_projects($organization_id)
    {
        return $this->db->join(self::table_organizations, self::table_projects.".organization_id = ".self::table_organizations.".id")
            ->where('owner_id', $organization_id)
            ->select(self::table_organizations.'.id AS user_id, '.self::table_projects.".*")
            ->get(self::table_projects)
            ->result();
    }

    public function get_organizations($user_id)
    {
        return $this->db->join(self::table_organizations, self::table_organizations.".id = ".self::table_organization_users.".organization_id")
            ->where('user_id', $user_id)
            ->select(self::table_organizations.'.id AS organization_id, '.self::table_organization_users.".*")
            ->get(self::table_organization_users)
            ->result();
    }

    public function get_users($organization_id, $user_id = 0)
    {
        if($user_id == 0)
            return $this->db->join(self::table_organizations, self::table_organizations.".id = ".self::table_organization_users.".organization_id")
                ->where('organization_id', $organization_id)
                ->get(self::table_organization_users)
                ->result();
        else
            return $this->db->join(self::table_organizations, self::table_organizations.".id = ".self::table_organization_users.".organization_id")
                ->where('organization_id', $organization_id)
                ->where('user_id', $user_id)
                ->get(self::table_organization_users)
                ->row();
    }

    public function add_organization_user($organization_id, $user_id, $type = 1, $active = 1, $deleted = 0)
    {
        $user_exists = $this->db->get_where(self::table_organization_users,
            array('user_id' => $user_id, 'organization_id' => $organization_id))->row();

        if(!isset($user_exists->id))
        {
            $this->db->insert(self::table_organization_users, array(
                'user_id' => $user_id,
                'organization_id' => $organization_id,
                'active' => $active,
                'type' => $type,
                'deleted' => $deleted,
            ));

            return $this->db->insert_id();
        }

        return $user_exists->id;
    }

    public function add_organization_user_by_email($organization_id, $email_address, $type = 1, $active = 1, $deleted = 0)
    {
        // Find a user by that email address
        $user = $this->db->get_where(self::table_users, array('email' => $email_address))->row();

        if(isset($user->id))
        {
            return $this->add_organization_user($organization_id, $user->id, $type, $active, $deleted);
        }

        return false;
    }

    public function is_organization_for_user($organization_id, $user_id)
    {
        $organization = $this->db->get_where(self::table_organizations,
            array('id' => $organization_id, 'owner_id' => $user_id))->row();

        if(isset($organization->id))
            return true;

        return false;
    }

    public function is_project_for_organization($organization_id, $project_id)
    {
        $owner = $this->db->get_where(self::table_projects,
            array('organization_id' => $organization_id, 'id' => $project_id))->row();

        if(isset($owner->id))
            return true;

        return false;
    }
}