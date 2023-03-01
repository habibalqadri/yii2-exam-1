<?php

use yii\db\Migration;

/**
 * Class m230212_144058_add_role_profile
 */
class m230212_144058_add_role_profile extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert(
            'auth_item_child',
            [
                'parent',
                'child'
            ],
            [
                [
                    'Siswa', '/siswa/*'
                ],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230212_144058_add_role_profile cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230212_144058_add_role_profile cannot be reverted.\n";

        return false;
    }
    */
}
