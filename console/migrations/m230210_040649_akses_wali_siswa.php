<?php

use yii\db\Migration;

/**
 * Class m230210_040649_akses_wali_siswa
 */
class m230210_040649_akses_wali_siswa extends Migration
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
                        '/Wali/*', 2, NULL, NULL, NULL, time(), time()
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
        echo "m230210_040649_akses_wali_siswa cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230210_040649_akses_wali_siswa cannot be reverted.\n";

        return false;
    }
    */
}
