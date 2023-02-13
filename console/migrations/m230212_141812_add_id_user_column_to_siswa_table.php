<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%siswa}}`.
 */
class m230212_141812_add_id_user_column_to_siswa_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('siswa', 'id_user', $this->integer()->after('id_kelas'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('siswa', 'id_user');
    }
}
