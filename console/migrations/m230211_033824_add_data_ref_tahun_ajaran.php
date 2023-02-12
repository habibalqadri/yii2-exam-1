<?php

use yii\db\Migration;

/**
 * Class m230211_033824_add_data_ref_tahun_ajaran
 */
class m230211_033824_add_data_ref_tahun_ajaran extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert(
            'ref_tahun_ajaran', 
            [
                'tahun_ajaran',
            ], 
            [
                ['2020'],
                ['2021'],
                ['2022'],
                ['2023'],
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230211_033824_add_data_ref_tahun_ajaran cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230211_033824_add_data_ref_tahun_ajaran cannot be reverted.\n";

        return false;
    }
    */
}
