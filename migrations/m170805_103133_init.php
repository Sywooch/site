<?php

use yii\db\Migration;

class m170805_103133_init extends Migration
{
    const CART        = 'cart';
    const CATEGORY    = 'categories';
    const GOODS       = 'goods';
    const IMAGE       = 'image';
    const ORDER       = 'order';
    const ORDER_ITEMS = 'order_items';
    const PAGES       = 'pages';
    const USER        = 'user';

    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        $this->createTable(self::CART,
            [
                'id'         => $this->primaryKey(),
                'user_id'    => $this->char(255)->notNull(),
                'product_id' => $this->integer(10)->notNull(),
                'qty'        => $this->integer(10)->unsigned()->notNull(),
                'name'       => $this->char(255)->notNull(),
                'price'      => $this->integer(50)->notNull(),
                'img'        => $this->char(255)->notNull(),
            ], $tableOptions);

        $this->createTable(self::CATEGORY,
            [
                'id'       => $this->primaryKey(),
                'cat'      => $this->char(50)->notNull(),
                'cat_name' => $this->char(255)->notNull(),
            ], $tableOptions);

        $this->createTable(self::GOODS,
            [
                'id'    => $this->primaryKey(),
                'title' => $this->char(255)->notNull(),
                'discr' => $this->text(),
                'price' => $this->integer(10)->unsigned()->notNull(),
                'cat'   => $this->char(50)->notNull(),
                'img'   => $this->char(255)->notNull(),
            ], $tableOptions);


        $this->createTable(self::IMAGE,
            [
                'id'        => $this->primaryKey(),
                'filePath'  => $this->char(255)->notNull(),
                'itemId'    => $this->integer(11)->notNull(),
                'isMain'    => $this->smallInteger(1)->notNull(),
                'modelName' => $this->char(150)->notNull(),
                'urlAlias'  => $this->char(255)->notNull(),
                'name'      => $this->char(255)->notNull(),
            ], $tableOptions);

        $this->createTable(self::ORDER,
            [
                'id'         => $this->primaryKey(),
                'created_at' => $this->dateTime()->notNull(),
                'updated_at' => $this->dateTime()->notNull(),
                'qty'        => $this->integer(10)->notNull(),
                'sum'        => $this->decimal(10, 2)->notNull(),
                'status'     => $this->smallInteger(1)->defaultValue(0)->notNull(),
                'name'       => $this->char(255)->notNull(),
                'email'      => $this->char(255)->notNull(),
                'phone'      => $this->char(255)->notNull(),
                'address'    => $this->char(255)->notNull(),
            ], $tableOptions);

        $this->createTable(self::ORDER_ITEMS,
            [
                'id'         => $this->primaryKey(),
                'order_id'   => $this->integer(10)->notNull(),
                'product_id' => $this->integer(10)->notNull(),
                'name'       => $this->char(255)->notNull(),
                'price'      => $this->decimal(10, 2)->notNull(),
                'qty_item'   => $this->integer(11)->notNull(),
                'sum_item'   => $this->decimal(10, 2)->notNull(),
            ], $tableOptions);

        $this->createTable(self::PAGES,
            [
                'id'               => $this->primaryKey(),
                'module'           => $this->char(255)->notNull(),
                'static'           => $this->smallInteger(1)->defaultValue(1)->notNull(),
                'meta_description' => $this->text()->notNull(),
                'meta_keywords'    => $this->text()->notNull(),
                'meta_title'       => $this->text()->notNull(),
                'text'             => $this->text()->notNull(),
            ], $tableOptions);

        $this->createTable(self::USER,
            [
                'id'       => $this->primaryKey(),
                'username' => $this->char(255)->notNull(),
                'password' => $this->char(255)->notNull(),
                'auth_key' => $this->char(255)->notNull(),
            ], $tableOptions);
    }

    public function safeDown()
    {
        echo "m170805_103133_init cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170805_103133_init cannot be reverted.\n";

        return false;
    }
    */
}
