<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders_items}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%products}}`
 * - `{{%orders}}`
 */
class m210223_210829_create_orders_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%orders_items}}', [
            'id' => $this->primaryKey(),
            'product_name' => $this->string(255)->notNull(),
            'product_id' => $this->integer(11)->notNull(),
            'unit_price' => $this->decimal(10,2)->notNull(),
            'order_id' => $this->integer(11)->notNull(),
            'quantity' => $this->integer(2)->notNull(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            '{{%idx-orders_items-product_id}}',
            '{{%orders_items}}',
            'product_id'
        );

        // add foreign key for table `{{%products}}`
        $this->addForeignKey(
            '{{%fk-orders_items-product_id}}',
            '{{%orders_items}}',
            'product_id',
            '{{%products}}',
            'id',
            'CASCADE'
        );

        // creates index for column `order_id`
        $this->createIndex(
            '{{%idx-orders_items-order_id}}',
            '{{%orders_items}}',
            'order_id'
        );

        // add foreign key for table `{{%orders}}`
        $this->addForeignKey(
            '{{%fk-orders_items-order_id}}',
            '{{%orders_items}}',
            'order_id',
            '{{%orders}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%products}}`
        $this->dropForeignKey(
            '{{%fk-orders_items-product_id}}',
            '{{%orders_items}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            '{{%idx-orders_items-product_id}}',
            '{{%orders_items}}'
        );

        // drops foreign key for table `{{%orders}}`
        $this->dropForeignKey(
            '{{%fk-orders_items-order_id}}',
            '{{%orders_items}}'
        );

        // drops index for column `order_id`
        $this->dropIndex(
            '{{%idx-orders_items-order_id}}',
            '{{%orders_items}}'
        );

        $this->dropTable('{{%orders_items}}');
    }
}
