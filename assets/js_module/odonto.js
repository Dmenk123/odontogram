$('#red').click(function(){
    $('#pilihanwarna').val('#ff0000');
});
$('#green').click(function(){
    $('#pilihanwarna').val('#00ff00');
});

$('#cyann').click(function(){
    $('#pilihanwarna').val('#00ffff');
});

$('#old_brown').click(function(){
    $('#pilihanwarna').val('#A9A9A9');
});

$('#pink').click(function(){
    $('#pilihanwarna').val('#ff3399');
});

$('#biru_muda').click(function(){
    $('#pilihanwarna').val('#b3b3ff');
});

$('#outline').click(function(){
    $('#pilihanwarna').val('outline');
});

$('#pre').click(function(){
    $('#pilihanwarna').val('PRE');
});

$('#ano').click(function(){
    $('#pilihanwarna').val('ANO');
});

$('#une').click(function(){
    $('#pilihanwarna').val('UNE');
});

$('#silang').click(function(){
    $('#pilihanwarna').val('silang');
});

$('#akar').click(function(){
    $('#pilihanwarna').val('akar');
});

$('#border').click(function(){
    $('#pilihanwarna').val('border');
});

$('#segitiga').click(function(){
    $('#pilihanwarna').val('segitiga');
});

$('#panah_kanan').click(function(){
    $('#pilihanwarna').val('panah_kanan');
});
$('#panah_kiri').click(function(){
    $('#pilihanwarna').val('panah_kiri');
});
$('#non_vital').click(function(){
    $('#pilihanwarna').val('non_vital');
});

$('#crash').click(function(){
    $('#pilihanwarna').val('crash');
});

$('#jemb_kiri').click(function(){
    $('#pilihanwarna').val('jembatan_kiri');
});

$('#jemb_tengah').click(function(){
    $('#pilihanwarna').val('jembatan_tengah');
});

$('#jemb_kanan').click(function(){
    $('#pilihanwarna').val('jembatan_kanan');
});

