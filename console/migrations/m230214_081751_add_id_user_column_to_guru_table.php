<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%guru}}`.
 */
class m230214_081751_add_id_user_column_to_guru_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('guru', 'id_user', $this->integer()->after('nama_guru'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
