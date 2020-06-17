$(function() {

    const flashdata = $('.flash-data').data('flashdata');
    const judul = $('.flash-data').data('judul');
    const type = $('.flash-data').data('type');
    const judul_dialog = $('.dialog').data('judul-dialog');

    if (flashdata) {
        Swal.fire({
            title : judul,
            text : flashdata,
            icon : type,
            backdrop: `
                linear-gradient(to bottom right, rgba(5,117,230,0.2), rgba(0,0,130,0.3))
            `,
            showClass: {
                popup: 'animate__animated animate__jello'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }    
        })    
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
            backdrop: `
                    linear-gradient(to bottom right, rgba(5,117,230,0.2), rgba(0,0,130,0.3))
                `,
            showClass: {
                popup: 'animate__animated animate__jello'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            },
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, '+judul_dialog+' sekarang!'
          }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }else if(result.dismiss === Swal.DismissReason.cancel){
                swalWithBootstrapButtons.fire(
                    {
                        title : 'Batal '+judul_dialog,
                        text : 'Data anda aman :)',
                        icon : 'error',
                        backdrop: `
                            linear-gradient(to bottom right, rgba(5,117,230,0.2), rgba(0,0,130,0.3))
                        `,
                        showClass: {
                            popup: 'animate__animated animate__jello'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__fadeOutUp'
                        }
                    }
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