$(document).ready(function () {

    fetchData();

    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });

    //  Data table AJAX CALL
    function fetchData(params) {
        $('#example1').DataTable({
            "processing": true,
            "serverSide": true,
            // "scrollY": "400px",
          	// "scrollCollapse": true,
          	"responsive" : true,
            "lengthMenu": [ 5, 10, 20, 30],
            "ajax": site_url + 'admin/users'
        });
    }

    $(document).on('click', '.edit-records', function (e) {
    	var id = $(this).attr('data-id');
    	$('#form_method').val('PUT');
    	$.ajax({
    	    method: 'GET',
    	    url: site_url + 'admin/users/' + id + '/edit',
            data:{'id':id},
    	    dataType: 'json',
    	    success: function (data) {
    	        if (data.status == 1) {
    	            $('#updateId').val(data.data.id);
    	            $('#firstname').val(data.data.firstname);
                    $('#lastname').val(data.data.lastname);
                    $('#email').val(data.data.email);

                    if(data.data.status == 1)
                    {
                        $("#is_active").prop('checked', true);
                    }
                    else
                    {
                        $("#is_active").prop('checked', false);   
                    }

    	        }
    	    }
    	});

    }); // End Edit-records 

    $(document).on('click', '.view-records', function (e) {
        var id = $(this).attr('data-id');
        $('#form_method').val('PUT');
        $.ajax({
            method: 'GET',
            url: site_url + 'admin/users/' + id,
            data:{'id':id},
            dataType: 'json',
            success: function (data) {
                if (data.status == 1) {
                    $('#view_firstname').html(data.data.firstname);
                    $('#view_lastname').html(data.data.lastname);
                    $('#view_email').html(data.data.email);
                    
                    if(data.data.status == 1)
                    {
                        $("#view_is_active").html("Active");
                    }
                    else
                    {
                        $("#view_is_active").html("Inactive");
                    }

                }
            }
        });

    }); // End view-records

    $(document).on('submit', '#users-update-form', function (e) {
        event.preventDefault();
       
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-name"]').attr('content')
            }
        });
       
        let formData = new FormData($('#users-update-form')[0]);
        var userId = $('#updateId').val();
        
        if(userId !== '')
        {
            $.ajax({
                method: 'POST',
                url: site_url + 'admin/users/' + userId,
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log(data);
                    if (data.status == 1) {
                        $("#modal-lg").modal('hide');
                        $('#users-update-form')[0].reset();
                        $('#example1').DataTable().ajax.reload();
                        Toast.fire({
                            icon: 'success',
                            title: 'User updated successfully.'
                        })
                    }
                    else
                    {
                        Toast.fire({
                            icon: 'error',
                            title: 'somthing want wrong!.'
                        })
                    }
                }
            });
        }

    });

    /* Delete Record */
    $(document).on('click', '.deleted-record', function (event) {
        var userId = $(this).attr('data-id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-name"]').attr('content')
            }
        });

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't to delete this record!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value == true) {
                // $('#form_method').val('DELETE')
                $.ajax({
                    type: 'POST',
                    url: site_url + 'admin/users/' + userId,
                    data:{'id':userId},
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        if (data.status == 1) {
                            $('#users-update-form')[0].reset();
                            $('#example1').DataTable().ajax.reload();

                            Toast.fire({
                                icon: 'success',
                                title: 'Record Deleted successfully.'
                            })
                        }
                        else
                        {
                            $('#users-update-form').DataTable().ajax.reload();
                            Toast.fire({
                                icon: 'error',
                                title: 'opp, somthing want wrong!'
                            })
                        }
                    }
                });
            }
        })
    });

});