<?php

use yii\db\Migration;

/**
 * Class m230211_033633_ref_tahun_ajaran_table
 */
class m230211_033633_ref_tahun_ajaran_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ref_tahun_ajaran}}', [
            'id' => $this->primaryKey(),
            'tahun_ajaran' => $this->string(100),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230211_033633_ref_tahun_ajaran_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230211_033633_ref_tahun_ajaran_table cannot be reverted.\n";

        return false;
    }
    */
}
