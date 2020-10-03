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
                    <text x="21" y="123" font-family="Verdana" font-size="13" fill="black" >21</text>
                     <text x="17" y="15" id="barispertamapre<?=$x;?>" font-family="Verdana" font-size="13" fill="blue" align="center" style="display:none;">PRE</text>
                  </svg>
                <?php } ?>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <input type="text" id="pilihanwarna" value="">
                </div>
                <button class="button split btn-default" id="red">Tambalan Emas </button>
                <button class="button split btn-default" id="green">Tambalan Sewarna</button>
                <button class="button split btn-default" id="outline">Tambalan Sewarna</button>
                <button class="button split btn-default" id="pre">Tambalan Sewarna</button>
                <button class="button split btn-default" id="silang">Silang</button>
              </div>
      
      </div>
     
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>