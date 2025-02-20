<div x-data="{isOpenToast:false}" x-show="isOpenToast" @notify.window="
        Toastify({
            text: $event.detail.message,
            duration: 3000,
            newWindow: true,
            close: false,
            gravity: 'top', // `top` or `bottom`
            position: 'right', // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: ($event.detail.type === 'success') ? '#2e7d32' : '#c62828',
            },
            onClick: function(){} // Callback after click
        }).showToast();
">
</div>