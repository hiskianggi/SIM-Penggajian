/*================================================================================
	Item Name: Materialize - Material Design Admin Template
	Version: 4.0
	Author: PIXINVENT
	Author URL: https://themeforest.net/user/pixinvent/portfolio
================================================================================

NOTE:
------
PLACE HERE YOUR OWN JS CODES AND IF NEEDED.
WE WILL RELEASE FUTURE UPDATES SO IN ORDER TO NOT OVERWRITE YOUR CUSTOM SCRIPT IT'S BETTER LIKE THIS. */

function angka(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if ((charCode < 48 || charCode > 57)&&charCode>32)
        return false;
    return true;
}
function huruf(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if ((charCode < 65 || charCode > 90)&&(charCode < 97 || charCode > 122)&&charCode>32)
        return false;
    return true;
}
function stts(){
    plh=$("#status").val();
    if(plh=="Sudah Menikah"){
        $("#jml_anak").show();
    }else{
        $("#jml_anak").hide();
    }
}
function pencarian_data(){
    jsp=$("#jenis_pencarian").val();
    if(jsp=="tanggal_lahir"){
        $("#cari_data").attr("type", "date");
    }else{
        $("#cari_data").attr("type", "text");
    }
}
function cari_pegawai(){
    $.ajax({
        url: 'content/cari_pegawai.php',
        type:"POST",
        dataType:"json",
        data:{
            nip:$("#nip").val()
        },
        success:function(hasil){
            $("#nama").val(hasil.nama);
            $("#status").val(hasil.status);
            $("#nama_jabatan").val(hasil.nama_jabatan);
            $("#gaji_pokok").val(hasil.gaji_pokok);
            $("#tj_jabatan").val(hasil.tj_jabatan);
            $("#golongan").val(hasil.golongan);
            tjn=$("#status").val();
            if(tjn=="Sudah Menikah"){
                $("#tj_suami_istri").val(hasil.tj_suami_istri);
                $("#tj_anak").val(hasil.tj_anak);
            }else{
                document.getElementById('tj_suami_istri').value=0;
                document.getElementById('tj_anak').value=0;
            }
            $("#jumlah_anak").val(hasil.jumlah_anak);
            GajiPokok = $("#gaji_pokok").val();
            TunjJabt = $("#tj_jabatan").val();
            TunjIstr = $("#tj_suami_istri").val();
            TunjAnk = $("#tj_anak").val();
            JmlAnk = $("#jumlah_anak").val();
            TunjKotr = parseInt(GajiPokok)+parseInt(TunjJabt)+parseInt(TunjIstr)+parseInt(TunjAnk)*JmlAnk;
            document.getElementById('pendapatan_kotor').value=TunjKotr;
            PPn = TunjKotr * 0.1;
            document.getElementById('potongan_ppn').value=PPn;
            GajBersh = TunjKotr - PPn;
            document.getElementById('gaji_bersih').value=GajBersh;
        }
    });
}
$(document).ready(function() {
    $('#modal1').modal();
    $('#modal2').modal();
});
$(document).on('click', '.pilihdatapegawai', function (e) {
    document.getElementById("nip").value = $(this).attr('data-nip');
    cari_pegawai();
});
function refreshaction(){
    pencarian_data();
}