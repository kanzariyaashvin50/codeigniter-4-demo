$(document).ready(function () {

	$(document).on('click','.admin-profile-img', function (e) {
		$('input[type="file"]').trigger('click');
	});

	$(document).on('change','input[type="file"]', function (e) {
		var reader    = new FileReader();
		reader.onload = (e) =>
		{ 
			$('.admin-profile-img').attr('src', e.target.result);
		}
		reader.readAsDataURL(this.files[0]);
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-name"]').attr('content')
		    }
		});
		let formData = new FormData($('#profile-form')[0]);

		 $.ajax({
			type : 'POST',
			url : site_url+'admin/profile',
			data: formData,
			contentType: false,
			processData: false,
			dataType : 'JSON',
			success : function(response){
			    if (response.status == 1) 
			    {
			        Toast.fire({
                        icon: 'success',
                        title: 'User updated successfully.'
                    });
			    }
	  		}
  		});

	});



});