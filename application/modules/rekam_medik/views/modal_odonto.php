<style>
  .odonto-modal {
    max-width: 90%;
  }
  polyline {
    z-index: 999;
  }
  .main-border{
      border:2px solid;
      position:relative;
      width:300px;
      height:50px;
      top:10px;

  }
  .sub{
      
      position:absolute;
      right:10px;
      top:-10px;
      z-index:99;
      background-color: #fff;
  }
  .st0{fill:#FFFFFF;stroke:#000000;stroke-miterlimit:10;}
	.st1{stroke:#000000;stroke-miterlimit:10;}
  .canvas{z-index:-9999;}

  #imagesave {
  /* background-color: red; */
  /* height: 550px;
  width: auto; */
}

fieldset {
  border:1px solid gray;
}
fieldSet
  {
      width: 100%; 
      margin-left: 10px;
      border:1px solid grey;
      margin: 2px;
      padding-left: 5px;
      padding-bottom: 3px;
  }

  legend
  {

      border-style:none;
      background-color: #003366;
      font-family: Tahoma, Arial, Helvetica;
      font-weight: bold;
      font-size: 9.5pt;
      Color: White;
      /* width:30%; */
      padding-left:10px;

  }

    fieldset div { border:1px solid #003366; position:relative; top:-6px }
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
                <div id="imagesave">
                  <!-- <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br> -->
                  <div class="row" align="center"  style="flex-wrap:wrap; justify-content:center;">
                    <?php 
                      $angka = array(
                                '1' => '18',
                                '2' => '17',
                                '3' => '16',
                                '4' => '15',
                                '5' => '14',
                                '6' => '13',
                                '7' => '12',
                                '8' => '11',
                                '9' => '21',
                                '10' => '22',
                                '11' => '23',
                                '12' => '24',
                                '13' => '25',
                                '14' => '26',
                                '15' => '27',
                                '16' => '28',
                      );
                      
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
                          <polyline id="barispertamakanan<?=$x;?>" points="55,24 55,75 43,50 55,24" style="fill:white;stroke:black;stroke-width:1" />
                          <polyline id="barispertamabawah<?=$x;?>" points="55,75 4,75 15,50 43,50 55,75" style="fill:white;stroke:black;stroke-width:1" />
                        <?php } ?>
                        <line id="barispertamasilang1<?=$x;?>" x1="4" y1="24" x2="55" y2="76" stroke="red" stroke-width="3" style="display:none;"/>
                        <line id="barispertamasilang2<?=$x;?>" x1="55" y1="24" x2="4" y2="76" stroke="red" stroke-width="3" style="display:none;"/>
                        <line id="barispertamaakar1<?=$x;?>" x1="4" y1="24" x2="28.5" y2="75" style="stroke:blue;stroke-width:2;display:none;" />
                        <line id="barispertamaakar2<?=$x;?>" x1="55" y1="24" x2="28.5" y2="75" style="stroke:blue;stroke-width:2;display:none;" />
                        <line id="barispertamacrash1<?=$x;?>" x1="27" y1="30" x2="20" y2="68" style="stroke:blue;stroke-width:2;display:none;" />
                        <line id="barispertamacrash2<?=$x;?>" x1="37" y1="30" x2="30" y2="68" style="stroke:blue;stroke-width:2;display:none;" />
                        <line id="barispertamacrash3<?=$x;?>" x1="12" y1="45" x2="47" y2="45" style="stroke:blue;stroke-width:2;display:none;" />
                        <line id="barispertamacrash4<?=$x;?>" x1="12" y1="55" x2="47" y2="55" style="stroke:blue;stroke-width:2;display:none;" />
                        <line id="barispertamajembtegak<?=$x;?>" x1="28.5" y1="24" x2="28.5" y2="15" style="stroke:black;stroke-width:2;display:none;" />
                        <line id="barispertamajembkanan<?=$x;?>" x1="28.5" y1="15" x2="60" y2="15" style="stroke:black;stroke-width:2;display:none;" />
                        <line id="barispertamajembkiri<?=$x;?>" x1="28.5" y1="15" x2="0" y2="15" style="stroke:black;stroke-width:2;display:none;" />
                        <line id="barispertamajembtengah<?=$x;?>" x1="0" y1="15" x2="60" y2="15" style="stroke:black;stroke-width:2;display:none;" />
                        <polyline id="barispertamasegitiga<?=$x;?>" points="13,80 45,80 29,103 13,80" style="fill:black;stroke:black;stroke-width:1;display:none;" />
                        <polyline id="barispertamapanahkiri<?=$x;?>" points="13,5 13,10 8,5 13,1 13,5 43,5" style="fill:black;stroke:black;stroke-width:1;display:none" />
                        <polyline id="barispertamapanahkanan<?=$x;?>" points="45,5 45,10 50,5 45,1 45,5 15,5" style="fill:black;stroke:black;stroke-width:1;display:none" />
                        <polyline id="barispertamalengkungatas1<?=$x;?>" class="st0" points="16,15 11,14 10,13 8,9 9,8 10,6 12,5 14,3 16,3 20,2 25,1 28,1 33,2 36,3" style="display:none;"  />
                        <polyline id="barispertamalengkungatas2<?=$x;?>" points="36,3 35,8 42,5 37,1" style="fill:black;stroke:black;stroke-width:1;display:none;"  />
                        <polyline id="barispertamalengkungbawah1<?=$x;?>" class="st0" points="16,93 11,95 10,97 8,99 9,103 10,104 12,105 14,107 16,107 20,108 25,109 30,109 33,108 36,107" style="display:none;"  />
                        <polyline id="barispertamalengkungbawah2<?=$x;?>"  points="36,107 38,112 40,105 32,102 36,107" style="fill:black;stroke:black;stroke-width:1;display:none;"  /> 
                        <text x="21" y="123" font-family="Verdana" font-size="13" fill="black" ><?php echo $angka[$x];?></text>
                        <text x="17" y="20" id="barispertamapre<?=$x;?>" font-family="Verdana" font-size="13" fill="blue" align="center" style="display:none;">PRE</text>
                        <text x="17" y="20" id="barispertamaano<?=$x;?>" font-family="Verdana" font-size="13" fill="green" align="center" style="display:none;">ANO</text>
                        <text x="17" y="20" id="barispertamaune<?=$x;?>" font-family="Verdana" font-size="13" fill="navy" align="center" style="display:none;">UNE</text>
                      </svg>
                    <?php } ?>
                  </div>
                  <!-- baris kedua -->
                  <div class="row" align="center"  style="flex-wrap:wrap; justify-content:center;margin-top:5px;">
                    <?php 
                      $angka = array(
                                '1' => '55',
                                '2' => '54',
                                '3' => '53',
                                '4' => '52',
                                '5' => '51',
                                '6' => '61',
                                '7' => '62',
                                '8' => '63',
                                '9' => '64',
                                '10' => '65',
                      );
                      
                      for ($x = 1; $x <= 10; $x++) { 
                        if($x == 5){
                          $lebar = 90;
                        }else{
                          $lebar = 60;
                        }
                    ?>
                      <svg height="125" width="<?=$lebar;?>" >
                        <polyline id="bariskeduaoutline<?=$x;?>" points="2,22 57,22 57,77 2,77 2,22" style="fill:white;stroke:black;stroke-width:3; display:none"  />
                        <?php if ($x <= 2 || $x >= 9) { ?>
                          <polyline id="bariskeduakiri<?=$x;?>" points="4,24 4,75 15,63 15,35 4,24" style="fill:white;stroke:black;stroke-width:1" /> 
                          <polyline id="bariskeduaatas<?=$x;?>" points="4,24 55,24 43,35 15,35 4,24" style="fill:white;stroke:black;stroke-width:1" />
                          <polyline id="bariskeduakanan<?=$x;?>" points="55,24 55,75 43,63 43,35 55,24" style="fill:white;stroke:black;stroke-width:1" />
                          <polyline id="bariskeduabawah<?=$x;?>" points="55,75 4,75 15,63 43,63 55,75" style="fill:white;stroke:black;stroke-width:1" />
                          <polyline id="bariskeduatengah<?=$x;?>" points="15,35 43,35 43,63 15,63 15,35" style="fill:white;stroke:black;stroke-width:1" />
                        <?php }else{ ?>
                          <polyline id="bariskeduakiri<?=$x;?>" points="4,24 4,75 15,50 4,24" style="fill:white;stroke:black;stroke-width:1" />
                          <polyline id="bariskeduaatas<?=$x;?>" points="4,24 55,24 43,50 15,50 4,24" style="fill:white;stroke:black;stroke-width:1" />
                          <polyline id="bariskeduakanan<?=$x;?>" points="55,24 55,75 43,50 55,24" style="fill:white;stroke:black;stroke-width:1" />
                          <polyline id="bariskeduabawah<?=$x;?>" points="55,75 4,75 15,50 43,50 55,75" style="fill:white;stroke:black;stroke-width:1" />
                        <?php } ?>
                        <line id="bariskeduasilang1<?=$x;?>" x1="4" y1="24" x2="55" y2="76" stroke="red" stroke-width="3" style="display:none;"/>
                        <line id="bariskeduasilang2<?=$x;?>" x1="55" y1="24" x2="4" y2="76" stroke="red" stroke-width="3" style="display:none;"/>
                        <line id="bariskeduaakar1<?=$x;?>" x1="4" y1="24" x2="28.5" y2="75" style="stroke:blue;stroke-width:2;display:none;" />
                        <line id="bariskeduaakar2<?=$x;?>" x1="55" y1="24" x2="28.5" y2="75" style="stroke:blue;stroke-width:2;display:none;" />
                        <line id="bariskeduacrash1<?=$x;?>" x1="27" y1="30" x2="20" y2="68" style="stroke:blue;stroke-width:2;display:none;" />
                        <line id="bariskeduacrash2<?=$x;?>" x1="37" y1="30" x2="30" y2="68" style="stroke:blue;stroke-width:2;display:none;" />
                        <line id="bariskeduacrash3<?=$x;?>" x1="12" y1="45" x2="47" y2="45" style="stroke:blue;stroke-width:2;display:none;" />
                        <line id="bariskeduacrash4<?=$x;?>" x1="12" y1="55" x2="47" y2="55" style="stroke:blue;stroke-width:2;display:none;" />
                        <line id="bariskeduajembtegak<?=$x;?>" x1="28.5" y1="24" x2="28.5" y2="15" style="stroke:black;stroke-width:2;display:none;" />
                        <line id="bariskeduajembkanan<?=$x;?>" x1="28.5" y1="15" x2="60" y2="15" style="stroke:black;stroke-width:2;display:none;" />
                        <line id="bariskeduajembkiri<?=$x;?>" x1="28.5" y1="15" x2="0" y2="15" style="stroke:black;stroke-width:2;display:none;" />
                        <line id="bariskeduajembtengah<?=$x;?>" x1="0" y1="15" x2="60" y2="15" style="stroke:black;stroke-width:2;display:none;" />
                        <polyline id="bariskeduasegitiga<?=$x;?>" points="13,80 45,80 29,103 13,80" style="fill:black;stroke:black;stroke-width:1;display:none;" />
                        <polyline id="bariskeduapanahkiri<?=$x;?>" points="13,5 13,10 8,5 13,1 13,5 43,5" style="fill:black;stroke:black;stroke-width:1;display:none" />
                        <polyline id="bariskeduapanahkanan<?=$x;?>" points="45,5 45,10 50,5 45,1 45,5 15,5" style="fill:black;stroke:black;stroke-width:1;display:none" />
                        <polyline id="bariskedualengkungatas1<?=$x;?>" class="st0" points="16,15 11,14 10,13 8,9 9,8 10,6 12,5 14,3 16,3 20,2 25,1 28,1 33,2 36,3" style="display:none;"  />
                        <polyline id="bariskedualengkungatas2<?=$x;?>" points="36,3 35,8 42,5 37,1" style="fill:black;stroke:black;stroke-width:1;display:none;"  />
                        <polyline id="bariskedualengkungbawah1<?=$x;?>" class="st0" points="16,93 11,95 10,97 8,99 9,103 10,104 12,105 14,107 16,107 20,108 25,109 30,109 33,108 36,107" style="display:none;"  />
                        <polyline id="bariskedualengkungbawah2<?=$x;?>"  points="36,107 38,112 40,105 32,102 36,107" style="fill:black;stroke:black;stroke-width:1;display:none;"  /> 
                        <text x="21" y="123" font-family="Verdana" font-size="13" fill="black" ><?php echo $angka[$x];?></text>
                        <text x="17" y="20" id="bariskeduapre<?=$x;?>" font-family="Verdana" font-size="13" fill="blue" align="center" style="display:none;">PRE</text>
                        <text x="17" y="20" id="bariskeduaano<?=$x;?>" font-family="Verdana" font-size="13" fill="green" align="center" style="display:none;">ANO</text>
                        <text x="17" y="20" id="bariskeduaune<?=$x;?>" font-family="Verdana" font-size="13" fill="navy" align="center" style="display:none;">UNE</text>
                      </svg>
                    <?php } ?>
                  </div>

                   <!-- baris ketiga -->
                   <div class="row" align="center"  style="flex-wrap:wrap; justify-content:center;margin-top:5px;">
                    <?php 
                      $angka = array(
                                '1' => '85',
                                '2' => '84',
                                '3' => '83',
                                '4' => '82',
                                '5' => '81',
                                '6' => '71',
                                '7' => '72',
                                '8' => '73',
                                '9' => '74',
                                '10' => '75',
                      );
                      
                      for ($x = 1; $x <= 10; $x++) { 
                        if($x == 5){
                          $lebar = 90;
                        }else{
                          $lebar = 60;
                        }
                    ?>
                      <svg height="125" width="<?=$lebar;?>" >
                        <polyline id="barisketigaoutline<?=$x;?>" points="2,22 57,22 57,77 2,77 2,22" style="fill:white;stroke:black;stroke-width:3; display:none"  />
                        <?php if ($x <= 2 || $x >= 9) { ?>
                          <polyline id="barisketigakiri<?=$x;?>" points="4,24 4,75 15,63 15,35 4,24" style="fill:white;stroke:black;stroke-width:1" /> 
                          <polyline id="barisketigaatas<?=$x;?>" points="4,24 55,24 43,35 15,35 4,24" style="fill:white;stroke:black;stroke-width:1" />
                          <polyline id="barisketigakanan<?=$x;?>" points="55,24 55,75 43,63 43,35 55,24" style="fill:white;stroke:black;stroke-width:1" />
                          <polyline id="barisketigabawah<?=$x;?>" points="55,75 4,75 15,63 43,63 55,75" style="fill:white;stroke:black;stroke-width:1" />
                          <polyline id="barisketigatengah<?=$x;?>" points="15,35 43,35 43,63 15,63 15,35" style="fill:white;stroke:black;stroke-width:1" />
                        <?php }else{ ?>
                          <polyline id="barisketigakiri<?=$x;?>" points="4,24 4,75 15,50 4,24" style="fill:white;stroke:black;stroke-width:1" />
                          <polyline id="barisketigaatas<?=$x;?>" points="4,24 55,24 43,50 15,50 4,24" style="fill:white;stroke:black;stroke-width:1" />
                          <polyline id="barisketigakanan<?=$x;?>" points="55,24 55,75 43,50 55,24" style="fill:white;stroke:black;stroke-width:1" />
                          <polyline id="barisketigabawah<?=$x;?>" points="55,75 4,75 15,50 43,50 55,75" style="fill:white;stroke:black;stroke-width:1" />
                        <?php } ?>
                        <line id="barisketigasilang1<?=$x;?>" x1="4" y1="24" x2="55" y2="76" stroke="red" stroke-width="3" style="display:none;"/>
                        <line id="barisketigasilang2<?=$x;?>" x1="55" y1="24" x2="4" y2="76" stroke="red" stroke-width="3" style="display:none;"/>
                        <line id="barisketigaakar1<?=$x;?>" x1="4" y1="24" x2="28.5" y2="75" style="stroke:blue;stroke-width:2;display:none;" />
                        <line id="barisketigaakar2<?=$x;?>" x1="55" y1="24" x2="28.5" y2="75" style="stroke:blue;stroke-width:2;display:none;" />
                        <line id="barisketigacrash1<?=$x;?>" x1="27" y1="30" x2="20" y2="68" style="stroke:blue;stroke-width:2;display:none;" />
                        <line id="barisketigacrash2<?=$x;?>" x1="37" y1="30" x2="30" y2="68" style="stroke:blue;stroke-width:2;display:none;" />
                        <line id="barisketigacrash3<?=$x;?>" x1="12" y1="45" x2="47" y2="45" style="stroke:blue;stroke-width:2;display:none;" />
                        <line id="barisketigacrash4<?=$x;?>" x1="12" y1="55" x2="47" y2="55" style="stroke:blue;stroke-width:2;display:none;" />
                        <line id="barisketigajembtegak<?=$x;?>" x1="28.5" y1="24" x2="28.5" y2="15" style="stroke:black;stroke-width:2;display:none;" />
                        <line id="barisketigajembkanan<?=$x;?>" x1="28.5" y1="15" x2="60" y2="15" style="stroke:black;stroke-width:2;display:none;" />
                        <line id="barisketigajembkiri<?=$x;?>" x1="28.5" y1="15" x2="0" y2="15" style="stroke:black;stroke-width:2;display:none;" />
                        <line id="barisketigajembtengah<?=$x;?>" x1="0" y1="15" x2="60" y2="15" style="stroke:black;stroke-width:2;display:none;" />
                        <polyline id="barisketigasegitiga<?=$x;?>" points="13,80 45,80 29,103 13,80" style="fill:black;stroke:black;stroke-width:1;display:none;" />
                        <polyline id="barisketigapanahkiri<?=$x;?>" points="13,5 13,10 8,5 13,1 13,5 43,5" style="fill:black;stroke:black;stroke-width:1;display:none" />
                        <polyline id="barisketigapanahkanan<?=$x;?>" points="45,5 45,10 50,5 45,1 45,5 15,5" style="fill:black;stroke:black;stroke-width:1;display:none" />
                        <polyline id="barisketigalengkungatas1<?=$x;?>" class="st0" points="16,15 11,14 10,13 8,9 9,8 10,6 12,5 14,3 16,3 20,2 25,1 28,1 33,2 36,3" style="display:none;"  />
                        <polyline id="barisketigalengkungatas2<?=$x;?>" points="36,3 35,8 42,5 37,1" style="fill:black;stroke:black;stroke-width:1;display:none;"  />
                        <polyline id="barisketigalengkungbawah1<?=$x;?>" class="st0" points="16,93 11,95 10,97 8,99 9,103 10,104 12,105 14,107 16,107 20,108 25,109 30,109 33,108 36,107" style="display:none;"  />
                        <polyline id="barisketigalengkungbawah2<?=$x;?>"  points="36,107 38,112 40,105 32,102 36,107" style="fill:black;stroke:black;stroke-width:1;display:none;"  /> 
                        <text x="21" y="123" font-family="Verdana" font-size="13" fill="black" ><?php echo $angka[$x];?></text>
                        <text x="17" y="20" id="barisketigapre<?=$x;?>" font-family="Verdana" font-size="13" fill="blue" align="center" style="display:none;">PRE</text>
                        <text x="17" y="20" id="barisketigaano<?=$x;?>" font-family="Verdana" font-size="13" fill="green" align="center" style="display:none;">ANO</text>
                        <text x="17" y="20" id="barisketigaune<?=$x;?>" font-family="Verdana" font-size="13" fill="navy" align="center" style="display:none;">UNE</text>
                      </svg>
                    <?php } ?>
                  </div>
                  <!-- baris keempat -->
                  <div class="row" align="center"  style="flex-wrap:wrap; justify-content:center;margin-top:5px;margin-bottom:20px;">
                    <?php 
                      $angka = array(
                                '1' => '48',
                                '2' => '47',
                                '3' => '46',
                                '4' => '45',
                                '5' => '44',
                                '6' => '43',
                                '7' => '42',
                                '8' => '41',
                                '9' => '31',
                                '10' => '32',
                                '11' => '33',
                                '12' => '34',
                                '13' => '35',
                                '14' => '36',
                                '15' => '37',
                                '16' => '38',
                      );
                      
                      for ($x = 1; $x <= 16; $x++) { 
                        if($x == 8){
                          $lebar = 90;
                        }else{
                          $lebar = 60;
                        }
                    ?>
                      <svg height="125" width="<?=$lebar;?>" >
                        <polyline id="bariskeempatoutline<?=$x;?>" points="2,22 57,22 57,77 2,77 2,22" style="fill:white;stroke:black;stroke-width:3; display:none"  />
                        <?php if ($x <= 5 || $x >= 12) { ?>
                          <polyline id="bariskeempatkiri<?=$x;?>" points="4,24 4,75 15,63 15,35 4,24" style="fill:white;stroke:black;stroke-width:1" /> 
                          <polyline id="bariskeempatatas<?=$x;?>" points="4,24 55,24 43,35 15,35 4,24" style="fill:white;stroke:black;stroke-width:1" />
                          <polyline id="bariskeempatkanan<?=$x;?>" points="55,24 55,75 43,63 43,35 55,24" style="fill:white;stroke:black;stroke-width:1" />
                          <polyline id="bariskeempatbawah<?=$x;?>" points="55,75 4,75 15,63 43,63 55,75" style="fill:white;stroke:black;stroke-width:1" />
                          <polyline id="bariskeempattengah<?=$x;?>" points="15,35 43,35 43,63 15,63 15,35" style="fill:white;stroke:black;stroke-width:1" />
                        <?php }else{ ?>
                          <polyline id="bariskeempatkiri<?=$x;?>" points="4,24 4,75 15,50 4,24" style="fill:white;stroke:black;stroke-width:1" />
                          <polyline id="bariskeempatatas<?=$x;?>" points="4,24 55,24 43,50 15,50 4,24" style="fill:white;stroke:black;stroke-width:1" />
                          <polyline id="bariskeempatkanan<?=$x;?>" points="55,24 55,75 43,50 55,24" style="fill:white;stroke:black;stroke-width:1" />
                          <polyline id="bariskeempatbawah<?=$x;?>" points="55,75 4,75 15,50 43,50 55,75" style="fill:white;stroke:black;stroke-width:1" />
                        <?php } ?>
                        <line id="bariskeempatsilang1<?=$x;?>" x1="4" y1="24" x2="55" y2="76" stroke="red" stroke-width="3" style="display:none;"/>
                        <line id="bariskeempatsilang2<?=$x;?>" x1="55" y1="24" x2="4" y2="76" stroke="red" stroke-width="3" style="display:none;"/>
                        <line id="bariskeempatakar1<?=$x;?>" x1="4" y1="24" x2="28.5" y2="75" style="stroke:blue;stroke-width:2;display:none;" />
                        <line id="bariskeempatakar2<?=$x;?>" x1="55" y1="24" x2="28.5" y2="75" style="stroke:blue;stroke-width:2;display:none;" />
                        <line id="bariskeempatcrash1<?=$x;?>" x1="27" y1="30" x2="20" y2="68" style="stroke:blue;stroke-width:2;display:none;" />
                        <line id="bariskeempatcrash2<?=$x;?>" x1="37" y1="30" x2="30" y2="68" style="stroke:blue;stroke-width:2;display:none;" />
                        <line id="bariskeempatcrash3<?=$x;?>" x1="12" y1="45" x2="47" y2="45" style="stroke:blue;stroke-width:2;display:none;" />
                        <line id="bariskeempatcrash4<?=$x;?>" x1="12" y1="55" x2="47" y2="55" style="stroke:blue;stroke-width:2;display:none;" />
                        <line id="bariskeempatjembtegak<?=$x;?>" x1="28.5" y1="24" x2="28.5" y2="15" style="stroke:black;stroke-width:2;display:none;" />
                        <line id="bariskeempatjembkanan<?=$x;?>" x1="28.5" y1="15" x2="60" y2="15" style="stroke:black;stroke-width:2;display:none;" />
                        <line id="bariskeempatjembkiri<?=$x;?>" x1="28.5" y1="15" x2="0" y2="15" style="stroke:black;stroke-width:2;display:none;" />
                        <line id="bariskeempatjembtengah<?=$x;?>" x1="0" y1="15" x2="60" y2="15" style="stroke:black;stroke-width:2;display:none;" />
                        <polyline id="bariskeempatsegitiga<?=$x;?>" points="13,80 45,80 29,103 13,80" style="fill:black;stroke:black;stroke-width:1;display:none;" />
                        <polyline id="bariskeempatpanahkiri<?=$x;?>" points="13,5 13,10 8,5 13,1 13,5 43,5" style="fill:black;stroke:black;stroke-width:1;display:none" />
                        <polyline id="bariskeempatpanahkanan<?=$x;?>" points="45,5 45,10 50,5 45,1 45,5 15,5" style="fill:black;stroke:black;stroke-width:1;display:none" />
                        <polyline id="bariskeempatlengkungatas1<?=$x;?>" class="st0" points="16,15 11,14 10,13 8,9 9,8 10,6 12,5 14,3 16,3 20,2 25,1 28,1 33,2 36,3" style="display:none;"  />
                        <polyline id="bariskeempatlengkungatas2<?=$x;?>" points="36,3 35,8 42,5 37,1" style="fill:black;stroke:black;stroke-width:1;display:none;"  />
                        <polyline id="bariskeempatlengkungbawah1<?=$x;?>" class="st0" points="16,93 11,95 10,97 8,99 9,103 10,104 12,105 14,107 16,107 20,108 25,109 30,109 33,108 36,107" style="display:none;"  />
                        <polyline id="bariskeempatlengkungbawah2<?=$x;?>"  points="36,107 38,112 40,105 32,102 36,107" style="fill:black;stroke:black;stroke-width:1;display:none;"  /> 
                        <text x="21" y="123" font-family="Verdana" font-size="13" fill="black" ><?php echo $angka[$x];?></text>
                        <text x="17" y="20" id="bariskeempatpre<?=$x;?>" font-family="Verdana" font-size="13" fill="blue" align="center" style="display:none;">PRE</text>
                        <text x="17" y="20" id="bariskeempatano<?=$x;?>" font-family="Verdana" font-size="13" fill="green" align="center" style="display:none;">ANO</text>
                        <text x="17" y="20" id="bariskeempatune<?=$x;?>" font-family="Verdana" font-size="13" fill="navy" align="center" style="display:none;">UNE</text>
                      </svg>
                    <?php } ?>
                  </div>
                </div>
                <div id="previewImg" style="display: block;" height="130" ></div>
                 
                  <div align="center">
                    <table width="80%" border="0">
                      <tbody>
                        <tr>
                          <td width="5%"><span><img src="<?php echo base_url('assets/images/pre.png');?>" width="30px;" height="15px;"></span></td>
                          <td ><button class="button split btn-default pull-right" style="width: 150px;" id="pre">Erupsi Sebagian</button></td>
                          <td width="5%">&nbsp;</td>
                          <td width="5%"><span><img src="<?php echo base_url('assets/images/crash.png');?>" width="20px;" height="20px;"></span></td>
                          <td ><button class="button split btn-default pull-right" style="width: 155px;" id="crash" >Fractured</button></td>
                          <td width="5%">&nbsp;</td>
                          <td width="5%"><span><img src="<?php echo base_url('assets/images/old_brown.png');?>" width="20px;" height="20px;"></span></td>
                          <td ><button class="button split btn-default pull-right" style="width: 155px;" id="old_brown">Tambalan Logam</button></td>
                          <td width="5%">&nbsp;</td>
                          <td width="5%"><span><img src="<?php echo base_url('assets/images/segitiga.png');?>" width="20px;" height="20px;"></span></td>
                          <td><button class="button split btn-default pull-right" style="width: 165px;" id="segitiga">Perawatan Sal. Akar</button></td>
                          <td width="20%" rowspan="2" align="right"><input id="save" type="button" class="btn btn-lg btn-success" value="Simpan" /></td>
                        </tr>
                        <tr>
                          <td><span><img src="<?php echo base_url('assets/images/ano.png');?>" width="30px;" height="15px;"></span></td>
                          <td><button class="button split btn-default pull-right" style="width: 150px;" id="ano">Anomali Bentuk</button></td>
                          <td width="5%">&nbsp;</td>
                          <td><span><img src="<?php echo base_url('assets/images/mahkota_logam.png');?>" width="20px;" height="20px;"></span></td>
                          <td><button class="button split btn-default pull-right" style="width: 155px;" id="outline">Mahkota Logam</button></td>
                          <td width="5%">&nbsp;</td>
                          <td><span><img src="<?php echo base_url('assets/images/green.png');?>" width="20px;" height="20px;"></span></td>
                          <td><button class="button split btn-default pull-right" style="width: 155px;" id="green">Tambalan Sewarna</button></td>
                          <td width="5%">&nbsp;</td>
                          <td><span><img src="<?php echo base_url('assets/images/biru_muda.png');?>" width="20px;" height="20px;"></span></td>
                          <td><button class="button split btn-default pull-right" style="width: 165px;" id="biru_muda">Tambalan Non Logam</button></td>
                          <!-- <td width="20%"></td> -->
                        </tr>
                        <tr>
                          <td><span><img src="<?php echo base_url('assets/images/une.png');?>" width="30px;" height="15px;"></span></td>
                          <td><button class="button split btn-default pull-right" style="width: 150px;" id="une">Belum Erupsi</button></td>
                          <td width="5%">&nbsp;</td>
                          <td rowspan="2" colspan="2">
                            <fieldset>
                                <legend style="width:40%">Jembatan</legend>
                                <!-- <div class="row" >
                                  <div class="col-sm-3"> -->
                                    <button class="button split btn-default pull-right" style="width: 55px;"  id="jemb_kiri"><---</button>
                                  <!-- </div>
                                  <div  class="col-sm-3"> -->
                                    <button class="button split btn-default pull-right" style="width: 55px;"  id="jemb_tengah">----</button>
                                  <!-- </div>
                                  <div class="col-sm-3"> -->
                                    <button class="button split btn-default pull-right" style="width: 55px;" id="jemb_kanan">---></button>
                                  <!-- </div>
                                </div> -->
                            </fieldset>
              
                          </td>
                          <td width="5%">&nbsp;</td>
                          <td><span><img src="<?php echo base_url('assets/images/red.png');?>" width="20px;" height="20px;"></span></td>
                          <td><button class="button split btn-default pull-right" style="width: 155px;" id="red">Tambalan Emas</button></td>
                          <td width="5%">&nbsp;</td>
                          <td><span><img src="<?php echo base_url('assets/images/akar.png');?>" width="20px;" height="20px;"></span></td>
                          <td><button class="button split btn-default pull-right" style="width: 165px;" id="akar">Sisa Akar</button></td>
                          <td width="20%"></td>
                        </tr>
                        <tr>
                          <td><span><img src="<?php echo base_url('assets/images/caries.png');?>" width="20px;" height="20px;"></span></td>
                          <td><button class="button split btn-default pull-right" style="width: 150px;" id="border">Caries</button></td>
                          <td width="5%">&nbsp;</td>
                          <td width="5%">&nbsp;</td>
                          <td><span><img src="<?php echo base_url('assets/images/pink.png');?>" width="20px;" height="20px;"></span></td>
                          <td><button class="button split btn-default pull-right" style="width: 155px;" id="pink">Tambalan Pencegah</button></td>
                          <td width="5%">&nbsp;</td>
                          <td> <span><img src="<?php echo base_url('assets/images/silang2.png');?>" width="20px;" height="20px;"></span></td>
                          <td><button class="button split btn-default pull-right" style="width: 165px;" id="silang">Gigi Hilang</button></td>
                        </tr>
                        <tr>
                          <td><span><img src="<?php echo base_url('assets/images/non_vital.png');?>" width="20px;" height="20px;"></span></td>
                          <td><button class="button split btn-default pull-right" style="width: 150px;" id="non_vital">Gigi Non Vital</button></td>
                          <td width="5%">&nbsp;</td>
                          <td><span><img src="<?php echo base_url('assets/images/non_logam.png');?>" width="20px;" height="20px;"></span></td>
                          <td><button class="button split btn-default pull-right" style="width: 155px;" id="cyann">Mahkota Non Logam</button></td>
                          <td width="5%">&nbsp;</td>
                          <td rowspan="2" colspan="2">
                            <fieldset>
                                <legend style="width:90%">Migrasi/Version/Rotasi</legend>
                                <button class="button split btn-default" id="panah_kanan">panah kanan</button>
                                <button class="button split btn-default" id="panah_kiri">panah kiri</button>
                            </fieldset>
                          </td>
                          <td width="5%">&nbsp;</td>
                          <td width="5%">&nbsp;</td>
                          <td width="5%">&nbsp;</td>
                          <td width="20%"></td>
                        </tr>
                        <!-- <tr>
                          <td width="5%">&nbsp;</td>
                          <td width="5%">&nbsp;</td>
                          <td width="5%">&nbsp;</td>
                          <td width="5%">&nbsp;</td>
                          <td width="5%">&nbsp;</td>
                          <td width="5%">&nbsp;</td>
                          <td width="5%">&nbsp;</td>
                          <td width="5%">&nbsp;</td>
                          <td width="5%">&nbsp;</td>
                            <td >
                            
                            </td>
                        </tr> -->
                      </tbody>
                    </table>
                  </div>
                  <div class="row" style="padding-top:20px;">
                    <div class="col-sm-3">
                      <div >
                        <input type="hidden" id="pilihanwarna" value="">
                      </div>
                    </div>
                  </div>
                  
                </div>
                <div class="tab-pane" id="otorisasi" role="tabpanel">
                  <form id="form-odonto">
                    <table width="80%" align="center">
                        <tr>
                          <td>
                            <div class="input-group">
                              <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1" style="width: 100px!important;">11 [51]</span></div>
                              <input type="text" class="form-control" aria-describedby="basic-addon1" name="sebelas">
                            </div>
                          </td>
                          <td>
                            <div class="input-group">
                              <input type="text" class="form-control" aria-describedby="basic-addon1" name="dua_satu">
                              <div class="input-group-append"><span class="input-group-text" id="basic-addon1" style="width: 100px!important;">[61] 21</span></div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="input-group">
                              <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1" style="width: 100px!important;">12 [52]</span></div>
                              <input type="text" class="form-control" aria-describedby="basic-addon1" name="dua_belas">
                            </div>
                          </td>
                          <td>
                            <div class="input-group">
                              <input type="text" class="form-control" aria-describedby="basic-addon1" name="dua_dua">
                              <div class="input-group-append"><span class="input-group-text" id="basic-addon1" style="width: 100px!important;">[62] 22</span></div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="input-group">
                              <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1" style="width: 100px!important;">13 [53]</span></div>
                              <input type="text" class="form-control" aria-describedby="basic-addon1" name="tiga_belas">
                            </div>
                          </td>
                          <td>
                            <div class="input-group">
                              <input type="text" class="form-control" aria-describedby="basic-addon1" name="dua_tiga">
                              <div class="input-group-append"><span class="input-group-text" id="basic-addon1" style="width: 100px!important;">[63] 23</span></div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="input-group">
                              <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1" style="width: 100px!important;">14 [54]</span></div>
                              <input type="text" class="form-control" aria-describedby="basic-addon1" name="empat_belas">
                            </div>
                          </td>
                          <td>
                            <div class="input-group">
                              <input type="text" class="form-control" aria-describedby="basic-addon1" name="dua_empat">
                              <div class="input-group-append"><span class="input-group-text" id="basic-addon1" style="width: 100px!important;">[64] 24</span></div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="input-group">
                              <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1" style="width: 100px!important;">15 [55]</span></div>
                              <input type="text" class="form-control" aria-describedby="basic-addon1" name="lima_belas">
                            </div>
                          </td>
                          <td>
                            <div class="input-group">
                              <input type="text" class="form-control" aria-describedby="basic-addon1" name="dua_lima">
                              <div class="input-group-append"><span class="input-group-text" id="basic-addon1" style="width: 100px!important;">[65] 25</span></div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="input-group">
                              <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1" style="width: 100px!important;">16</span></div>
                              <input type="text" class="form-control" aria-describedby="basic-addon1" name="enam_belas">
                            </div>
                          </td>
                          <td>
                            <div class="input-group">
                              <input type="text" class="form-control" aria-describedby="basic-addon1" name="dua_enam">
                              <div class="input-group-append"><span class="input-group-text" id="basic-addon1" style="width: 100px!important;">26</span></div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="input-group">
                              <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1" style="width: 100px!important;">17</span></div>
                              <input type="text" class="form-control" aria-describedby="basic-addon1" name="tujuh_belas">
                            </div>
                          </td>
                          <td>
                            <div class="input-group">
                              <input type="text" class="form-control" aria-describedby="basic-addon1" name="dua_tujuh">
                              <div class="input-group-append"><span class="input-group-text" id="basic-addon1" style="width: 100px!important;">27</span></div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="input-group">
                              <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1" style="width: 100px!important;">18</span></div>
                              <input type="text" class="form-control" aria-describedby="basic-addon1" name="delapan_belas">
                            </div>
                          </td>
                          <td>
                            <div class="input-group">
                              <input type="text" class="form-control" aria-describedby="basic-addon1" name="dua_delapan">
                              <div class="input-group-append"><span class="input-group-text" id="basic-addon1" style="width: 100px!important;">28</span></div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                           &nbsp;
                          </td>
                          <td>
                            &nbsp;
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="input-group">
                              <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1" style="width: 100px!important;">48</span></div>
                              <input type="text" class="form-control" aria-describedby="basic-addon1" name="empat_delapan">
                            </div>
                          </td>
                          <td>
                            <div class="input-group">
                              <input type="text" class="form-control" aria-describedby="basic-addon1" name="tiga_delapan">
                              <div class="input-group-append"><span class="input-group-text" id="basic-addon1" style="width: 100px!important;">38</span></div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="input-group">
                              <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1" style="width: 100px!important;">47</span></div>
                              <input type="text" class="form-control" aria-describedby="basic-addon1" name="empat_tujuh">
                            </div>
                          </td>
                          <td>
                            <div class="input-group">
                              <input type="text" class="form-control" aria-describedby="basic-addon1" name="tiga_tujuh">
                              <div class="input-group-append"><span class="input-group-text" id="basic-addon1" style="width: 100px!important;">37</span></div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="input-group">
                              <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1" style="width: 100px!important;">46</span></div>
                              <input type="text" class="form-control" aria-describedby="basic-addon1" name="empat_enam">
                            </div>
                          </td>
                          <td>
                            <div class="input-group">
                              <input type="text" class="form-control" aria-describedby="basic-addon1" name="tiga_enam">
                              <div class="input-group-append"><span class="input-group-text" id="basic-addon1" style="width: 100px!important;">36</span></div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="input-group">
                              <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1" style="width: 100px!important;">45 [85]</span></div>
                              <input type="text" class="form-control" aria-describedby="basic-addon1" name="empat_lima">
                            </div>
                          </td>
                          <td>
                            <div class="input-group">
                              <input type="text" class="form-control" aria-describedby="basic-addon1" name="tiga_lima">
                              <div class="input-group-append"><span class="input-group-text" id="basic-addon1" style="width: 100px!important;">[75] 35</span></div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="input-group">
                              <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1" style="width: 100px!important;">44 [84]</span></div>
                              <input type="text" class="form-control" aria-describedby="basic-addon1" name="empat_empat">
                            </div>
                          </td>
                          <td>
                            <div class="input-group">
                              <input type="text" class="form-control" aria-describedby="basic-addon1" name="tiga_empat">
                              <div class="input-group-append"><span class="input-group-text" id="basic-addon1" style="width: 100px!important;">[74] 34</span></div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="input-group">
                              <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1" style="width: 100px!important;">43 [83]</span></div>
                              <input type="text" class="form-control" aria-describedby="basic-addon1" name="empat_tiga">
                            </div>
                          </td>
                          <td>
                            <div class="input-group">
                              <input type="text" class="form-control" aria-describedby="basic-addon1" name="tiga_tiga">
                              <div class="input-group-append"><span class="input-group-text" id="basic-addon1" style="width: 100px!important;">[73] 33</span></div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="input-group">
                              <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1" style="width: 100px!important;">42 [82]</span></div>
                              <input type="text" class="form-control" aria-describedby="basic-addon1" name="empat_dua">
                            </div>
                          </td>
                          <td>
                            <div class="input-group">
                              <input type="text" class="form-control" aria-describedby="basic-addon1" name="tiga_dua">
                              <div class="input-group-append"><span class="input-group-text" id="basic-addon1" style="width: 100px!important;">[72] 32</span></div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="input-group">
                              <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1" style="width: 100px!important;">41 [81]</span></div>
                              <input type="text" class="form-control" aria-describedby="basic-addon1" name="empat_satu">
                            </div>
                          </td>
                          <td>
                            <div class="input-group">
                              <input type="text" class="form-control" aria-describedby="basic-addon1" name="tiga_satu">
                              <div class="input-group-append"><span class="input-group-text" id="basic-addon1" style="width: 100px!important;">[71] 31</span></div>
                            </div>
                          </td>
                        </tr>
                    </table>
                    <br>
                    <div class="kt-portlet__body" style="margin-left:200px;">
												<div class="kt-section kt-section--first">
													<div class="kt-section__body">
														<div class="form-group row">
															<label class="col-lg-2 col-form-label">Occlusi :</label>
															<div class="col-lg-6">
																<input type="email" class="form-control" >
															</div>
														</div>
														<div class="form-group row">
															<label class="col-lg-2 col-form-label">Torus Palatinus :</label>
															<div class="col-lg-6">
																<input type="email" class="form-control" >
															</div>
														</div>
                            <div class="form-group row">
															<label class="col-lg-2 col-form-label">Torus Mandibularis :</label>
															<div class="col-lg-6">
																<input type="email" class="form-control" >
															</div>
														</div>
                            <div class="form-group row">
															<label class="col-lg-2 col-form-label">Palatum :</label>
															<div class="col-lg-6">
																<input type="email" class="form-control" >
															</div>
														</div>
                            <div class="form-group row">
															<label class="col-lg-2 col-form-label">Diastema :</label>
															<div class="col-lg-6">
																<input type="email" class="form-control" >
															</div>
														</div>
                            <div class="form-group row">
															<label class="col-lg-2 col-form-label">Gigi Anomali :</label>
															<div class="col-lg-6">
																<input type="email" class="form-control" >
															</div>
														</div>
                            <div class="form-group row">
															<label class="col-lg-2 col-form-label">Lain - lain :</label>
															<div class="col-lg-6">
																<input type="email" class="form-control" >
															</div>
														</div>
                        </div>
                        <div >
													<div class="row">
														<div class="col-lg-3"></div>
														<div class="col-lg-6">
															<button type="button" class="btn btn-success" onclick="save_formulir()" >Submit</button>
															<button type="reset" class="btn btn-secondary">Cancel</button>
														</div>
													</div>
												</div>
												</div>
											</div>
                  </form>
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