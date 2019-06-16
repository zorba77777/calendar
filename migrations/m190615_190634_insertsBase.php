<?php

use yii\db\Migration;

/**
 * Class m190615_190634_insertsBase
 */
class m190615_190634_insertsBase extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('users',[
            'id'=>1,
            'email'=>'test@test.ru',
            'password_hash'=>'1231231',
        ]);
        $this->insert('users',[
            'id'=>2,
            'email'=>'test2@test.ru',
            'password_hash'=>'1231231',
        ]);

        $this->batchInsert('activity',['title',
            'startDate','isBlocking','user_id'],[
            ['title '.mt_rand(0,22223),date('Y-m-d'),mt_rand(0,1),1],
            ['title '.mt_rand(0,22223),date('Y-m-d'),mt_rand(0,1),1],
            ['title '.mt_rand(0,22223),date('Y-m-d'),mt_rand(0,1),1],
            ['title '.mt_rand(0,22223),date('Y-m-d'),mt_rand(0,1),2],
            ['title '.mt_rand(0,22223),date('Y-m-d'),mt_rand(0,1),2],
            ['title '.mt_rand(0,22223),date('Y-m-d'),mt_rand(0,1),2],
            ['title '.mt_rand(0,22223),date('Y-m-d'),mt_rand(0,1),2],
            ['title '.mt_rand(0,22223),date('Y-m-d'),mt_rand(0,1),2],
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('activity');
        $this->delete('users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190615_190634_insertsBase cannot be reverted.\n";

        return false;
    }
    */
}
