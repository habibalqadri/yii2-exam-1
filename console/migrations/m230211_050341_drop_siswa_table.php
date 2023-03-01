<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%siswa}}`.
 */
class m230211_050341_drop_siswa_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('{{%siswa}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->createTable('{{%siswa}}', [
            'id' => $this->primaryKey(),
        ]);
    }
}
