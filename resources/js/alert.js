import './bootstrap';

const iziToast = await
import ('izitoast');
await
import ('izitoast/dist/css/iziToast.min.css');

async function alertError(text) {

    iziToast.error({
        id: 'error',
        title: 'Lỗi:',
        message: text,
        position: 'bottomCenter',
        transitionIn: 'fadeInDown'
    });
}

window.alertError = alertError;

async function alertSuccess(text, timeReload = null) {

    iziToast.success({
        id: 'success',
        title: 'Thành công:',
        message: text,
        position: 'bottomCenter',
        transitionIn: 'fadeInDown'
    });

    if (timeReload) {
        setTimeout(function() {
            location.reload(); // Reload lại trang
        }, timeReload); // 2 giây
    }
}

window.alertSuccess = alertSuccess;