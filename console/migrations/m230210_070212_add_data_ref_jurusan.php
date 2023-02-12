<?php

use yii\db\Migration;

/**
 * Class m230210_070212_add_data_ref_jurusan
 */
class m230210_070212_add_data_ref_jurusan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert(
            'ref_jurusan',
            [
                'jurusan',
            ],
            [
                ['UMUM'],
                ['IPA'],
                ['IPS'],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230210_070212_add_data_ref_jurusan cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230210_070212_add_data_ref_jurusan cannot be reverted.\n";

        return false;
    }
    */
}
