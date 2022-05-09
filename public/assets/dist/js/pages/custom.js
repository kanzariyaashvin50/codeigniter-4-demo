$(document).ready(function(){

    fetchData();

    //  Data table AJAX CALL

    function fetchData(params) {
    
        $('#example1').DataTable({

            "processing": true,

            "serverSide": true,

            "ajax": site_url + 'users/getData'

        } );

    }



/* end datatable with id (filter and ajax reload) */

var country  = $('#country-set-value').val();
 
    var statedef = '';
    var citydef = '';
    
    if(country !== '')
    {
console.log(country);
        statedef = $('#state-set-value').val();
        citydef = $('#city-set-value').val();

        // $.ajax({
        //     type : 'POST',
        //     url : site_url + 'common/getStateByCountry/'+country,
        //     dataType : 'html',
        //     success : function(html){
        //       $("select.state-dropdown").html(html);
        //     if(statedef !== '')
        //         {
        //             $('select.state-dropdown option[value="'+ statedef +'"]').attr("selected",true);
        //         }
        //     }
        // });

        // $.ajax({
        //     type : 'POST',
        //     url : site_url + 'common/getCityByState/'+statedef,
        //     dataType : 'html',
        //     success : function(html){
        //       $("select.city-dropdown").html(html);
        //       if(statedef !== '')
        //       {
        //           $('select.city-dropdown option[value="'+ citydef +'"]').attr("selected",true);
        //       }
        //   }
        // });
       
    }

    // Get Statename using country code.

    $("body").on('change','.countries-dropdown',function(){

        $c_obj = $(this);

        if($c_obj.val() !== '')

        {

            $('#country-error').hide();

            

            blockLoader($c_obj.parents(".countryStateCity:first").find("select.state-dropdown").parents('.form-group'));

            $.ajax({

                type : 'POST',

                url : site_url + 'common/getStateByCountry/'+$c_obj.val(),

                dataType : 'html',

                success : function(html){

                    $c_obj.parents(".countryStateCity:first").find("select.state-dropdown").html(html);

                    blockLoader($c_obj.parents(".countryStateCity:first").find("select.state-dropdown").parents('.form-group'),10)

                }

            });

        }

        else

        {

            

            $c_obj.parents(".countryStateCity:first").find("select.state-dropdown").html('<option value="">Select State</option>');

            blockLoader($c_obj.parents(".countryStateCity:first").find("select.state-dropdown").parents('.form-group'),10)

        }

    });



    $("body").on('change','.state-dropdown',function(){

        $s_obj = $(this);

        if($s_obj.val() !== '')

        {

            $('#state-error').hide();

            

            blockLoader($c_obj.parents(".countryStateCity:first").find("select.city-dropdown").parents('.form-group'));

            $.ajax({

                type : 'POST',

                url : site_url + 'common/getCityByState/'+$s_obj.val(),

                dataType : 'html',

                success : function(html){

                    $c_obj.parents(".countryStateCity:first").find("select.city-dropdown").html(html);

                    blockLoader($c_obj.parents(".countryStateCity:first").find("select.city-dropdown").parents('.form-group'),10)

                }

            });

        }

        else

        {

            $c_obj.parents(".countryStateCity:first").find("select.city-dropdown").html('<option value="">Select City</option>');

            blockLoader($c_obj.parents(".countryStateCity:first").find("select.city-dropdown").parents('.form-group'),10)

        }

    });



    $("body").on('change','.city-dropdown',function(){

        $c_obj = $(this);

        if($c_obj.val() !== '')

        {

            $('#city-error').hide();

        }

    });

    

    // # Edit Records



    // $("body").on('click','#editusers',function(){

    //     $u_obj = $(this).attr('data-id');

    //     if($u_obj !== '')

    //     {

    //         $.ajax({

    //             type : 'GET',

    //             url : site_url + 'userscontroller/update/'+$u_obj,

    //             dataType : 'JSON',

    //             success : function(data){

    //                 var datas = JSON.parse(JSON.stringify(data.data));

    //                 $('#updateId').val(datas.id);

    //                 $('#firstname').val(datas.first_name);

    //                 $('#lastname').val(datas.last_name);

    //                 $('#mobile_number').val(datas.mobile_number);

    //                 $('#email').val(datas.email);

    //                 $('#dob').val(datas.dob);



    //                 $("#country select").val(101).change();

    //                 // var data = JSON.parse(data);

    //             }

    //         });

    //     }

    // });

    

    // Remove Custom error message.

    var timeout = 3000; // in miliseconds (3*1000)

    $('.custom_error_message').delay(timeout).fadeOut(300);



    // Select-2 Dropdown

    $('.select2').select2()



    //Initialize Select2 Elements

    $('.select2bs4').select2({

    theme: 'bootstrap4'

    })





    //Date and time picker

    $('#reservationdatetime').datetimepicker({

        format: 'YYYY-MM-DD',

    });



    /* show loading on given class with given seconds */

    function blockLoader(block_element, timelimit, loaderMessage) {

        var block_ele = block_element;

        timelimit = timelimit || 0;



        // Block Element

        block_ele.block({

            message: loaderMessage || '<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>',

            timeout: timelimit,

            overlayCSS: {

                backgroundColor: '#FFF',

                cursor: 'wait',

            },

            css: {

                border: 0,

                padding: 0,

                backgroundColor: 'none'

            }

        });

    }

    

    // Selected image preview  

    $('#exampleInputFile').change(function(){

        

        var ext = $('#exampleInputFile').val().split('.').pop().toLowerCase();
        
        $('.file-upload-err').removeClass('d-block');

        $('.file-upload-err').addClass('d-none');
        

        if($.inArray(ext, ['png','jpg','jpeg']) == -1) {

            $('.file-upload-error').html('<div id="image-error" class="error-class"> You can only upload jpg, jpeg, png files.</div>');

            $('#exampleInputFile').removeClass('valid-class');

            $('#exampleInputFile').addClass('error-class');

            $('#image-error').css('display','block');



        }

        else

        {

            let reader = new FileReader();

            

            reader.onload = (e) =>

            { 

                // console.log(e);

                $('.image-preview').removeClass('d-none'); 

                $('.image-preview').attr('src', e.target.result); 

            }

            

            reader.readAsDataURL(this.files[0]); 

        }



        

    });



    $(document).on('click', '.delete-record', function(event) {

        var userID = $(this).attr('data-id');

        Swal.fire({

          title: 'Are you sure?',

          text: "You won't be able to revert this!",

          icon: 'info',

          showCancelButton: true,

          confirmButtonColor: '#3085d6',

          cancelButtonColor: '#d33',

          confirmButtonText: 'Yes, delete it!'

        }).then((result) => {

          if (result.value) {

             $.ajax({

            type : 'POST',

            url : site_url+'users/delete',

            dataType : 'JSON',

            data : {'userID' : userID},

            success : function(response){

                if (response.status == 1) {

                    Swal.fire(

                      'Deleted!',

                      'Your file has been deleted.',

                      'success'

                      )
                    setTimeout(function(){
                           $('#example1').DataTable().ajax.reload();
                   }, 1000);

                    }

                }

              })

      

          }

        })

      });





// ===================== Form Validation Start ==================================== //



//  User Signup Form using Jquery Validate.



$('#signupform').validate({ 



    errorClass: "error-class",

    validClass: "valid-class",

    errorElement: 'div',

    errorPlacement: function(error, element) {

        if(element.parent('.input-group').length) {

            error.insertAfter(element.parent());

        } else {

            error.insertAfter(element);

        }

    },

    onError : function(){

        $('.input-group.error-class').find('.help-block.form-error').each(function() {

          $(this).closest('.form-group').addClass('error-class').append($(this));

        });

    },

    rules: {

        'firstname' : {

            required: true

        },

        'lastname' : {

            required: true

        },

        'mobile_number' : {

            required: true,

            maxlength : 10,

            number:true,

        },

        'email' : {

            required: true,

            email : true

        },

        'password' : {

            required: true

        },

        'dob' : {

            required: true

        },

        'country' : {

            required: true

        },

        'state' : {

            required: true

        },

        'city' : {

            required: true

        }

    },

    messages: {

        'firstname' : {

             required: "Please enter your firstname.",

        },      

        'lastname' : {

             required: "Please enter your lastname.",

        }, 

        'email' : {

             required: "Please enter your email address.",

        }, 

        'password' : {

             required: "Please enter your password.",

        }, 

        'mobile' : {

             required  : "Please enter your mobile number.",

             number    : "Please enter only digits"

        }, 

        'dob' : {

             required: "Please enter your date of birth.",

        }, 

        'state' : {

             required: "Please select your state.",

        }, 

        'city' : {

             required: "Please select your city.",

        }, 

        'country' : {

             required: "Please select your country.",

        },      

    },

});



$('#updateform').validate({ 



    errorClass: "error-class",

    validClass: "valid-class",

    errorElement: 'div',

    errorPlacement: function(error, element) {

        if(element.parent('.input-group').length) {

            error.insertAfter(element.parent());

        } else {

            error.insertAfter(element);

        }

    },

    onError : function(){

        $('.input-group.error-class').find('.help-block.form-error').each(function() {

          $(this).closest('.form-group').addClass('error-class').append($(this));

        });

    },

    rules: {

        'firstname' : {

            required: true

        },

        'lastname' : {

            required: true

        },

        'mobile_number' : {

            required: true,

            maxlength : 10,

            number:true,

        },

        'email' : {

            required: true,

            email : true

        },

        'dob' : {

            required: true

        },

        'country' : {

            required: true

        },

        'state' : {

            required: true

        },

        'city' : {

            required: true

        }

    },

    messages: {

        'firstname' : {

             required: "Please enter your firstname.",

        },      

        'lastname' : {

             required: "Please enter your lastname.",

        }, 

        'email' : {

             required: "Please enter your email address.",

        }, 

        'mobile' : {

             required  : "Please enter your mobile number.",

             number    : "Please enter only digits"

        }, 

        'dob' : {

             required: "Please enter your date of birth.",

        }, 

        'state' : {

             required: "Please select your state.",

        }, 

        'city' : {

             required: "Please select your city.",

        }, 

        'country' : {

             required: "Please select your country.",

        },      

    },

});



//  User Login Form using Jquery validate.



$('#login-form').validate({ 

    errorClass: "error-class",

    validClass: "valid-class",

    errorElement: 'div',

    errorPlacement: function(error, element) {

        if(element.parent('.input-group').length) {

            error.insertAfter(element.parent());

        } else {

            error.insertAfter(element);

        }

    },

    onError : function(){

        $('.input-group.error-class').find('.help-block.form-error').each(function() {

          $(this).closest('.form-group').addClass('error-class').append($(this));

        });

    },

    rules: {

         

        'email' : {

            required: true,

            email : true

        },

        'password' : {

            required: true

        },

    },

    messages: {

        

        'email' : {

             required: "Please enter your email address.",

        }, 

        'password' : {

             required: "Please enter your Password.",

        }, 

    },

});





/**

 * Format date and time

 * @param time

 * @param format

 * @returns

 */

 function formatDate(time, format)

 {

         var t = new Date(time);

         var tf = function (i) { return (i < 10 ? '0' : '') + i };

 

         return format.replace(/yyyy|MM|dd|HH|mm|ss/g, function (a)

         {

             switch (a) {

                 case 'yyyy':

                     return tf(t.getFullYear());

                     break;

                 case 'MM':

                     return tf(t.getMonth() + 1);

                     break;

                 case 'mm':

                     return tf(t.getMinutes());

                     break;

                 case 'dd':

                     return tf(t.getDate());

                     break;

                 case 'HH':

                     return tf(t.getHours());

                     break;

                 case 'ss':

                     return tf(t.getSeconds());

                     break;

             }

         })

    //alert(format(new Date().getTime(), 'MM/dd/yyyy'))

 }

    

});

