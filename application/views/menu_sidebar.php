<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?> 
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel logo -->
      <!-- <div class="user-panel">
        <div class="pull-left image">
          <?php foreach ($data_user as $val) { ?>
            <img src="<?php echo config_item('assets'); ?>img/user_img/thumbs/<?php echo $val->thumb_gambar_user; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $val->nama_lengkap_user;?></p>
          <?php } ?>
        </div>
      </div> -->

      <?php $level = $this->session->userdata('id_level_user');?>
      <?php switch ($level) {
      case '1': ?>
      <ul class="sidebar-menu">
        <!-- dashboard -->
        <li class="<?php if ($this->uri->segment('1') == 'home') {echo 'active';} ?>">
          <a href="<?php echo site_url('home');?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <!-- end dashboard -->

        <!-- master treeview -->
        <!-- tentukan attribute active class -->
        <li class="
          <?php if ($this->uri->segment('1') == 'pengguna') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'barang') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'supplier') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'borongan') {
              echo 'active treeview';
            } ?>">

          <a href="#">
            <i class="fa fa-database"></i>
            <span>Data Master</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <!-- tentukan attribute active class -->
          <ul class="treeview-menu">
            <li class="<?php if ($this->uri->segment('1') == 'pengguna') {echo 'active';} ?>">
              <a href="<?php echo site_url('pengguna');?>"><i class="fa fa-user-plus"></i> Master Pengguna</a>
            </li>
            <li class="<?php if ($this->uri->segment('1') == 'barang') {echo 'active';} ?>">
              <a href="<?php echo site_url('barang');?>"><i class="fa fa-tasks"></i> Master Barang</a>
            </li> 
            <li class="<?php if ($this->uri->segment('1') == 'supplier') {echo 'active';} ?>">
              <a href="<?php echo site_url('supplier');?>"><i class="fa fa-phone"></i> Master Supplier</a>
            </li>
            <li class="<?php if ($this->uri->segment('1') == 'borongan') {echo 'active';} ?>">
              <a href="<?php echo site_url('borongan');?>"><i class="fa fa-address-card-o"></i> Master Borongan</a>
            </li>
          </ul>
        </li>
        <!-- end master treeview -->

        <!-- transaksi treeview -->
        <!-- tentukan attribute active class -->
        <li class="
           <?php if ($this->uri->segment('1') == 'trans_order') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'trans_beli') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'trans_masuk') {
              echo 'active treeview';  
            }elseif ($this->uri->segment('1') == 'trans_keluar') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'retur_masuk') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'retur_keluar') {
              echo 'active treeview';
            } ?>">

          <a href="#">
            <i class="fa fa-exchange"></i>
            <span>Data Transaksi</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <!-- tentukan attribute active class -->
          <ul class="treeview-menu">
            <li class="<?php if ($this->uri->segment('1') == 'trans_order') {echo 'active';} ;?>">
              <a href="<?php echo site_url('trans_order');?>"><i class="fa fa-list"></i> Order Barang</a>
            </li>
            <li class="<?php if ($this->uri->segment('1') == 'trans_beli') {echo 'active';} ?>">
              <a href="<?php echo site_url('trans_beli');?>"><i class="fa fa-shopping-cart"></i> Pembelian Barang</a>
            </li>
            <li class="<?php if ($this->uri->segment('1') == 'trans_masuk') {echo 'active';} ?>">
              <a href="<?php echo site_url('trans_masuk');?>"><i class="fa fa-plus-square"></i> Penerimaan Barang</a>
            </li>
            <li class="<?php if ($this->uri->segment('1') == 'trans_keluar') {echo 'active';} ?>">
              <a href="<?php echo site_url('trans_keluar');?>"><i class="fa fa-minus-square"></i> Pengeluaran Barang</a>
            </li>
            <li class="<?php if ($this->uri->segment('1') == 'retur_masuk') {echo 'active';} ?>">
              <a href="<?php echo site_url('retur_masuk');?>"><i class="fa fa-long-arrow-left"></i> Retur Barang Masuk</a>
            </li>
            <li class="<?php if ($this->uri->segment('1') == 'retur_keluar') {echo 'active';} ?>">
              <a href="<?php echo site_url('retur_keluar');?>"><i class="fa fa-long-arrow-right"></i> Retur Barang Keluar</a>
            </li>
          </ul>
        </li>
        <!-- end transaksi treeview -->
        
        <!-- statistik treeview -->
        <!-- tentukan attribute active class -->
        <li class="
           <?php if ($this->uri->segment('1') == 'rop') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'forecasting') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'grafik_barang') {
              echo 'active treeview';
            } ?>">

          <a href="#">
            <i class="fa fa-line-chart"></i>
            <span>Data Statistik</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <!-- tentukan attribute active class -->
          <ul class="treeview-menu">
            <li class="<?php if ($this->uri->segment('1') == 'rop') {echo 'active';} ;?>">
              <a href="<?php echo site_url('rop');?>"><i class="fa fa-refresh"></i> Reorder Point</a>
            </li>
            <li class="<?php if ($this->uri->segment('1') == 'forecasting') {echo 'active';} ?>">
              <a href="<?php echo site_url('forecasting');?>"><i class="fa fa-signal"></i> Peramalan</a>
            </li>
            <li class="<?php if ($this->uri->segment('1') == 'grafik_barang') {echo 'active';} ?>">
              <a href="<?php echo site_url('grafik_barang');?>"><i class="fa fa-area-chart"></i> Grafik Barang</a>
            </li>
          </ul>
        </li>
        <!-- end statistik treeview -->

        <!-- laporan treeview -->
        <!-- tentukan attribute active class -->
        <li class="
           <?php if ($this->uri->segment('1') == 'laporan_order') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'laporan_beli') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'laporan_history_beli') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'laporan_masuk') {
              echo 'active treeview';  
            }elseif ($this->uri->segment('1') == 'laporan_keluar') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'laporan_retur_masuk') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'laporan_retur_keluar') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'laporan_mutasi') {
              echo 'active treeview';
            } ?>">

          <a href="#">
            <i class="fa fa-bar-chart-o"></i>
            <span>Laporan</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <!-- tentukan attribute active class -->
          <ul class="treeview-menu">
            <li class="<?php if ($this->uri->segment('1') == 'laporan_order') {echo 'active';} ;?>">
              <a href="<?php echo site_url('laporan_order');?>"> Laporan Permintaan</a>
            </li>
            <li class="<?php if ($this->uri->segment('1') == 'laporan_beli') {echo 'active';} ?>">
              <a href="<?php echo site_url('laporan_beli');?>"> Laporan Pembelian</a>
            </li>
            <li class="<?php if ($this->uri->segment('1') == 'laporan_history_beli') {echo 'active';} ?>">
              <a href="<?php echo site_url('laporan_history_beli');?>"> Laporan Riwayat Pembelian</a>
            </li>
            <li class="<?php if ($this->uri->segment('1') == 'laporan_masuk') {echo 'active';} ?>">
              <a href="<?php echo site_url('laporan_masuk');?>"> Laporan Penerimaan</a>
            </li>
            <li class="<?php if ($this->uri->segment('1') == 'laporan_keluar') {echo 'active';} ?>">
              <a href="<?php echo site_url('laporan_keluar');?>"> Laporan Pengeluaran</a>
            </li>
             <li class="<?php if ($this->uri->segment('1') == 'laporan_retur_masuk') {echo 'active';} ?>">
              <a href="<?php echo site_url('laporan_retur_masuk');?>"> Laporan Penerimaan Retur</a>
            </li>
             <li class="<?php if ($this->uri->segment('1') == 'laporan_retur_keluar') {echo 'active';} ?>">
              <a href="<?php echo site_url('laporan_retur_keluar');?>"> Laporan Pengeluaran Retur</a>
            </li>
             <li class="<?php if ($this->uri->segment('1') == 'laporan_mutasi') {echo 'active';} ?>">
              <a href="<?php echo site_url('laporan_mutasi');?>"> Laporan Mutasi</a>
            </li>
          </ul>
        </li>
        <!-- end laporan treeview -->

        <!-- pesan treeview -->
        <!-- tentukan attribute active class -->
        <li class="
           <?php if ($this->uri->segment('1') == 'pesan') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'inbox') {
              echo 'active treeview';
            } ?>">

          <a href="#">
            <i class="fa fa-envelope"></i>
            <span>pesan</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <!-- tentukan attribute active class -->
          <ul class="treeview-menu">
            <li class="<?php if ($this->uri->segment('1') == 'pesan') {echo 'active';} ;?>">
              <a href="<?php echo site_url('pesan');?>"> Tulis Pesan</a>
            </li>
            <li class="<?php if ($this->uri->segment('1') == 'inbox') {echo 'active';} ;?>">
              <a href="<?php echo site_url('inbox');?>"> Pesan Masuk</a>
            </li>
          </ul>
        </li>
        <!-- end pesan treeview -->
      </ul>   
          <?php break; ?>
      
      <?php case '2': ?>
      <ul class="sidebar-menu">
        <!-- dashboard -->
        <li class="<?php if ($this->uri->segment('1') == 'home') {echo 'active';} ?>">
          <a href="<?php echo site_url('home');?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <!-- end dashboard -->

        <!-- master treeview -->
        <!-- tentukan attribute active class -->
        <li class="
          <?php if($this->uri->segment('1') == 'borongan') {
              echo 'active treeview';
            } ?>">

          <a href="#">
            <i class="fa fa-database"></i>
            <span>Data Master</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <!-- tentukan attribute active class -->
          <ul class="treeview-menu">
            <li class="<?php if ($this->uri->segment('1') == 'borongan') {echo 'active';} ?>">
              <a href="<?php echo site_url('borongan');?>"><i class="fa fa-address-card-o"></i> Master Borongan</a>
            </li>
          </ul>
        </li>
        <!-- end master treeview -->

        <!-- statistik treeview -->
        <!-- tentukan attribute active class -->
        <li class="
           <?php if ($this->uri->segment('1') == 'grafik_barang') {
              echo 'active treeview';
            } ?>">

          <a href="#">
            <i class="fa fa-line-chart"></i>
            <span>Data Statistik</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <!-- tentukan attribute active class -->
          <ul class="treeview-menu">
            <li class="<?php if ($this->uri->segment('1') == 'grafik_barang') {echo 'active';} ?>">
              <a href="<?php echo site_url('grafik_barang');?>"><i class="fa fa-area-chart"></i> Grafik Barang</a>
            </li>
          </ul>
        </li>
        <!-- end statistik treeview -->

        <!-- laporan treeview -->
        <!-- tentukan attribute active class -->
        <li class="
           <?php if ($this->uri->segment('1') == 'laporan_order') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'laporan_beli') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'laporan_history_beli') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'laporan_masuk') {
              echo 'active treeview';  
            }elseif ($this->uri->segment('1') == 'laporan_keluar') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'laporan_retur_masuk') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'laporan_retur_keluar') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'laporan_mutasi') {
              echo 'active treeview';
            } ?>">

          <a href="#">
            <i class="fa fa-bar-chart-o"></i>
            <span>Laporan</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <!-- tentukan attribute active class -->
          <ul class="treeview-menu">
            <li class="<?php if ($this->uri->segment('1') == 'laporan_order') {echo 'active';} ;?>">
              <a href="<?php echo site_url('laporan_order');?>"> Laporan Permintaan</a>
            </li>
            <li class="<?php if ($this->uri->segment('1') == 'laporan_beli') {echo 'active';} ?>">
              <a href="<?php echo site_url('laporan_beli');?>"> Laporan Pembelian</a>
            </li>
            <li class="<?php if ($this->uri->segment('1') == 'laporan_history_beli') {echo 'active';} ?>">
              <a href="<?php echo site_url('laporan_history_beli');?>"> Laporan Riwayat Pembelian</a>
            </li>
            <li class="<?php if ($this->uri->segment('1') == 'laporan_masuk') {echo 'active';} ?>">
              <a href="<?php echo site_url('laporan_masuk');?>"> Laporan Penerimaan</a>
            </li>
            <li class="<?php if ($this->uri->segment('1') == 'laporan_keluar') {echo 'active';} ?>">
              <a href="<?php echo site_url('laporan_keluar');?>"> Laporan Pengeluaran</a>
            </li>
             <li class="<?php if ($this->uri->segment('1') == 'laporan_retur_masuk') {echo 'active';} ?>">
              <a href="<?php echo site_url('laporan_retur_masuk');?>"> Laporan Penerimaan Retur</a>
            </li>
             <li class="<?php if ($this->uri->segment('1') == 'laporan_retur_keluar') {echo 'active';} ?>">
              <a href="<?php echo site_url('laporan_retur_keluar');?>"> Laporan Pengeluaran Retur</a>
            </li>
             <li class="<?php if ($this->uri->segment('1') == 'laporan_mutasi') {echo 'active';} ?>">
              <a href="<?php echo site_url('laporan_mutasi');?>"> Laporan Mutasi</a>
            </li>
          </ul>
        </li>
        <!-- end laporan treeview -->

        <!-- pesan treeview -->
        <!-- tentukan attribute active class -->
        <li class="
           <?php if ($this->uri->segment('1') == 'pesan') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'inbox') {
              echo 'active treeview';
            } ?>">

          <a href="#">
            <i class="fa fa-envelope"></i>
            <span>pesan</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <!-- tentukan attribute active class -->
          <ul class="treeview-menu">
            <li class="<?php if ($this->uri->segment('1') == 'pesan') {echo 'active';} ;?>">
              <a href="<?php echo site_url('pesan');?>"> Tulis Pesan</a>
            </li>
            <li class="<?php if ($this->uri->segment('1') == 'inbox') {echo 'active';} ;?>">
              <a href="<?php echo site_url('inbox');?>"> Pesan Masuk</a>
            </li>
          </ul>
        </li>
        <!-- end pesan treeview -->
      </ul>   
          <?php break; ?>   

      <?php case '3': ?>
      <ul class="sidebar-menu">
        <!-- dashboard -->
        <li class="<?php if ($this->uri->segment('1') == 'home') {echo 'active';} ?>">
          <a href="<?php echo site_url('home');?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <!-- end dashboard -->

        <!-- master treeview -->
        <!-- tentukan attribute active class -->
        <li class="
          <?php if ($this->uri->segment('1') == 'barang') {
              echo 'active treeview';
            }?>">

          <a href="#">
            <i class="fa fa-database"></i>
            <span>Data Master</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <!-- tentukan attribute active class -->
          <ul class="treeview-menu">
            <li class="<?php if ($this->uri->segment('1') == 'barang') {echo 'active';} ?>">
              <a href="<?php echo site_url('barang');?>"><i class="fa fa-tasks"></i> Master Barang</a>
            </li> 
          </ul>
        </li>
        <!-- end master treeview -->

        <!-- transaksi treeview -->
        <!-- tentukan attribute active class -->
        <li class="
           <?php if ($this->uri->segment('1') == 'trans_order') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'trans_masuk') {
              echo 'active treeview';  
            }elseif ($this->uri->segment('1') == 'trans_keluar') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'retur_masuk') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'retur_keluar') {
              echo 'active treeview';
            } ?>">

          <a href="#">
            <i class="fa fa-exchange"></i>
            <span>Data Transaksi</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <!-- tentukan attribute active class -->
          <ul class="treeview-menu">
            <li class="<?php if ($this->uri->segment('1') == 'trans_order') {echo 'active';} ;?>">
              <a href="<?php echo site_url('trans_order');?>"><i class="fa fa-shopping-cart"></i> Order Barang</a>
            </li>
            <li class="<?php if ($this->uri->segment('1') == 'trans_masuk') {echo 'active';} ?>">
              <a href="<?php echo site_url('trans_masuk');?>"><i class="fa fa-plus-square"></i> Penerimaan Barang</a>
            </li>
            <li class="<?php if ($this->uri->segment('1') == 'trans_keluar') {echo 'active';} ?>">
              <a href="<?php echo site_url('trans_keluar');?>"><i class="fa fa-minus-square"></i> Pengeluaran Barang</a>
            </li>
            <li class="<?php if ($this->uri->segment('1') == 'retur_masuk') {echo 'active';} ?>">
              <a href="<?php echo site_url('retur_masuk');?>"><i class="fa fa-long-arrow-left"></i> Retur Barang Masuk</a>
            </li>
            <li class="<?php if ($this->uri->segment('1') == 'retur_keluar') {echo 'active';} ?>">
              <a href="<?php echo site_url('retur_keluar');?>"><i class="fa fa-long-arrow-right"></i> Retur Barang Keluar</a>
            </li>
          </ul>
        </li>
        <!-- end transaksi treeview -->

        <!-- statistik treeview -->
        <!-- tentukan attribute active class -->
        <li class="
           <?php if ($this->uri->segment('1') == 'rop') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'forecasting') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'grafik_barang') {
              echo 'active treeview';
            } ?>">

          <a href="#">
            <i class="fa fa-line-chart"></i>
            <span>Data Statistik</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <!-- tentukan attribute active class -->
          <ul class="treeview-menu">
            <li class="<?php if ($this->uri->segment('1') == 'rop') {echo 'active';} ;?>">
              <a href="<?php echo site_url('rop');?>"><i class="fa fa-refresh"></i> Reorder Point</a>
            </li>
            <li class="<?php if ($this->uri->segment('1') == 'forecasting') {echo 'active';} ?>">
              <a href="<?php echo site_url('forecasting');?>"><i class="fa fa-signal"></i> Peramalan</a>
            </li>
            <li class="<?php if ($this->uri->segment('1') == 'grafik_barang') {echo 'active';} ?>">
              <a href="<?php echo site_url('grafik_barang');?>"><i class="fa fa-area-chart"></i> Grafik Barang</a>
            </li>
          </ul>
        </li>
        <!-- end statistik treeview -->
    
        <!-- laporan treeview -->
        <!-- tentukan attribute active class -->
        <li class="
           <?php if ($this->uri->segment('1') == 'laporan_order') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'laporan_masuk') {
              echo 'active treeview';  
            }elseif ($this->uri->segment('1') == 'laporan_keluar') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'laporan_retur_masuk') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'laporan_retur_keluar') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'laporan_mutasi') {
              echo 'active treeview';
            } ?>">

          <a href="#">
            <i class="fa fa-bar-chart-o"></i>
            <span>Laporan</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <!-- tentukan attribute active class -->
          <ul class="treeview-menu">
            <li class="<?php if ($this->uri->segment('1') == 'laporan_order') {echo 'active';} ;?>">
              <a href="<?php echo site_url('laporan_order');?>"> Laporan Permintaan</a>
            </li>
            <li class="<?php if ($this->uri->segment('1') == 'laporan_masuk') {echo 'active';} ?>">
              <a href="<?php echo site_url('laporan_masuk');?>"> Laporan Penerimaan</a>
            </li>
            <li class="<?php if ($this->uri->segment('1') == 'laporan_keluar') {echo 'active';} ?>">
              <a href="<?php echo site_url('laporan_keluar');?>"> Laporan Pengeluaran</a>
            </li>
             <li class="<?php if ($this->uri->segment('1') == 'laporan_retur_masuk') {echo 'active';} ?>">
              <a href="<?php echo site_url('laporan_retur_masuk');?>"> Laporan Penerimaan Retur</a>
            </li>
             <li class="<?php if ($this->uri->segment('1') == 'laporan_retur_keluar') {echo 'active';} ?>">
              <a href="<?php echo site_url('laporan_retur_keluar');?>"> Laporan Pengeluaran Retur</a>
            </li>
             <li class="<?php if ($this->uri->segment('1') == 'laporan_mutasi') {echo 'active';} ?>">
              <a href="<?php echo site_url('laporan_mutasi');?>"> Laporan Mutasi</a>
            </li>
          </ul>
        </li>
        <!-- end laporan treeview -->

        <!-- pesan treeview -->
        <!-- tentukan attribute active class -->
        <li class="
           <?php if ($this->uri->segment('1') == 'pesan') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'inbox') {
              echo 'active treeview';
            } ?>">

          <a href="#">
            <i class="fa fa-envelope"></i>
            <span>pesan</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <!-- tentukan attribute active class -->
          <ul class="treeview-menu">
            <li class="<?php if ($this->uri->segment('1') == 'pesan') {echo 'active';} ;?>">
              <a href="<?php echo site_url('pesan');?>"> Tulis Pesan</a>
            </li>
            <li class="<?php if ($this->uri->segment('1') == 'inbox') {echo 'active';} ;?>">
              <a href="<?php echo site_url('inbox');?>"> Pesan Masuk</a>
            </li>
          </ul>
        </li>
        <!-- end pesan treeview -->
      </ul>   
          <?php break; ?>    

      <?php case '4': ?>
      <ul class="sidebar-menu">
        <!-- dashboard -->
        <li class="<?php if ($this->uri->segment('1') == 'home') {echo 'active';} ?>">
          <a href="<?php echo site_url('home');?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <!-- end dashboard -->

        <!-- master treeview -->
        <!-- tentukan attribute active class -->
        <li class="
          <?php if ($this->uri->segment('1') == 'supplier') {
              echo 'active treeview';
            } ?>">

          <a href="#">
            <i class="fa fa-database"></i>
            <span>Data Master</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <!-- tentukan attribute active class -->
          <ul class="treeview-menu"> 
            <li class="<?php if ($this->uri->segment('1') == 'supplier') {echo 'active';} ?>">
              <a href="<?php echo site_url('supplier');?>"><i class="fa fa-phone"></i> Master Supplier</a>
            </li>
          </ul>
        </li>
        <!-- end master treeview -->

        <!-- transaksi treeview -->
        <!-- tentukan attribute active class -->
        <li class="
           <?php if ($this->uri->segment('1') == 'trans_beli') {
              echo 'active treeview';
            }?>">

          <a href="#">
            <i class="fa fa-exchange"></i>
            <span>Data Transaksi</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <!-- tentukan attribute active class -->
          <ul class="treeview-menu">
            <li class="<?php if ($this->uri->segment('1') == 'trans_beli') {echo 'active';} ?>">
              <a href="<?php echo site_url('trans_beli');?>"><i class="fa fa-long-arrow-left"></i> Pembelian Barang</a>
            </li>
          </ul>
        </li>
        <!-- end transaksi treeview -->
    
        <!-- laporan treeview -->
        <!-- tentukan attribute active class -->
        <li class="
           <?php if ($this->uri->segment('1') == 'laporan_beli') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'laporan_history_beli') {
              echo 'active treeview';
            } ?>">

          <a href="#">
            <i class="fa fa-bar-chart-o"></i>
            <span>Laporan</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <!-- tentukan attribute active class -->
          <ul class="treeview-menu">
            <li class="<?php if ($this->uri->segment('1') == 'laporan_beli') {echo 'active';} ?>">
              <a href="<?php echo site_url('laporan_beli');?>"> Laporan Pembelian</a>
            </li>
             <li class="<?php if ($this->uri->segment('1') == 'laporan_history_beli') {echo 'active';} ?>">
              <a href="<?php echo site_url('laporan_history_beli');?>"> Laporan Riwayat Pembelian</a>
            </li>
          </ul>
        </li>
        <!-- end laporan treeview -->

        <!-- pesan treeview -->
        <!-- tentukan attribute active class -->
        <li class="
           <?php if ($this->uri->segment('1') == 'pesan') {
              echo 'active treeview';
            }elseif ($this->uri->segment('1') == 'inbox') {
              echo 'active treeview';
            } ?>">

          <a href="#">
            <i class="fa fa-envelope"></i>
            <span>pesan</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <!-- tentukan attribute active class -->
          <ul class="treeview-menu">
            <li class="<?php if ($this->uri->segment('1') == 'pesan') {echo 'active';} ;?>">
              <a href="<?php echo site_url('pesan');?>"> Tulis Pesan</a>
            </li>
            <li class="<?php if ($this->uri->segment('1') == 'inbox') {echo 'active';} ;?>">
              <a href="<?php echo site_url('inbox');?>"> Pesan Masuk</a>
            </li>
          </ul>
        </li>
        <!-- end pesan treeview -->
      </ul>   
          <?php break; ?>

      <?php default: ?>
      <ul class="sidebar-menu">
        <!-- dashboard -->
        <li class="<?php if ($this->uri->segment('1') == 'home') {echo 'active';} ?>">
          <a href="<?php echo site_url('home');?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <!-- end dashboard -->
      </ul>    
       <?php break;
      } ?>
      <!-- end switch case -->
     
    </section>
    <!-- /.sidebar -->
</aside>