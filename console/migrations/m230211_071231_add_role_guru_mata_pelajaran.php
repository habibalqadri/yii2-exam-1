<?php

use yii\db\Migration;

/**
 * Class m230211_071231_add_role_guru_mata_pelajaran
 */
class m230211_071231_add_role_guru_mata_pelajaran extends Migration
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
                    '/guru-mata-pelajaran/*', 2, NULL, NULL, NULL, time(), time()
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
                    'Admin', '/guru-mata-pelajaran/*'
                ],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230211_071231_add_role_guru_mata_pelajaran cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230211_071231_add_role_guru_mata_pelajaran cannot be reverted.\n";

        return false;
    }
    */
}
