<?php

use yii\db\Migration;

/**
 * Class m230212_174902_add_primarykey_guru_mataPelajaran
 */
class m230212_174902_add_primarykey_guru_mataPelajaran extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('guru_mata_pelajaran', 'id' , $this->primaryKey());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230212_174902_add_primarykey_guru_mataPelajaran cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230212_174902_add_primarykey_guru_mataPelajaran cannot be reverted.\n";

        return false;
    }
    */
}
