<?php

use yii\db\Migration;

/**
 * Class m221230_025801_tables
 */
class m221230_025801_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%barang}}', [
            'id' => $this->primaryKey(),
            'kode_barang' => $this->string(100),
            'deskripsi' => $this->text(),
            'harga' => $this->bigInteger(),
            'stok' => $this->tinyInteger(),
            'diskon' => $this->double(),
            'id_supplier' => $this->tinyInteger()->notNull(),
        ]);

        $this->createTable('{{%supplier}}', [
            'id' => $this->primaryKey(),
            'nama_supplier' => $this->text(),
            'no_telp' => $this->string(15),
            'alamat' => $this->text(),
        ]);
        $this->createTable('{{%pembeli}}', [
            'id' => $this->primaryKey(),
            'nama_pembeli' => $this->text(),
            'npwp' => $this->string(15),
            'no_polisi' => $this->string(15),
            'alamat' => $this->text(),
        ]);

        $this->createTable('{{%pembayaran}}', [
            'id' => $this->primaryKey(),
            'tgl_bayar' => $this->date(),
            'total_bayar' => $this->bigInteger(),
            'id_transaksi' => $this->integer()->notNull(),
        ]);

        $this->createTable('{{%transaksi}}', [
            'id' => $this->primaryKey(),
            'id_barang' => $this->integer()->notNull(),
            'no_faktur' => $this->string(100),
            'qty' => $this->tinyInteger(),
            'total_bayar' => $this->bigInteger(),
            'id_pembeli' => $this->integer()->notNull(),
            'tanggal' => $this->date(),
            'keterangan' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221230_025801_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221230_025801_tables cannot be reverted.\n";

        return false;
    }
    */
}