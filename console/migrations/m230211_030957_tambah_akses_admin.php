<?php

use yii\db\Migration;

/**
 * Class m230211_030957_tambah_akses_admin
 */
class m230211_030957_tambah_akses_admin extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
                $this->batchInsert(
                    'auth_item',
                    [
                        'name',
                        'type',
                        'description',
                        'rule_name',
                        'data',
                        'created_at',
                        'updated_at'
                    ],
                    [
                        [
                            '/guru/*', 2, NULL, NULL, NULL, time(), time()
                        ],
                        [
                            '/mata-pelajaran/*', 2, NULL, NULL, NULL, time(), time()
                        ],
                    ]
                );
        
                $this->batchInsert(
                    'auth_item_child',
                    [
                        'parent',
                        'child'
                    ],
                    [
                        [
                            'Admin', '/guru/*'
                        ],
                        [
                            'Admin', '/mata-pelajaran/*'
                        ],
                    ]
                );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230211_030957_tambah_akses_admin cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230211_030957_tambah_akses_admin cannot be reverted.\n";

        return false;
    }
    */
}
