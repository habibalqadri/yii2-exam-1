<?php

use yii\db\Migration;

/**
 * Class m230213_023731_add_role_riwayat_kelas
 */
class m230213_023731_add_role_riwayat_kelas extends Migration
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
                    'Siswa', '/siswa-rw-kelas/*'
                ],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230213_023731_add_role_riwayat_kelas cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230213_023731_add_role_riwayat_kelas cannot be reverted.\n";

        return false;
    }
    */
}
