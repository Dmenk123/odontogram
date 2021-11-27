
$(document).ready(function(){

    $('#save').click(function() {
        html2canvas($('#imagesave')[0], {
            // width : 1500,
            // height : 700,
            // scale:3
        }).then(function(canvas) {
            // var a = document.createElement('a');
            var dataURL = canvas.toDataURL("image/png");
            // a.href = canvas.toDataURL("image/png");
            // a.download = 'myfile.png';
            // a.click();
            $.ajax({
                url : base_url + 'rekam_medik/save_odontogram',
                type: 'post',
                data: {
                    image: dataURL,
                    id_reg: id_reg
                },
                dataType: 'json',
                success: function(data)
                {
                    swalConfirm.fire('Berhasil Menyimpan Odontogram!', data.pesan, 'success');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    Swal.fire('Terjadi Kesalahan');
                }
            });
        });
    });

});


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
    // console.log('tes');
    let id;
        for(var i = 1; i <= 16; i++) {
            $('#barispertamakiri' + i).click( createCallback( i, 'kiri', 'pertama' ) );
            $('#barispertamaatas' + i).click( createCallback( i, 'atas', 'pertama' ) );
            $('#barispertamakanan' + i).click( createCallback( i, 'kanan', 'pertama' ) );
            $('#barispertamabawah' + i).click( createCallback( i, 'bawah', 'pertama' ) );
            $('#barispertamatengah' + i).click( createCallback( i, 'tengah', 'pertama' ) );

            $('#bariskeduakiri' + i).click( createCallback( i, 'kiri', 'kedua' ) );
            $('#bariskeduaatas' + i).click( createCallback( i, 'atas', 'kedua' ) );
            $('#bariskeduakanan' + i).click( createCallback( i, 'kanan', 'kedua' ) );
            $('#bariskeduabawah' + i).click( createCallback( i, 'bawah', 'kedua' ) );
            $('#bariskeduatengah' + i).click( createCallback( i, 'tengah', 'kedua' ) );

            $('#barisketigakiri' + i).click( createCallback( i, 'kiri', 'ketiga' ) );
            $('#barisketigaatas' + i).click( createCallback( i, 'atas', 'ketiga' ) );
            $('#barisketigakanan' + i).click( createCallback( i, 'kanan', 'ketiga' ) );
            $('#barisketigabawah' + i).click( createCallback( i, 'bawah', 'ketiga' ) );
            $('#barisketigatengah' + i).click( createCallback( i, 'tengah', 'ketiga' ) );

            $('#bariskeempatkiri' + i).click( createCallback( i, 'kiri', 'keempat' ) );
            $('#bariskeempatatas' + i).click( createCallback( i, 'atas', 'keempat' ) );
            $('#bariskeempatkanan' + i).click( createCallback( i, 'kanan', 'keempat' ) );
            $('#bariskeempatbawah' + i).click( createCallback( i, 'bawah', 'keempat' ) );
            $('#bariskeempattengah' + i).click( createCallback( i, 'tengah', 'keempat' ) );
        }

        function createCallback( i , sebelah, baris){
            return function(){
                var hasil = $('#pilihanwarna').val();
                var subs  = hasil.substring(0,1);
                if(subs == '#'){
                    $("#baris" + baris + '' + sebelah + '' + i).css("fill", $('#pilihanwarna').val());
                }else if (hasil == 'outline') {
                    $("#baris" + baris + "outline" + i).css("display", "block");
                }else if (hasil == 'PRE') {
                    $("#baris"+ baris +"pre" + i).css("display", "block");
                    $("#baris"+ baris +"ano" + i).css("display", "none");
                    $("#baris"+ baris +"une" + i).css("display", "none");
                }else if (hasil == 'ANO') {
                    $("#baris"+ baris +"pre" + i).css("display", "none");
                    $("#baris"+ baris +"une" + i).css("display", "none");
                    $("#baris"+ baris +"ano" + i).css("display", "block");
                }else if(hasil == 'UNE'){
                    $("#baris"+ baris +"pre" + i).css("display", "none");
                    $("#baris"+ baris +"une" + i).css("display", "block");
                    $("#baris"+ baris +"ano" + i).css("display", "none");
                }else if (hasil == 'silang') {
                    $("#baris"+ baris +"silang1" + i).css("display", "block");
                    $("#baris"+ baris +"silang2" + i).css("display", "block");
                }else if (hasil == 'border'){
                    $("#baris" + baris + '' +sebelah+'' + i).css("stroke-width", '2');
                }else if (hasil == 'segitiga') {
                    $("#baris"+ baris +"segitiga" + i).css("display", "block");
                }else if (hasil == 'panah_kanan') {
                    $("#baris"+ baris +"panahkanan" + i).css("display", "block");
                }else if (hasil == 'panah_kiri') {
                    $("#baris"+ baris +"panahkiri" + i).css("display", "block");
                }else if (hasil == 'non_vital') {
                    $("#baris"+ baris +"segitiga" + i).css("display", "block");
                    $("#baris"+ baris +"segitiga" + i).css("fill", "white");
                }else if (hasil == 'akar') {
                    $("#baris"+ baris +"akar1" + i).css("display", "block");
                    $("#baris"+ baris +"akar2" + i).css("display", "block");
                }else if (hasil == 'crash') {
                    $("#baris"+ baris +"crash1" + i).css("display", "block");
                    $("#baris"+ baris +"crash2" + i).css("display", "block");
                    $("#baris"+ baris +"crash3" + i).css("display", "block");
                    $("#baris"+ baris +"crash4" + i).css("display", "block");
                }else if (hasil == 'jembatan_kiri') {
                    $("#baris"+ baris +"jembtegak" + i).css("display", "block");
                    $("#baris"+ baris +"jembkiri" + i).css("display", "block");
                }else if (hasil == 'jembatan_tengah') {
                    $("#baris"+ baris +"jembtengah" + i).css("display", "block");
                }else if (hasil == 'jembatan_kanan') {
                    $("#baris"+ baris +"jembtegak" + i).css("display", "block");
                    $("#baris"+ baris +"jembkanan" + i).css("display", "block");
                }
            }
        }
        
       
       
       


});
