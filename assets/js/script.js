$(function() {

    const flashdata = $('.flash-data').data('flashdata');
    const judul = $('.flash-data').data('judul');
    const type = $('.flash-data').data('type');
    const judul_dialog = $('.dialog').data('judul-dialog');

    if (flashdata) {
        Swal.fire(
            judul,
            flashdata,
            type
        )    
    }

    $('.dialog').click(function(e){
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
            title: 'Apa anda ingin '+judul_dialog+'?',
            text: 'Klik Ya untuk lanjut!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, '+judul_dialog+' sekarang!'
          }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }else if(result.dismiss === Swal.DismissReason.cancel){
                swalWithBootstrapButtons.fire(
                    'Batal '+judul_dialog,
                    'Data anda aman :)',
                    'error'
                )
            }
          })
    });

    const login = $('.login').data('login');
    const type2 = $('.login').data('type');

    if (login) {

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseenter', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: type2,
            title: login
        })
            
    }
    
});