$( document ).ready(function() {
    console.log('tes');
    var i;
        $("#barispertamakiri1").on('click', function(event){
            var hasil = $('#pilihanwarna').val();
            var subs  = hasil.substring(0,1);
            if(subs == '#'){
                $("#barispertamakiri1").css("fill", $('#pilihanwarna').val());
            }else if (hasil == 'outline') {
                $("#barispertamaoutline1").css("display", "block");
            }else if (hasil == 'PRE') {
                $("#barispertamapre1").css("display", "block");
                $("#barispertamaano1").css("display", "none");
                $("#barispertamaune1").css("display", "none");
            }else if (hasil == 'ANO') {
                $("#barispertamapre1").css("display", "none");
                $("#barispertamaune1").css("display", "none");
                $("#barispertamaano1").css("display", "block");
            }else if(hasil == 'UNE'){
                $("#barispertamapre1").css("display", "none");
                $("#barispertamaune1").css("display", "block");
                $("#barispertamaano1").css("display", "none");
            }else if (hasil == 'silang') {
                $("#barispertamasilang11").css("display", "block");
                $("#barispertamasilang21").css("display", "block");
            }else if (hasil == 'border'){
                $("#barispertamakiri1").css("stroke-width", '2');
            }else if (hasil == 'segitiga') {
                $("#barispertamasegitiga1").css("display", "block");
            }else if (hasil == 'panah_kanan') {
                $("#barispertamapanahkanan1").css("display", "block");
            }else if (hasil == 'panah_kiri') {
                $("#barispertamapanahkiri1").css("display", "block");
            }else if (hasil == 'non_vital') {
                $("#barispertamasegitiga1").css("display", "block");
                $("#barispertamasegitiga1").css("fill", "white");
            }else if (hasil == 'akar') {
                $("#barispertamaakar11").css("display", "block");
                $("#barispertamaakar21").css("display", "block");
            }else if (hasil == 'crash') {
                $("#barispertamacrash11").css("display", "block");
                $("#barispertamacrash21").css("display", "block");
                $("#barispertamacrash31").css("display", "block");
                $("#barispertamacrash41").css("display", "block");
            }else if (hasil == 'jembatan_kiri') {
                $("#barispertamajembtegak1").css("display", "block");
                $("#barispertamajembkiri1").css("display", "block");
            }else if (hasil == 'jembatan_tengah') {
                $("#barispertamajembtengah1").css("display", "block");
            }else if (hasil == 'jembatan_kanan') {
                $("#barispertamajembtegak1").css("display", "block");
                $("#barispertamajembkanan1").css("display", "block");
            }
        });
        $("#barispertamakiri2").on('click', function(event){
            var hasil = $('#pilihanwarna').val();
            var subs  = hasil.substring(0,1);
            if(subs == '#'){
                $("#barispertamakiri2").css("fill", $('#pilihanwarna').val());
            }else if (hasil == 'jembatan_kiri') {
                $("#barispertamajembtegak2").css("display", "block");
                $("#barispertamajembkiri2").css("display", "block");
            }else if (hasil == 'jembatan_tengah') {
                $("#barispertamajembtengah2").css("display", "block");
            }else if (hasil == 'jembatan_kanan') {
                $("#barispertamajembtegak2").css("display", "block");
                $("#barispertamajembkanan2").css("display", "block");
            }
        });
        $("#barispertamaatas1").on('click', function(event){
            var hasil = $('#pilihanwarna').val();
            var subs  = hasil.substring(0,1);
            if(subs == '#'){
                $("#barispertamaatas1").css("fill", $('#pilihanwarna').val());
            }else if (hasil == 'outline') {
                $("#barispertamaoutline1").css("display", "block");
            }else if (hasil == 'PRE') {
                $("#barispertamapre1").css("display", "block");
                $("#barispertamaune1").css("display", "none");
                $("#barispertamaano1").css("display", "none");
            }else if (hasil == 'ANO') {
                $("#barispertamapre1").css("display", "none");
                $("#barispertamaune1").css("display", "none");
                $("#barispertamaano1").css("display", "block");
            }else if(hasil == 'UNE'){
                $("#barispertamapre1").css("display", "none");
                $("#barispertamaune1").css("display", "block");
                $("#barispertamaano1").css("display", "none");
            }else if (hasil == 'silang') {
                $("#barispertamasilang11").css("display", "block");
                $("#barispertamasilang21").css("display", "block");
            }else if (hasil == 'border'){
                $("#barispertamaatas1").css("stroke-width", '2');
            }else if (hasil == 'segitiga') {
                $("#barispertamasegitiga1").css("display", "block");
            }else if (hasil == 'panah_kanan') {
                $("#barispertamapanahkanan1").css("display", "block");
            }else if (hasil == 'panah_kiri') {
                $("#barispertamapanahkiri1").css("display", "block");
            }else if (hasil == 'non_vital') {
                $("#barispertamasegitiga1").css("display", "block");
                $("#barispertamasegitiga1").css("fill", "white");
            }else if (hasil == 'akar') {
                $("#barispertamaakar11").css("display", "block");
                $("#barispertamaakar21").css("display", "block");
            }else if (hasil == 'crash') {
                $("#barispertamacrash11").css("display", "block");
                $("#barispertamacrash21").css("display", "block");
                $("#barispertamacrash31").css("display", "block");
                $("#barispertamacrash41").css("display", "block");
            }else if (hasil == 'jembatan_kiri') {
                $("#barispertamajembtegak1").css("display", "block");
                $("#barispertamajembkiri1").css("display", "block");
            }else if (hasil == 'jembatan_tengah') {
                $("#barispertamajembtengah1").css("display", "block");
            }else if (hasil == 'jembatan_kanan') {
                $("#barispertamajembtegak1").css("display", "block");
                $("#barispertamajembkanan1").css("display", "block");
            }
        });
        $("#barispertamakanan1").on('click', function(event){
            var hasil = $('#pilihanwarna').val();
            var subs  = hasil.substring(0,1);
            if(subs == '#'){
                $("#barispertamakanan1").css("fill", $('#pilihanwarna').val());
            }else if (hasil == 'outline') {
                $("#barispertamaoutline1").css("display", "block");
            }else if (hasil == 'PRE') {
                $("#barispertamapre1").css("display", "block");
                $("#barispertamaano1").css("display", "none");
                $("#barispertamaune1").css("display", "none");
            }else if (hasil == 'ANO') {
                $("#barispertamapre1").css("display", "none");
                $("#barispertamaano1").css("display", "block");
                $("#barispertamaune1").css("display", "none");
            }else if(hasil == 'UNE'){
                $("#barispertamapre1").css("display", "none");
                $("#barispertamaune1").css("display", "block");
                $("#barispertamaano1").css("display", "none");
            }else if (hasil == 'silang') {
                $("#barispertamasilang11").css("display", "block");
                $("#barispertamasilang21").css("display", "block");
            }else if (hasil == 'border'){
                $("#barispertamakanan1").css("stroke-width", '2');
            }else if (hasil == 'segitiga') {
                $("#barispertamasegitiga1").css("display", "block");
            }else if (hasil == 'panah_kanan') {
                $("#barispertamapanahkanan1").css("display", "block");
            }else if (hasil == 'panah_kiri') {
                $("#barispertamapanahkiri1").css("display", "block");
            }else if (hasil == 'non_vital') {
                $("#barispertamasegitiga1").css("display", "block");
                $("#barispertamasegitiga1").css("fill", "white");
            }else if (hasil == 'akar') {
                $("#barispertamaakar11").css("display", "block");
                $("#barispertamaakar21").css("display", "block");
            }else if (hasil == 'crash') {
                $("#barispertamacrash11").css("display", "block");
                $("#barispertamacrash21").css("display", "block");
                $("#barispertamacrash31").css("display", "block");
                $("#barispertamacrash41").css("display", "block");
            }else if (hasil == 'jembatan_kiri') {
                $("#barispertamajembtegak1").css("display", "block");
                $("#barispertamajembkiri1").css("display", "block");
            }else if (hasil == 'jembatan_tengah') {
                $("#barispertamajembtengah1").css("display", "block");
            }else if (hasil == 'jembatan_kanan') {
                $("#barispertamajembtegak1").css("display", "block");
                $("#barispertamajembkanan1").css("display", "block");
            }
        });
        $("#barispertamabawah1").on('click', function(event){
            var hasil = $('#pilihanwarna').val();
            var subs  = hasil.substring(0,1);
            if(subs == '#'){
                $("#barispertamabawah1").css("fill", $('#pilihanwarna').val());
            }else if (hasil == 'outline') {
                $("#barispertamaoutline1").css("display", "block");
            }else if (hasil == 'PRE') {
                $("#barispertamapre1").css("display", "block");
                $("#barispertamaune1").css("display", "none");
                $("#barispertamaano1").css("display", "none");
            }else if (hasil == 'ANO') {
                $("#barispertamapre1").css("display", "none");
                $("#barispertamaune1").css("display", "none");
                $("#barispertamaano1").css("display", "block");
            }else if(hasil == 'UNE'){
                $("#barispertamapre1").css("display", "none");
                $("#barispertamaune1").css("display", "block");
                $("#barispertamaano1").css("display", "none");
            }else if (hasil == 'silang') {
                $("#barispertamasilang11").css("display", "block");
                $("#barispertamasilang21").css("display", "block");
            }else if (hasil == 'border'){
                $("#barispertamabawah1").css("stroke-width", '2');
            }else if (hasil == 'segitiga') {
                $("#barispertamasegitiga1").css("display", "block");
            }else if (hasil == 'panah_kanan') {
                $("#barispertamapanahkanan1").css("display", "block");
            }else if (hasil == 'panah_kiri') {
                $("#barispertamapanahkiri1").css("display", "block");
            }else if (hasil == 'non_vital') {
                $("#barispertamasegitiga1").css("display", "block");
                $("#barispertamasegitiga1").css("fill", "white");
            }else if (hasil == 'akar') {
                $("#barispertamaakar11").css("display", "block");
                $("#barispertamaakar21").css("display", "block");
            }else if (hasil == 'crash') {
                $("#barispertamacrash11").css("display", "block");
                $("#barispertamacrash21").css("display", "block");
                $("#barispertamacrash31").css("display", "block");
                $("#barispertamacrash41").css("display", "block");
            }else if (hasil == 'jembatan_kiri') {
                $("#barispertamajembtegak1").css("display", "block");
                $("#barispertamajembkiri1").css("display", "block");
            }else if (hasil == 'jembatan_tengah') {
                $("#barispertamajembtengah1").css("display", "block");
            }else if (hasil == 'jembatan_kanan') {
                $("#barispertamajembtegak1").css("display", "block");
                $("#barispertamajembkanan1").css("display", "block");
            }
        });
        $("#barispertamatengah1").on('click', function(event){
            var hasil = $('#pilihanwarna').val();
            var subs  = hasil.substring(0,1);
            if(subs == '#'){
                $("#barispertamatengah1").css("fill", $('#pilihanwarna').val());
            }else if (hasil == 'outline') {
                $("#barispertamaoutline1").css("display", "block");
            }else if (hasil == 'PRE') {
                $("#barispertamapre1").css("display", "block");
                $("#barispertamaano1").css("display", "none");
                $("#barispertamaune1").css("display", "none");
            }else if (hasil == 'ANO') {
                $("#barispertamapre1").css("display", "none");
                $("#barispertamaune1").css("display", "none");
                $("#barispertamaano1").css("display", "block");
            }else if(hasil == 'UNE'){
                $("#barispertamapre1").css("display", "none");
                $("#barispertamaune1").css("display", "block");
                $("#barispertamaano1").css("display", "none");
            }else if (hasil == 'silang') {
                $("#barispertamasilang11").css("display", "block");
                $("#barispertamasilang21").css("display", "block");
            }else if (hasil == 'border'){
                $("#barispertamatengah1").css("stroke-width", '2');
            }else if (hasil == 'segitiga') {
                $("#barispertamasegitiga1").css("display", "block");
            }else if (hasil == 'panah_kanan') {
                $("#barispertamapanahkanan1").css("display", "block");
            }else if (hasil == 'panah_kiri') {
                $("#barispertamapanahkiri1").css("display", "block");
            }else if (hasil == 'non_vital') {
                $("#barispertamasegitiga1").css("display", "block");
                $("#barispertamasegitiga1").css("fill", "white");
            }else if (hasil == 'akar') {
                $("#barispertamaakar11").css("display", "block");
                $("#barispertamaakar21").css("display", "block");
            }else if (hasil == 'crash') {
                $("#barispertamacrash11").css("display", "block");
                $("#barispertamacrash21").css("display", "block");
                $("#barispertamacrash31").css("display", "block");
                $("#barispertamacrash41").css("display", "block");
            }else if (hasil == 'jembatan_kiri') {
                $("#barispertamajembtegak1").css("display", "block");
                $("#barispertamajembkiri1").css("display", "block");
            }else if (hasil == 'jembatan_tengah') {
                $("#barispertamajembtengah1").css("display", "block");
            }else if (hasil == 'jembatan_kanan') {
                $("#barispertamajembtegak1").css("display", "block");
                $("#barispertamajembkanan1").css("display", "block");
            }
        });


});
