$(function(){

    $('.btnTambahData').on('click', function() {
        var baseurl = $(this).data('zurl');
        var id = $(this).data('id');
        $('#exampleModalLabel').html('Tambah Data Menu');
        $('.modal-footer button[type=submit]').html('Simpan');
        $('#id').val('');
        $('#nama').val('');
        $('#harga').val('');
        $('#jenis').val(-1);
        $('.modal-body form').attr('action', baseurl+'/rumahmakan/simpanmenu');
    });

    $('.tampilModalUbah').on('click', function(){

        var baseurl = $(this).data('zurl');

        $('#exampleModalLabel').html('Ubah Data');
        $('.modal-footer button[type=submit]').html('Ubah Data');
        $('.modal-body form').attr('action', baseurl+'/rumahmakan/updatemenumakan');
        const id = $(this).data('id');

        $.ajax({
            url: baseurl+'/rumahmakan/getDataChange',
            data: {id : id},
            method: 'post',
            dataType: 'json',
            success: function(data){
                console.log(data);
                $('#id').val(data.id);
                $('#nama').val(data.nama);
                $('#harga').val(data.harga);
                $('#jenis').val(data.jenis);
            }
        });
    });

})