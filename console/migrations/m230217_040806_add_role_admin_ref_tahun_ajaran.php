<?php

use yii\db\Migration;

/**
 * Class m230217_040806_add_role_admin_ref_tahun_ajaran
 */
class m230217_040806_add_role_admin_ref_tahun_ajaran extends Migration
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
                    '/ref-tahun-ajaran/*', 2, NULL, NULL, NULL, time(), time()
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
                    'Admin', '/ref-tahun-ajaran/*'
                ],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230217_040806_add_role_admin_ref_tahun_ajaran cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230217_040806_add_role_admin_ref_tahun_ajaran cannot be reverted.\n";

        return false;
    }
    */
}
