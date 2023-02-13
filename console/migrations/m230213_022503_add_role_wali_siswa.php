<?php

use yii\db\Migration;

/**
 * Class m230213_022503_add_role_wali_siswa
 */
class m230213_022503_add_role_wali_siswa extends Migration
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
                    'Siswa', '/wali/*'
                ],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230213_022503_add_role_wali_siswa cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230213_022503_add_role_wali_siswa cannot be reverted.\n";

        return false;
    }
    */
}
