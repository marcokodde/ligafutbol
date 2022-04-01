const Toast = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    showCloseButton: true,
    timer: 3000,
    timerProgressBar:true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

window.addEventListener('alert',({detail:{type,message}})=>{
    Toast.fire({
        icon:type,
        title:message
    })
})



function confirm_modal(id) {
    var record = id;
    Swal.fire({
        title: "{{__('Are you sure?')}}",
        text: "{{__('You wo not be able to revert this!')}}",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "{{__('Yes, delete it!')}}",
    }).then((result) => {
        if (result.isConfirmed) {
            window.livewire.emit('destroy', record);
            Swal.fire(
            'Deleted!',
            "{{__('Your record has been deleted.')}}",
            'success'
            )
        }
    })
}
