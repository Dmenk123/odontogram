<style>
  .odonto-modal {
    max-width: 90%;
  }
  polyline {
    z-index: 999;
  }
</style>
<div class="modal fade modal_detail" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="div_odonto_modal">
  <div class="modal-dialog modal-lg odonto-modal" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="div_odonto_modal_title">Odontogram</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <div>
            <ul class="nav nav-tabs" role="tablist" id="tab">
                <li class="nav-item" >
                    <a class="nav-link active" href="javascript: void(0);" data-toggle="tab" data-target="#all" role="tab">Odonto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript: void(0);" style="background-color: #eaeaea;" data-toggle="tab" data-target="#otorisasi" role="tab">Formulir</a>
                </li>
            </ul>
            <div class="tab-content padding-vertical-20">
                <div class="tab-pane active" id="all" role="tabpanel">
                    <div class="row" align="center"  style="flex-wrap:wrap; justify-content:center;">
                    <?php 
                      for ($x = 1; $x <= 16; $x++) { 
                        if($x == 8){
                          $lebar = 90;
                        }else{
                          $lebar = 60;
                        }
                    ?>
                      <svg height="125" width="<?=$lebar;?>" >
                        <polyline id="barispertamaoutline<?=$x;?>" points="2,22 57,22 57,77 2,77 2,22" style="fill:white;stroke:black;stroke-width:3; display:none"  />
                        <?php if ($x <= 5 || $x >= 12) { ?>
                          <polyline id="barispertamakiri<?=$x;?>" points="4,24 4,75 15,63 15,35 4,24" style="fill:white;stroke:black;stroke-width:1" /> 
                          <polyline id="barispertamaatas<?=$x;?>" points="4,24 55,24 43,35 15,35 4,24" style="fill:white;stroke:black;stroke-width:1" />
                          <polyline id="barispertamakanan<?=$x;?>" points="55,24 55,75 43,63 43,35 55,24" style="fill:white;stroke:black;stroke-width:1" />
                          <polyline id="barispertamabawah<?=$x;?>" points="55,75 4,75 15,63 43,63 55,75" style="fill:white;stroke:black;stroke-width:1" />
                          <polyline id="barispertamatengah<?=$x;?>" points="15,35 43,35 43,63 15,63 15,35" style="fill:white;stroke:black;stroke-width:1" />
                        <?php }else{ ?>
                          <polyline id="barispertamakiri<?=$x;?>" points="4,24 4,75 15,50 4,24" style="fill:white;stroke:black;stroke-width:1" />
                          <polyline id="barispertamaatas<?=$x;?>" points="4,24 55,24 43,50 15,50 4,24" style="fill:white;stroke:black;stroke-width:1" />
                          <polyline points="55,24 55,75 43,50 55,24" style="fill:white;stroke:black;stroke-width:1" />
                          <polyline points="55,75 4,75 15,50 43,50 55,75" style="fill:white;stroke:black;stroke-width:1" />
                        <?php } ?>
                        <line id="barispertamasilang1<?=$x;?>" x1="4" y1="24" x2="55" y2="76" stroke="red" stroke-width="3" style="display:none;"/>
                        <line id="barispertamasilang2<?=$x;?>" x1="55" y1="24" x2="4" y2="76" stroke="red" stroke-width="3" style="display:none;"/>
                        <polyline id="barispertamasegitiga<?=$x;?>" points="13,80 45,80 29,103 13,80" style="fill:black;stroke:black;stroke-width:1;display:none;" />
                        <polyline id="barispertamapanahkanan<?=$x;?>" points="45,5 45,10 50,5 45,1 45,5 15,5" style="fill:black;stroke:black;stroke-width:1;display:none" />
                        <text x="21" y="123" font-family="Verdana" font-size="13" fill="black" >21</text>
                        <text x="17" y="20" id="barispertamapre<?=$x;?>" font-family="Verdana" font-size="13" fill="blue" align="center" style="display:none;">PRE</text>
                        <text x="17" y="20" id="barispertamaano<?=$x;?>" font-family="Verdana" font-size="13" fill="green" align="center" style="display:none;">ANO</text>
                        <text x="17" y="20" id="barispertamaune<?=$x;?>" font-family="Verdana" font-size="13" fill="#000080" align="center" style="display:none;">UNE</text>
                      </svg>
                    <?php } ?>
                  </div>
                  <div class="row" style="padding-top:20px;">
                    <div class="col-sm-3">
                      <div >
                        <input type="hidden" id="pilihanwarna" value="">
                      </div>
                      <div class="row">
                        <div class="col-sm-4" style="padding-left:80px;">
                          <span><img src="<?php echo base_url('assets/images/pre.png');?>" width="30px;" height="15px;"></span>
                        </div>
                        <div  class="col-sm-8">
                          <button class="button split btn-default pull-right" style="width: 150px;" id="pre">Erupsi Sebagian</button>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-4" style="padding-left:80px;">
                          <span><img src="<?php echo base_url('assets/images/ano.png');?>" width="30px;" height="15px;"></span>
                        </div>
                        <div  class="col-sm-8">
                          <button class="button split btn-default pull-right" style="width: 150px;" id="ano">Anomali Bentuk</button>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-4" style="padding-left:80px;">
                          <span><img src="<?php echo base_url('assets/images/une.png');?>" width="30px;" height="15px;"></span>
                        </div>
                        <div  class="col-sm-8">
                          <button class="button split btn-default pull-right" style="width: 150px;" id="une">Belum Erupsi</button>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-4" style="padding-left:80px;">
                          <span><img src="<?php echo base_url('assets/images/caries.png');?>" width="20px;" height="20px;"></span>
                        </div>
                        <div  class="col-sm-8">
                          <button class="button split btn-default pull-right" style="width: 150px;" id="border">Caries</button>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-4" style="padding-left:80px;">
                          <span><img src="<?php echo base_url('assets/images/non_vital.png');?>" width="20px;" height="20px;"></span>
                        </div>
                        <div  class="col-sm-8">
                          <button class="button split btn-default pull-right" style="width: 150px;" id="non_vital">Gigi Non Vital</button>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="row">
                        <div class="col-sm-4" style="padding-left:80px;">
                          <span></span>
                        </div>
                        <div  class="col-sm-8">
                          <button class="button split btn-default pull-right" style="width: 155px;" >Fractured</button>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-4" style="padding-left:80px;">
                          <span><img src="<?php echo base_url('assets/images/mahkota_logam.png');?>" width="20px;" height="20px;"></span>
                        </div>
                        <div  class="col-sm-8">
                          <button class="button split btn-default pull-right" style="width: 155px;" id="outline">Mahkota Logam</button>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-4" style="padding-left:80px;">
                          <span><img src="<?php echo base_url('assets/images/non_logam.png');?>" width="20px;" height="20px;"></span>
                        </div>
                        <div  class="col-sm-8">
                          <button class="button split btn-default pull-right" style="width: 155px;" id="cyann">Mahkota Non Logam</button>
                        </div>
                      </div>
                      <button class="button split btn-default" id="panah_kanan">panah kanan</button>
                    </div>
                    <div class="col-sm-3">
                      <div class="row">
                        <div class="col-sm-4" style="padding-left:80px;">
                          <span><img src="<?php echo base_url('assets/images/old_brown.png');?>" width="20px;" height="20px;"></span>
                        </div>
                        <div  class="col-sm-8">
                          <button class="button split btn-default pull-right" style="width: 155px;" id="old_brown">Tambalan Logam</button>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-4" style="padding-left:80px;">
                          <span><img src="<?php echo base_url('assets/images/green.png');?>" width="20px;" height="20px;"></span>
                        </div>
                        <div  class="col-sm-8">
                          <button class="button split btn-default pull-right" style="width: 155px;" id="green">Tambalan Sewarna</button>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-4" style="padding-left:80px;">
                          <span><img src="<?php echo base_url('assets/images/red.png');?>" width="20px;" height="20px;"></span>
                        </div>
                        <div  class="col-sm-8">
                          <button class="button split btn-default pull-right" style="width: 155px;" id="red">Tambalan Emas</button>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-4" style="padding-left:80px;">
                          <span><img src="<?php echo base_url('assets/images/pink.png');?>" width="20px;" height="20px;"></span>
                        </div>
                        <div  class="col-sm-8">
                          <button class="button split btn-default pull-right" style="width: 155px;" id="pink">Tambalan Pencegah</button>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="row">
                        <div class="col-sm-4" style="padding-left:80px;">
                          <span><img src="<?php echo base_url('assets/images/segitiga.png');?>" width="20px;" height="20px;"></span>
                        </div>
                        <div  class="col-sm-8">
                          <button class="button split btn-default pull-right" style="width: 165px;" id="segitiga">Perawatan Sal. Akar</button>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-4" style="padding-left:80px;">
                          <span><img src="<?php echo base_url('assets/images/biru_muda.png');?>" width="20px;" height="20px;"></span>
                        </div>
                        <div  class="col-sm-8">
                          <button class="button split btn-default pull-right" style="width: 165px;" id="biru_muda">Tambalan Non Logam</button>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-4" style="padding-left:80px;">
                          <span><img src="<?php echo base_url('assets/images/sea.png');?>" width="20px;" height="20px;"></span>
                        </div>
                        <div  class="col-sm-8">
                          <button class="button split btn-default pull-right" style="width: 165px;" id="akar">Sisa Akar</button>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-4" style="padding-left:80px;">
                          <span><img src="<?php echo base_url('assets/images/silang2.png');?>" width="20px;" height="20px;"></span>
                        </div>
                        <div  class="col-sm-8">
                          <button class="button split btn-default pull-right" style="width: 165px;" id="silang">Gigi Hilang</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="otorisasi" role="tabpanel">
                  text
                </div>
            </div>
        </div>
              
      
      </div>
     
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>