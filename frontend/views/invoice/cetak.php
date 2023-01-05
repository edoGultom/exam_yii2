<h3 style="text-align:center">FAKTUR JUAL</h3>
<table class="table table-strip" style="font-size:8pt">
    <tr>
        <td></td>
        <td> </td>
        <td> </td>
        <td>Kepad Ytd :</td>
        <td>: </td>
        <td> </td>
    </tr>
    <tr>
        <td>No Faktur</td>
        <td width="5%">: </td>
        <td><?= $no_faktur ?> </td>
        <td>Nama</td>
        <td>: </td>
        <td><?= $pembeli->nama_pembeli ?> </td>
    </tr>
    <tr>
        <td>Tanggal</td>
        <td width="5%">: </td>
        <td><?= Yii::$app->formatter->asDate(date('now')) ?> </td>
        <td>Alamat</td>
        <td>: </td>
        <td><?= $pembeli->alamat ?> </td>
    </tr>
    <tr>
        <td>No Polisi</td>
        <td width="5%">: </td>
        <td><?= $pembeli->no_polisi ?> </td>
        <td>NPWP</td>
        <td>: </td>
        <td><?= $pembeli->npwp ?> </td>
    </tr>
</table>
<table class="table table-bordered">
    <tr>
        <th align="center">No</th>
        <th align="center">Kode Part</th>
        <th align="center">Deskripsi</th>
        <th align="center">Qty</th>
        <th align="center">HET</th>
        <th align="center">Diskon</th>
        <th align="center">Jumlah</th>
    </tr>
    <?php
    $no = 1;
    $subtotal = 0;
    $dsikonFaktur = 0;
    $total = 0;
    foreach ($model as $key => $value) {
        $jumlah = ($value->qty * ((100 - $value->barang->diskon) * $value->barang->harga) / 100);
        $subtotal += $jumlah;
        $total += $subtotal + $dsikonFaktur;
    ?>
    <tr>
        <td align="center"><?= $no++ ?></td>
        <td align="center"><?= $value->barang->kode_barang ?></td>
        <td align="center"><?= $value->barang->deskripsi ?></td>
        <td align="center"><?= $value->qty ?></td>
        <td align="center"><?= $value->barang->harga ?></td>
        <td align="center"><?= $value->barang->diskon ?></td>
        <td align="center"><?= $jumlah ?></td>
    </tr>
    <?php
    }
    ?>
    <tr>
        <td colspan="5"></td>
        <td align="right">Sub Total</td>
        <td align="center"><?= $subtotal ?></td>
    </tr>
    <tr>
        <td colspan="5"></td>
        <td align="right">Diskon Faktur</td>
        <td align="center"><?= $dsikonFaktur ?></td>
    </tr>
    <tr>
        <td colspan="5"></td>
        <td align="right">Total</td>
        <td align="center"><?= $total ?></td>
    </tr>
</table>