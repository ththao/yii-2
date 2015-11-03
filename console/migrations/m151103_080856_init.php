<?php

use yii\db\Schema;
use yii\db\Migration;

class m151103_080856_init extends Migration
{
public function safeUp()
    {
        $tableOptions = NULL;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%users}}', [
            'id'                   => Schema::TYPE_PK,
            'username'             => Schema::TYPE_STRING . ' NULL DEFAULT NULL',
            'email'                => Schema::TYPE_STRING . '(50) NOT NULL',
            'auth_key'             => Schema::TYPE_STRING . '(32) NOT NULL',
            'api_key'              => Schema::TYPE_STRING . ' NULL DEFAULT NULL',
            'login_ip'             => Schema::TYPE_STRING . ' NULL DEFAULT NULL',
            'login_time'           => Schema::TYPE_TIMESTAMP . ' NULL DEFAULT NULL',
            'create_ip'            => Schema::TYPE_STRING . ' NULL DEFAULT NULL',
            'password_hash'        => Schema::TYPE_STRING . ' NOT NULL',
            'password_reset_token' => Schema::TYPE_STRING,
            'role_id'              => Schema::TYPE_INTEGER . ' not null',
            'status'               => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1',
            'created_time'         => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_time'         => Schema::TYPE_INTEGER . ' NOT NULL',
            ], $tableOptions);

        $this->createTable('{{%roles}}', [
            'id'           => Schema::TYPE_PK,
            'name'         => Schema::TYPE_STRING . ' not null',
            'created_time' => Schema::TYPE_INTEGER . ' null default null',
            'updated_time' => Schema::TYPE_INTEGER . ' null default null',
            'can_admin'    => Schema::TYPE_SMALLINT . ' not null default 0',
            ], $tableOptions);

        $this->createTable('{{%profiles}}', [
            'id'            => Schema::TYPE_PK,
            'user_id'       => Schema::TYPE_INTEGER . ' not null',
            'first_name'    => Schema::TYPE_STRING . ' null default null',
            'last_name'     => Schema::TYPE_STRING . ' null default null',
            'display_name'  => Schema::TYPE_STRING . ' null default null',
            'address'       => Schema::TYPE_STRING . ' NULL DEFAULT NULL',
            'address2'      => Schema::TYPE_STRING . ' NULL DEFAULT NULL',
            'mobile_number' => Schema::TYPE_STRING . ' NULL DEFAULT NULL',
            'city'          => Schema::TYPE_STRING . ' NULL DEFAULT NULL',
            'state_id'      => Schema::TYPE_STRING . ' NULL DEFAULT NULL',
            'country_id'    => Schema::TYPE_STRING . ' NULL DEFAULT NULL',
            'created_time'  => Schema::TYPE_INTEGER . ' null default null',
            'updated_time'  => Schema::TYPE_INTEGER . ' null default null',
            ], $tableOptions);

        // add indexes for performance optimization
        $this->createIndex('{{%user_email}}', '{{%users}}', 'email', true);
        $this->createIndex('{{%user_username}}', '{{%users}}', 'username', true);

        // insert role data
        $columns = ['name', 'can_admin', 'created_time'];
        $this->batchInsert('{{%roles}}', $columns, [
            ['Administrator', 1, date('Y-m-d H:i:s')],
            ['Member', 2, date('Y-m-d H:i:s')],
        ]);

        // insert admin user: admin/admin
        $security = Yii::$app->security;
        $columns  = ['role_id', 'email', 'username', 'password_hash', 'status', 'created_time', 'api_key', 'auth_key'];
        $hash     = Yii::$app->getSecurity()->generatePasswordHash('admin');
        $this->batchInsert('{{%users}}', $columns, [
            [
                1, // admin
                'admin@ceresolutions.com',
                'admin',
                $hash,
                1, // active
                time(),
                $security->generateRandomString(),
                $security->generateRandomString(),
            ],
        	[
                2, // member
                'ththao@ceresolutions.com',
                'ththao',
                $hash,
                1, // active
                time(),
                $security->generateRandomString(),
                $security->generateRandomString(),
            ],
        ]);
        // insert profile data
        $columns  = ['user_id', 'display_name', 'created_time'];
        $this->batchInsert('{{%profiles}}', $columns, [
            [1, 'Admin User', time()],
        	[2, 'Thao Tran', time()],
        ]);
        
        $this->createTable('{{%newsletters}}', [
        		'id'           => $this->primaryKey(),
        		'subject'      => $this->string()->notNull(),
        		'content'      => $this->text()->notNull(),
        		'role_id'      => $this->integer()->notNull(),
        		'status'       => $this->boolean()->defaultValue(1)->notNull(),
        		'created_time' => $this->integer(11)->notNull(),
        		'updated_time' => $this->integer(11),
        ], $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%users}}');
        $this->dropTable('{{%profiles}}');
        $this->dropTable('{{%roles}}');
        $this->dropTable("{{%newsletters}}");
    }
}
