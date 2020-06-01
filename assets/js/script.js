$(function() {

    const flashdata = $('.flash-data').data('flashdata');
    const judul = $('.flash-data').data('judul');
    if (flashdata) {
        Swal.fire(
            judul,
            flashdata,
            'success'
        )    
    }

    $('.hapus').click(function(e){
        e.preventDefault();

        const href = $(this).attr('href');
        
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        Swal.fire({
            title: 'Apa anda ingin menghapus '+judul+'?',
            text: 'Klik Ya untuk hapus!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus sekarang!'
          }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }else if(result.dismiss === Swal.DismissReason.cancel){
                swalWithBootstrapButtons.fire(
                    'Batal Hapus '+judul,
                    'Data anda aman :)',
                    'error'
                )
            }
          })
    });
    
});