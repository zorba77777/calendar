<?php

use yii\db\Migration;

/**
 * Class m190614_214749_CreateTables
 */
class m190614_214749_CreateTables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('activity',[
            'id'=>$this->primaryKey(),
            'title'=>$this->string(150)->notNull(),
            'description'=>$this->text(),
            'startDate'=>$this->date()->notNull(),
            'endDate'=>$this->date(),
            'isBlocking'=>$this->boolean()->notNull()->defaultValue(0),
            'isRepeating'=>$this->boolean()->notNull()->defaultValue(0),
            'email'=>$this->string(150),
            'created_at'=>$this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->createTable('users',[
            'id'=>$this->primaryKey(),
            'email'=>$this->string(150)->notNull()->unique(),
            'password_hash'=>$this->string(300)->notNull(),
            'auth_token'=>$this->string(300),
            'auth_key'=>$this->string(150),
            'created_at'=>$this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
        $this->dropTable('activity');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190614_214749_CreateTables cannot be reverted.\n";

        return false;
    }
    */
}
