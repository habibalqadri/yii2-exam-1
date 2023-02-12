<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%siswa}}`.
 */
class m230210_032417_add_column_to_siswa_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('siswa', 'tempat_lahir', $this->string(50));
    
        $this->addColumn('siswa', 'tanggal_lahir', $this->date());
    
        $this->addColumn('siswa', 'id_user', $this->integer());
    
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
