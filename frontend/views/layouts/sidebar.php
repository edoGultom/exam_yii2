<?php

use yii\helpers\Url;

$controller = Yii::$app->controller->id;
$action = Yii::$app->controller->action->id;
$controlleraction = $controller . '/' . $action;

$barang = ($controller == 'barang') ? 'active' : '';
$supplier = ($controller == 'supplier') ? 'active' : '';
$pembeli = ($controller == 'pembeli') ? 'active' : '';
$pembelian = ($controller == 'pembelian') ? 'active' : '';
$invoice = ($controller == 'invoice') ? 'active' : '';

$isActiveTransaksi = (in_array('active', array($pembelian, $invoice))) ? 'active' : '';
$isActiveMaster = (in_array('active', array($barang, $supplier, $pembeli))) ? 'active' : '';
// echo "<pre>";
// print_r(array($barang, $supplier, $pembeli));
// print_r($isActiveMaster);
// echo "</pre>";
// exit();
?>
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?= Url::to(['/site']) ?>">DEMO APP</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?= Url::to(['/site']) ?>">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Utama</li>
            <li class="nav-item dropdown <?= $isActiveMaster ?>">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Master</span></a>
                <ul class="dropdown-menu">
                    <li class=<?= $barang ?>>
                        <a class="nav-link" href="<?= Url::to(['/barang']); ?>">
                            <i class="fas fa-box"></i> Data Barang
                        </a>
                    </li>
                    <li class=<?= $supplier ?>>
                        <a class="nav-link" href="<?= Url::to(['/supplier']); ?>">
                            <i class="fas fa-building"></i> Data Supplier
                        </a>
                    </li>
                    <li class=<?= $pembeli ?>>
                        <a class="nav-link" href="<?= Url::to(['/pembeli']) ?>">
                            <i class="fas fa-person"></i> Data Customer
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="sidebar-menu">
            <li class="menu-header">Transaksi</li>
            <li class="nav-item dropdown <?= $isActiveTransaksi ?>">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-dollar-sign"></i><span>Transaksi</span></a>
                <ul class="dropdown-menu">
                    <li class=<?= $pembelian ?>>
                        <a class="nav-link" href="<?= Url::to(['/pembelian']); ?>">
                            <i class="fas fa-shopping-bag"></i> Pembelian Barang
                        </a>
                    </li>
                    <li class=<?= $invoice ?>>
                        <a class="nav-link" href="<?= Url::to(['/invoice']); ?>">
                            <i class="fas fa-file-pdf"></i>Invoice
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</div>