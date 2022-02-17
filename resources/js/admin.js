require('./bootstrap');

/*Sweet Alert*/
import Swal from 'sweetalert2'

/*Intialize the Swal*/
window.Swal=Swal;

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
window.Toast=Toast;

require('./leaderboard');
