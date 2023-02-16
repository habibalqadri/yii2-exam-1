<?php

use yii\db\Migration;

/**
 * Class m230216_042335_add_role_guru_lihat_mapel
 */
class m230216_042335_add_role_guru_lihat_mapel extends Migration
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
                    '/lihat-mapel/*', 2, NULL, NULL, NULL, time(), time()
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
                    'Guru', '/lihat-mapel/*'
                ],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230216_042335_add_role_guru_lihat_mapel cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230216_042335_add_role_guru_lihat_mapel cannot be reverted.\n";

        return false;
    }
    */
}
