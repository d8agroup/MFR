<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Install_mfr_tables extends CI_Migration {

    const table_organization_user = 'organizations_users';
    const table_projects = 'projects';
    const table_project_team = 'project_team';

    const table_user_confirmation = 'user_confirmation';

    public function up()
    {
        // Organization users
        $this->dbforge->drop_table(self::table_organization_user);

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'null' => false,
            ),
            'organization_id' => array(
                'type' => 'BIGINT',
                'null' => false,
            ),
            'user_role' => array(
                'type' => 'MEDIUMINT',
                'null' => true,
            ),
            'active' => array(
                'type' => 'SMALLINT',
                'default' => 1,
                'null' => false,
            ),
            'type' => array(
                'type' => 'MEDIUMINT',
                'null' => false,
            ),
            'deleted' => array(
                'type' => 'SMALLINT',
                'default' => 0,
                'null' => false,
            ),
            'timestamp' => array(
                'type' => 'timestamp',
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table(self::table_organization_user);

        // Project
        $this->dbforge->drop_table(self::table_projects);

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => false,
            ),
            'slug' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => false,
            ),
            'description' => array(
                'type' => 'TEXT',
                'null' => true,
            ),
            'owner_id' => array(
                'type' => 'BIGINT',
                'constraint' => '100',
                'null' => false,
            ),
            'organization_id' => array(
                'type' => 'BIGINT',
                'constraint' => '100',
                'null' => false,
            ),
            'active' => array(
                'type' => 'SMALLINT',
                'default' => 1,
                'null' => false,
            ),
            'deleted' => array(
                'type' => 'SMALLINT',
                'default' => 0,
                'null' => false,
            ),
            'timestamp' => array(
                'type' => 'timestamp',
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table(self::table_projects);

        // Project team
        $this->dbforge->drop_table(self::table_project_team);

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'project_id' => array(
                'type' => 'BIGINT',
                'unsigned' => true,
                'null' => false,
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'null' => false,
            ),
            'role_id' => array(
                'type' => 'MEDIUMINT',
                'null' => false,
            ),
            'active' => array(
                'type' => 'SMALLINT',
                'default' => 1,
                'null' => false,
            ),
            'deleted' => array(
                'type' => 'SMALLINT',
                'default' => 0,
                'null' => false,
            ),
            'timestamp' => array(
                'type' => 'timestamp',
            ),
        ));

        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table(self::table_project_team);

        // User confirmation
        $this->dbforge->drop_table(self::table_user_confirmation);

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'null' => false,
            ),
            'confirm_code' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => true,
            ),
            'timestamp' => array(
                'type' => 'timestamp',
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table(self::table_user_confirmation);
    }

    public function down()
    {
        $this->dbforge->drop_table(self::table_organization);
        $this->dbforge->drop_table(self::table_organization_user);
        $this->dbforge->drop_table(self::table_projects);
        $this->dbforge->drop_table(self::table_project_team);
        $this->dbforge->drop_table(self::table_user_confirmation);
    }
}
