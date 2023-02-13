<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%guru_mata_pelajaran}}`.
 */
class m230211_071858_drop_guru_mata_pelajaran_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('{{%guru_mata_pelajaran}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->createTable('{{%guru_mata_pelajaran}}', [
            'id' => $this->primaryKey(),
        ]);
    }
}
