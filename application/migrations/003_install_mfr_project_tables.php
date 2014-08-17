<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Install_mfr_project_tables extends CI_Migration {

    const table_discussions = 'project_discussions';
    const table_discussions_thread = 'project_discussion_thread';
    const table_files = 'project_files';

    public function up()
    {
        // Discussion
        $this->dbforge->drop_table(self::table_discussions);

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
            'project_id' => array(
                'type' => 'BIGINT',
                'null' => false,
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
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
        $this->dbforge->create_table(self::table_discussions);

        // Discussion thread
        $this->dbforge->drop_table(self::table_discussions_thread);

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'discussion_id' => array(
                'type' => 'BIGINT',
                'null' => false,
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'null' => false,
            ),
            'discussion_text' => array(
                'type' => 'TEXT',
                'null' => true,
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
        $this->dbforge->create_table(self::table_discussions_thread);

        // Files
        $this->dbforge->drop_table(self::table_files);

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'discussion_item_id' => array(
                'type' => 'BIGINT',
                'null' => true,
                'default' => 0,
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'null' => false,
            ),
            'file_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
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
        $this->dbforge->create_table(self::table_files);
    }

    public function down()
    {
        $this->dbforge->drop_table(self::table_discussions);
        $this->dbforge->drop_table(self::table_discussions_thread);
        $this->dbforge->drop_table(self::table_files);
    }
}
