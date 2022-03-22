




$(function(){

    $(document).on('keydown','form#form',function(e){
    if(e.keyCode==13){
      e.preventDefault();
      return false;
    
    }
    })
    
    
    $('body').on('submit','form#formData',function(event){
        // alert();
         event.preventDefault();
           $('form#formData input[type=submit').val('PLEASE WAIT...').attr('disabled',true);
  var form = $(this);
 form.find('.form-group').removeClass('has-error');
 form.find('.help-block').remove();
 $.ajax({
     url: form.attr('action'),
       type: "POST",             // Type of request to be send, called as method
       data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
       contentType: false,       // The content type used when sending data to the server.
       cache: false,             // To unable request pages to be cached
       processData:false,
 
 
     success:function(data){
            //$('#modalForm').modal('hide');
         // window.location.reload();
 window.location.href=data.redirect;
                  
                // $('#modalForm').find('#modal_body').html("<div style=\"text-align:center\"><span class=\"fa fa-spinner fa-spin\" style=\"font-size:30px;\"></span></div>");           
                // setTimeout(function() { $('#modalForm').modal('hide'); }, 500);
 
                // window.location.reload();
 
     },
     error:function (response) {
         var errors = response.responseJSON;
         if($.isEmptyObject(errors)==false){
             $.each(errors,function (key,value) {
                 $('#'+key).closest('.form-group')
                     .addClass('has-error')
                     .append('<span class="help-block">'+value+'</span>');
             });
         }
  $('form#formData input[type=submit').val('Try Again').attr('disabled',false);

     },
    //  $('form#form input[type=submit').val('Try Again').attr('disabled',false);

 });
 
   
 
 
 
     });

    
        $(document).on('click','.show_modal',function(event){
            //alert();
            event.preventDefault();
            var url = $(this).attr('data-href'),
             method=$(this).attr('method'),
             title = $(this).attr('title');
             $.get(url,function(data){
                 $('#title').text(title);
                 $('#modal_body').html(data);
    
                  $('select').select2();
              
              
    //  $('.datetime').datetimepicker({
    //     weekStart: 1,
    //     todayBtn:  true,
    //     autoclose: true,
    //     todayHighlight: true,
    //     format: "dd M, yyyy hh:ii",
    //    // showMeridian: 1
    // });
  $('.date').datepicker({
        weekStart: 1,
       // todayBtn:  true,
        autoclose: true,
        todayHighlight: true,
        minView: 2,
        format: "dd/mm/yyyy",
    });

     
             });
    
         });
    
         
    
         $(document).on('click','.show_remark_modal',function(event){
            //alert();
            event.preventDefault();
            var url = $(this).attr('data-href'),
             //method=$(this).attr('method'),
             title = $(this).attr('title');
             $.get(url,function(data){
                 $('#remark_title').text(title);
                 $('#remark_body').html(data);
    
                  //$('.bs-select').selectpicker();
             });
    
         });
    
    
    

     



    //function post_form(el){
    

        $('body').on('submit','form#remark_form',function(event){
            // alert();
             event.preventDefault();
      var form = $(this);
     form.find('.form-group').removeClass('has-error');
     form.find('.help-block').remove();
     $.ajax({
         url: form.attr('action'),
           type: "POST",             // Type of request to be send, called as method
           data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
           contentType: false,       // The content type used when sending data to the server.
           cache: false,             // To unable request pages to be cached
           processData:false,
         success:function(data){
                //$('#modalForm').modal('hide');
     
             setTimeout(function() { $('#remarkForm').modal('hide'); }, 500);
          $('#remarkForm').find('#remark_body').html("<div style=\"text-align:center\"><span class=\"fa fa-spinner fa-spin\" style=\"font-size:30px;\"></span></div>"); 
          $('select#remark_id').append('<option value="' + data.id + '" selected="selected">' + data.name + '</option>').trigger('change.select2');
          
             $('#remarkForm').modal('hide');
     
         },
         error:function (response) {
             var errors = response.responseJSON;
             if($.isEmptyObject(errors)==false){
                 $.each(errors,function (key,value) {
                     $('#'+key).closest('.form-group')
                         .addClass('has-error')
                         .append('<span class="help-block">'+value+'</span>');
                 });
             }
     
         },
     });
     
       
     
     
     
         });



        $('body').on('submit','form#container_external',function(event){
            // alert();
             event.preventDefault();
      var form = $(this);
     form.find('.form-group').removeClass('has-error');
     form.find('.help-block').remove();
     $.ajax({
         url: form.attr('action'),
           type: "POST",             // Type of request to be send, called as method
           data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
           contentType: false,       // The content type used when sending data to the server.
           cache: false,             // To unable request pages to be cached
           processData:false,
         success:function(data){
                //$('#modalForm').modal('hide');
     
             setTimeout(function() { $('#modalForm').modal('hide'); }, 500);
        //  $('#remarkForm').find('#remark_body').html("<div style=\"text-align:center\"><span class=\"fa fa-spinner fa-spin\" style=\"font-size:30px;\"></span></div>"); 
          $('select#container_id').append('<option value="' + data.id + '" selected="selected">' + data.container_no + '</option>').trigger('change.select2');
          
             $('#modalForm').modal('hide');
     
         },
         error:function (response) {
             var errors = response.responseJSON;
             if($.isEmptyObject(errors)==false){
                 $.each(errors,function (key,value) {
                     $('#'+key).closest('.form-group')
                         .addClass('has-error')
                         .append('<span class="help-block">'+value+'</span>');
                 });
             }
     
         },
     });
     
       
     
     
     
         });


    
        $(document).on('submit','form#client_form',function(event){
            event.preventDefault();
     var form = $(this);
    form.find('.form-group').removeClass('has-error');
    form.find('.help-block').remove();
    $.ajax({
        url: form.attr('action'),
          type: "POST",             // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,
        success:function(data){
            //$('#client_id').append('<option value="' + data.id + '" selected="selected">' + data.consignee + '</option>');.selectpicker('refresh');
            $('select#client_id').append('<option value="' + data.id + '" selected="selected">' + data.name + '</option>').trigger('change.select2');;
                    
                    $('#modalForm').modal('hide');
                    //window.location.reload();
    
        },
        error:function (response) {
            var errors = response.responseJSON;
            if($.isEmptyObject(errors)==false){
                $.each(errors,function (key,value) {
                    $('#'+key).closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block">'+value+'</span>');
                });
            }
    
        },
    });
    
        });
    
    //wagons
      $(document).on('submit','form#wagon_form',function(event){
            event.preventDefault();
     var form = $(this);
    form.find('.form-group').removeClass('has-error');
    form.find('.help-block').remove();
    $.ajax({
        url: form.attr('action'),
          type: "POST",             // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,
        success:function(data){
            //$('#client_id').append('<option value="' + data.id + '" selected="selected">' + data.consignee + '</option>');.selectpicker('refresh');
            $('select#wagon_id').append('<option value="' + data.id + '" selected="selected">' + data.wagon_number + '</option>').trigger('change.select2');;
                    
                   $('#modalForm').modal('hide');
                    //window.location.reload();
    
        },
        error:function (response) {
            var errors = response.responseJSON;
            if($.isEmptyObject(errors)==false){
                $.each(errors,function (key,value) {
                    $('#'+key).closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block">'+value+'</span>');
                });
            }
    
        },
    });
    
        });
    
    
    
    
        $(document).on('submit','form#location_form',function(event){
            event.preventDefault();
     var form = $(this);
    form.find('.form-group').removeClass('has-error');
    form.find('.help-block').remove();
    $.ajax({
        url: form.attr('action'),
          type: "POST",             // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,
        success:function(data){
            //$('#client_id').append('<option value="' + data.id + '" selected="selected">' + data.consignee + '</option>');.selectpicker('refresh');
            $('select#container_location_id').append('<option value="' + data.id + '" selected="selected">' + data.name + '</option>').trigger('change.select2');;
                    
                    $('#modalForm').modal('hide');
                    //window.location.reload();
    
        },
        error:function (response) {
            var errors = response.responseJSON;
            if($.isEmptyObject(errors)==false){
                $.each(errors,function (key,value) {
                    $('#'+key).closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block">'+value+'</span>');
                });
            }
    
        },
    });
    
        });
        
    

        
        
        $(document).on('submit','form#clearing_agent_form',function(event){
            event.preventDefault();
     var form = $(this);
    form.find('.form-group').removeClass('has-error');
    form.find('.help-block').remove();
    $.ajax({
        url: form.attr('action'),
          type: "POST",             // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,
        success:function(data){
            //$('#client_id').append('<option value="' + data.id + '" selected="selected">' + data.consignee + '</option>');.selectpicker('refresh');
            $('select#clearing_agent_id').append('<option value="' + data.id + '" selected="selected">' + data.agent_name + '</option>').trigger('change.select2');;
                    
                  $('#modalForm').modal('hide');
                    //window.location.reload();
    
        },
        error:function (response) {
            var errors = response.responseJSON;
            if($.isEmptyObject(errors)==false){
                $.each(errors,function (key,value) {
                    $('#'+key).closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block">'+value+'</span>');
                });
            }
    
        },
    });
    
        });


        // $("button[data-number=1]").click(function(){
        //     $('#modalForm').modal('hide');
        // });
        
        // $("button[data-number=2]").click(function(){
        //     $('#remarkForm').modal('hide');
        // });


        // $(document).ready(function () {

        //     // $('#openBtn').click(function () {
        //     //     $('#myModal').modal({
        //     //         show: true
        //     //     })
        //     // });
        
        //         // $(document).on('show.bs.modal', '.modal', function (event) {
        //         //     var zIndex = 1040 + (10 * $('.modal:visible').length);
        //         //     $(this).css('z-index', zIndex);
        //         //     setTimeout(function() {
        //         //         $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        //         //     }, 0);
        //         // });
        
        
        // });


        $(document).on('submit','form#clearing_officer_form',function(event){
            event.preventDefault();
     var form = $(this);
    form.find('.form-group').removeClass('has-error');
    form.find('.help-block').remove();
    $.ajax({
        url: form.attr('action'),
          type: "POST",             // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,
        success:function(data){
            //$('#client_id').append('<option value="' + data.id + '" selected="selected">' + data.consignee + '</option>');.selectpicker('refresh');
            $('select#clearing_officer_id').append('<option value="' + data.id + '" selected="selected">' + data.officer_name + '</option>').trigger('change.select2');;
                    
                  $('#modalForm').modal('hide');
                    //window.location.reload();
    
        },
        error:function (response) {
            var errors = response.responseJSON;
            if($.isEmptyObject(errors)==false){
                $.each(errors,function (key,value) {
                    $('#'+key).closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block">'+value+'</span>');
                });
            }
    
        },
    });
    
        });
    
        $(document).on('submit','form#vessel_form',function(event){
            event.preventDefault();
     var form = $(this);
    form.find('.form-group').removeClass('has-error');
    form.find('.help-block').remove();
    $.ajax({
        url: form.attr('action'),
          type: "POST",             // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,
        success:function(data){
            //$('#client_id').append('<option value="' + data.id + '" selected="selected">' + data.consignee + '</option>');.selectpicker('refresh');
            $('select#vessel_id').append('<option value="' + data.id + '" selected="selected">' + data.vessel_name + '</option>').trigger('change.select2');;
                    
                  $('#modalForm').modal('hide');
                    //window.location.reload();
    
        },
        error:function (response) {
            var errors = response.responseJSON;
            if($.isEmptyObject(errors)==false){
                $.each(errors,function (key,value) {
                    $('#'+key).closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block">'+value+'</span>');
                });
            }
    
        },
    });
    
        });
        $(document).on('submit','form#exporter_form',function(event){
            event.preventDefault();
     var form = $(this);
    form.find('.form-group').removeClass('has-error');
    form.find('.help-block').remove();
    $.ajax({
        url: form.attr('action'),
          type: "POST",             // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,
        success:function(data){
            //$('#client_id').append('<option value="' + data.id + '" selected="selected">' + data.consignee + '</option>');.selectpicker('refresh');
            $('select#exporter_id').append('<option value="' + data.id + '" selected="selected">' + data.exporter_name + '</option>').trigger('change.select2');;
                    
                  $('#modalForm').modal('hide');
                    //window.location.reload();
    
        },
        error:function (response) {
            var errors = response.responseJSON;
            if($.isEmptyObject(errors)==false){
                $.each(errors,function (key,value) {
                    $('#'+key).closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block">'+value+'</span>');
                });
            }
    
        },
    });
    
        });
    
        $(document).on('submit','form#port_of_loading_form',function(event){
            event.preventDefault();
     var form = $(this);
    form.find('.form-group').removeClass('has-error');
    form.find('.help-block').remove();
    $.ajax({
        url: form.attr('action'),
          type: "POST",             // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,
        success:function(data){
            //$('#client_id').append('<option value="' + data.id + '" selected="selected">' + data.consignee + '</option>');.selectpicker('refresh');
            $('select#port_of_loading_id').append('<option value="' + data.id + '" selected="selected">' + data.name + '</option>').trigger('change.select2');;
                    
           //    $('#modalForm').modal('hide');
                    //window.location.reload();
    
                     $('#modalForm').find('#modal_body').html("<div style=\"text-align:center\"><span class=\"fa fa-spinner fa-spin\" style=\"font-size:30px;\"></span></div>");           
                    setTimeout(function() { $('#modalForm').modal('hide'); }, 500);
    
        },
        error:function (response) {
            var errors = response.responseJSON;
            if($.isEmptyObject(errors)==false){
                $.each(errors,function (key,value) {
                    $('#'+key).closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block">'+value+'</span>');
                });
            }
    
        },
    });
    
        });


        $(document).on('submit','form#shipper_form',function(event){
            event.preventDefault();
     var form = $(this);
    form.find('.form-group').removeClass('has-error');
    form.find('.help-block').remove();
    $.ajax({
        url: form.attr('action'),
          type: "POST",             // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,
        success:function(data){
            //$('#client_id').append('<option value="' + data.id + '" selected="selected">' + data.consignee + '</option>');.selectpicker('refresh');
        $('select#shipper_id').append('<option value="' + data.id + '" selected="selected">' + data.name + '</option>').trigger('change.select2');;
                    
           //    $('#modalForm').modal('hide');
                    //window.location.reload();
    
                     $('#modalForm').find('#modal_body').html("<div style=\"text-align:center\"><span class=\"fa fa-spinner fa-spin\" style=\"font-size:30px;\"></span></div>");           
                    setTimeout(function() { $('#modalForm').modal('hide'); }, 500);
    
        },
        error:function (response) {
            var errors = response.responseJSON;
            if($.isEmptyObject(errors)==false){
                $.each(errors,function (key,value) {
                    $('#'+key).closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block">'+value+'</span>');
                });
            }
    
        },
    });
    
        });
    



    
        $(document).on('submit','form#destination_form',function(event){
            event.preventDefault();
     var form = $(this);
    form.find('.form-group').removeClass('has-error');
    form.find('.help-block').remove();
    $.ajax({
        url: form.attr('action'),
          type: "POST",             // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,
        success:function(data){
            //$('#client_id').append('<option value="' + data.id + '" selected="selected">' + data.consignee + '</option>');.selectpicker('refresh');
            $('select#destination_id').append('<option value="' + data.id + '" selected="selected">' + data.name + '</option>').trigger('change.select2');;
                    
                   $('#modalForm').modal('hide');
                    //window.location.reload();
    
        },
        error:function (response) {
            var errors = response.responseJSON;
            if($.isEmptyObject(errors)==false){
                $.each(errors,function (key,value) {
                    $('#'+key).closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block">'+value+'</span>');
                });
            }
    
        },
    });
    
        });
        $(document).on('submit','form#shipping_line_form',function(event){
            event.preventDefault();
     var form = $(this);
    form.find('.form-group').removeClass('has-error');
    form.find('.help-block').remove();
    $.ajax({
        url: form.attr('action'),
          type: "POST",             // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,
        success:function(data){
            //$('#client_id').append('<option value="' + data.id + '" selected="selected">' + data.consignee + '</option>');.selectpicker('refresh');
            $('select#shipping_line_id').append('<option value="' + data.id + '" selected="selected">'  + data.name + '</option>').trigger('change.select2');;
                    
                   $('#modalForm').modal('hide');
                    //window.location.reload();
    
        },
        error:function (response) {
            var errors = response.responseJSON;
            if($.isEmptyObject(errors)==false){
                $.each(errors,function (key,value) {
                    $('#'+key).closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block">'+value+'</span>');
                });
            }
    
        },
    });
    
        });
    

        $(document).on('submit','form#shipping_agent_form',function(event){
            event.preventDefault();
     var form = $(this);
    form.find('.form-group').removeClass('has-error');
    form.find('.help-block').remove();
    $.ajax({
        url: form.attr('action'),
          type: "POST",             // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,
        success:function(data){
            //$('#client_id').append('<option value="' + data.id + '" selected="selected">' + data.consignee + '</option>');.selectpicker('refresh');
            $('select#shipping_agent_id').append('<option value="' + data.id + '" selected="selected">'  + data.name + '</option>').trigger('change.select2');;
                    
                   $('#modalForm').modal('hide');
                    //window.location.reload();
    
        },
        error:function (response) {
            var errors = response.responseJSON;
            if($.isEmptyObject(errors)==false){
                $.each(errors,function (key,value) {
                    $('#'+key).closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block">'+value+'</span>');
                });
            }
    
        },
    });
    
        });


    
    
    
        
        $('body').on('submit','form#attachment_form',function(event){
            event.preventDefault();
     var form = $(this);
    form.find('.form-group').removeClass('has-error');
    form.find('.help-block').remove();
    $.ajax({
        url: form.attr('action'),
          type: "POST",             // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,
        success:function(data){
     $('#modalForm').find('#modal_body').html("<div style=\"text-align:center\"><span class=\"fa fa-spinner fa-spin\" style=\"font-size:30px;\"></span></div>");           
                    setTimeout(function() { $('#modalForm').modal('hide'); }, 500);
          window.location.reload();
    
    
    
        },
        error:function (response) {
            var errors = response.responseJSON;
            if($.isEmptyObject(errors)==false){
                $.each(errors,function (key,value) {
                    $('#'+key).closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block">'+value+'</span>');
                });
            }
    
        },
    });
    
        });
    
        $(document).on('submit','form#delete_attachment_form',function(event){
            event.preventDefault();
     var form = $(this);
    
    $.ajax({
        url: form.attr('action'),
          type: form.attr('method'),             // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,
        success:function(data){
    
          // $('#modalForm').modal('hide');
           //$('#attachments_tab').attr('class','active');
    
            $('#modalForm').find('#modal_body').html("<div style=\"text-align:center\"><span class=\"fa fa-spinner fa-spin\" style=\"font-size:30px;\"></span></div>");           
                    setTimeout(function() { $('#modalForm').modal('hide'); }, 500);
    
          window.location.reload();
    
    
        },
        error:function (response) {
    
    
        },
    });
    
        });
    
    
    
    
        $(document).on('submit','form#driver_form',function(event){
            event.preventDefault();
     var form = $(this);
    form.find('.form-group').removeClass('has-error');
    form.find('.help-block').remove();
    $.ajax({
        url: form.attr('action'),
          type: "POST",             // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,
        success:function(data){
            //$('#client_id').append('<option value="' + data.id + '" selected="selected">' + data.consignee + '</option>');.selectpicker('refresh');
            $('select#driver_id').append('<option value="' + data.id + '" selected="selected">' + data.name + '</option>').trigger('change.select2');;
                    
                  //  $('#modalForm').modal('hide');
                    //window.location.reload();
    
                     $('#modalForm').find('#modal_body').html("<div style=\"text-align:center\"><span class=\"fa fa-spinner fa-spin\" style=\"font-size:30px;\"></span></div>");           
                    setTimeout(function() { $('#modalForm').modal('hide'); }, 500);
    
        },
        error:function (response) {
            var errors = response.responseJSON;
            if($.isEmptyObject(errors)==false){
                $.each(errors,function (key,value) {
                    $('#'+key).closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block">'+value+'</span>');
                });
            }
    
        },
    });
    
        });
    
        $(document).on('submit','form#trailer_form',function(event){
            event.preventDefault();
     var form = $(this);
    form.find('.form-group').removeClass('has-error');
    form.find('.help-block').remove();
    $.ajax({
        url: form.attr('action'),
          type: "POST",             // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,
        success:function(data){
            //$('#client_id').append('<option value="' + data.id + '" selected="selected">' + data.consignee + '</option>');.selectpicker('refresh');
            $('select#trailer_id').append('<option value="' + data.id + '" selected="selected">' + data.trailer_number + '</option>').trigger('change.select2');;
                    
                  // $('#modalForm').modal('hide');
                    //window.location.reload();
    
                     $('#modalForm').find('#modal_body').html("<div style=\"text-align:center\"><span class=\"fa fa-spinner fa-spin\" style=\"font-size:30px;\"></span></div>");           
                    setTimeout(function() { $('#modalForm').modal('hide'); }, 500);
    
        },
        error:function (response) {
            var errors = response.responseJSON;
            if($.isEmptyObject(errors)==false){
                $.each(errors,function (key,value) {
                    $('#'+key).closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block">'+value+'</span>');
                });
            }
    
        },
    });
    
        });





        $(document).on('submit','form#transporter_form',function(event){
            event.preventDefault();
     var form = $(this);
    form.find('.form-group').removeClass('has-error');
    form.find('.help-block').remove();
    $.ajax({
        url: form.attr('action'),
          type: "POST",             // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,
        success:function(data){
            //$('#client_id').append('<option value="' + data.id + '" selected="selected">' + data.consignee + '</option>');.selectpicker('refresh');
            $('select#transporter_id').append('<option value="' + data.id + '" selected="selected">' + data.name + '</option>').trigger('change.select2');;
                    
                  // $('#modalForm').modal('hide');
                    //window.location.reload();
    
                     $('#modalForm').find('#modal_body').html("<div style=\"text-align:center\"><span class=\"fa fa-spinner fa-spin\" style=\"font-size:30px;\"></span></div>");           
                    setTimeout(function() { $('#modalForm').modal('hide'); }, 500);
    
        },
        error:function (response) {
            var errors = response.responseJSON;
            if($.isEmptyObject(errors)==false){
                $.each(errors,function (key,value) {
                    $('#'+key).closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block">'+value+'</span>');
                });
            }
    
        },
    });
    
        });
        $(document).on('submit','form#consignee_form',function(event){
            event.preventDefault();
     var form = $(this);
    form.find('.form-group').removeClass('has-error');
    form.find('.help-block').remove();
    $.ajax({
        url: form.attr('action'),
          type: "POST",             // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,
        success:function(data){
            //$('#client_id').append('<option value="' + data.id + '" selected="selected">' + data.consignee + '</option>');.selectpicker('refresh');
            $('select#consignee_id').append('<option value="' + data.id + '" selected="selected">' + data.name + '</option>').trigger('change.select2');;
                    
                  // $('#modalForm').modal('hide');
                    //window.location.reload();
    
                     $('#modalForm').find('#modal_body').html("<div style=\"text-align:center\"><span class=\"fa fa-spinner fa-spin\" style=\"font-size:30px;\"></span></div>");           
                    setTimeout(function() { $('#modalForm').modal('hide'); }, 500);
    
        },
        error:function (response) {
            var errors = response.responseJSON;
            if($.isEmptyObject(errors)==false){
                $.each(errors,function (key,value) {
                    $('#'+key).closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block">'+value+'</span>');
                });
            }
    
        },
    });
    
        });

        $(document).on('submit','form#horse_form',function(event){
            event.preventDefault();
     var form = $(this);
    form.find('.form-group').removeClass('has-error');
    form.find('.help-block').remove();
    $.ajax({
        url: form.attr('action'),
          type: "POST",             // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,
        success:function(data){
            //$('#client_id').append('<option value="' + data.id + '" selected="selected">' + data.consignee + '</option>');.selectpicker('refresh');
            $('select#horse_id').append('<option value="' + data.id + '" selected="selected">' + data.horse_number + '</option>').trigger('change.select2');;
                    
                   // $('#modalForm').modal('hide');
                    //window.location.reload();
    
                     $('#modalForm').find('#modal_body').html("<div style=\"text-align:center\"><span class=\"fa fa-spinner fa-spin\" style=\"font-size:30px;\"></span></div>");           
                    setTimeout(function() { $('#modalForm').modal('hide'); }, 500);
    
    
    
        },
        error:function (response) {
            var errors = response.responseJSON;
            if($.isEmptyObject(errors)==false){
                $.each(errors,function (key,value) {
                    $('#'+key).closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block">'+value+'</span>');
                });
            }
    
        },
    });
    
        });
    
        $('body').on('submit','form#form',function(event){
           // alert();
            event.preventDefault();
    
            $('form#form input[type=submit').val('PLEASE WAIT...').attr('disabled',true);
     var form = $(this);
    form.find('.form-group').removeClass('has-error');
    form.find('.help-block').remove();
    $.ajax({
        url: form.attr('action'),
          type: "POST",             // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,
    
    
        success:function(data){
               //$('#modalForm').modal('hide');
            // window.location.reload();
    
                     
                   $('#modalForm').find('#modal_body').html("<div style=\"text-align:center\"><span class=\"fa fa-spinner fa-spin\" style=\"font-size:30px;\"></span></div>");           
                  setTimeout(function() { $('#modalForm').modal('hide'); }, 500);
    
                    window.location.reload();
    
        },
        error:function (response) {
            var errors = response.responseJSON;
            if($.isEmptyObject(errors)==false){
                $.each(errors,function (key,value) {
                    $('#'+key).closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block">'+value+'</span>');
                });
            }
    
            $('form#form input[type=submit').val('Try Again').attr('disabled',false);
    
        },
    });
    
      
    
    
    
        });
    
    
    $('body').on('submit','form#testing',function(event){
           // alert();
            event.preventDefault();
     var form = $(this);
    form.find('.form-group').removeClass('has-error');
    form.find('.help-block').remove();
    $.ajax({
        url: form.attr('action'),
          type: "POST",             // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,
    
    
        success:function(data){
               //$('#modalForm').modal('hide');
            // window.location.reload();
    //window.location.href=data.redirect;
                     
                   // $('#modalForm').find('#modal_body').html("<div style=\"text-align:center\"><span class=\"fa fa-spinner fa-spin\" style=\"font-size:30px;\"></span></div>");           
                   // setTimeout(function() { $('#modalForm').modal('hide'); }, 500);
    
                   // window.location.reload();
    
        },
        error:function (response) {
            var errors = response.responseJSON;
            if($.isEmptyObject(errors)==false){
                $.each(errors,function (key,value) {
                    $('#'+key).closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block">'+value+'</span>');
                });
            }
    
        },
    });
    
      
    
    
    
        });
    
    

        $('body').on('submit','form#invoice',function(event){
           // alert();
            event.preventDefault();
              $('form#invoice input[type=submit').val('PLEASE WAIT...').attr('disabled',true);
     var form = $(this);
    form.find('.form-group').removeClass('has-error');
    form.find('.help-block').remove();
    $.ajax({
        url: form.attr('action'),
          type: "POST",             // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,
    
    
        success:function(data){
               //$('#modalForm').modal('hide');
            // window.location.reload();
    window.location.href=data.redirect;
                     
                   // $('#modalForm').find('#modal_body').html("<div style=\"text-align:center\"><span class=\"fa fa-spinner fa-spin\" style=\"font-size:30px;\"></span></div>");           
                   // setTimeout(function() { $('#modalForm').modal('hide'); }, 500);
    
                   // window.location.reload();
    
        },
        error:function (response) {
            var errors = response.responseJSON;
            if($.isEmptyObject(errors)==false){
                $.each(errors,function (key,value) {
                    $('#'+key).closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block">'+value+'</span>');
                });
            }
     $('form#invoice input[type=submit').val('Try Again').attr('disabled',false);

        },
       //  $('form#form input[type=submit').val('Try Again').attr('disabled',false);

    });
    
      
    
    
    
        });


    
    $(document).on('submit','form#vessel_information_form',function(event){
            event.preventDefault();
     var form = $(this);
    form.find('.form-group').removeClass('has-error');
    form.find('.help-block').remove();
    $.ajax({
        url: form.attr('action'),
          type: "POST",             // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,
    
    
        success:function(data){
            //$('#client_id').append('<option value="' + data.id + '" selected="selected">' + data.consignee + '</option>');.selectpicker('refresh');
           
    $('#modalForm').find('#modal_body').html("<div style=\"text-align:center\"><span class=\"fa fa-spinner fa-spin\" style=\"font-size:30px;\"></span></div>");           
                   
    
            $('select#vessel_information_id').append('<option value="' + data.id + '" selected="selected">' + data.name + '</option>').trigger('change.select2');;
                    
                setTimeout(function() { $('#modalForm').modal('hide'); }, 500);
    
         
        },
        error:function (response) {
            var errors = response.responseJSON;
            if($.isEmptyObject(errors)==false){
                $.each(errors,function (key,value) {
                    $('#'+key).closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block">'+value+'</span>');
                });
            }
    
        },
    });
    
        });
    
    
    
    
    $('body').on('submit','form#container_form',function(event){
           // alert();
            event.preventDefault();
     var form = $(this);
    form.find('.form-group').removeClass('has-error');
    form.find('.help-block').remove();
    $.ajax({
        url: form.attr('action'),
          type: "POST",             // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,
        success:function(data){
               //$('#modalForm').modal('hide');
    
            setTimeout(function() { $('#containerForm').modal('hide'); }, 500);
         $('#containerForm').find('#container_modal_body').html("<div style=\"text-align:center\"><span class=\"fa fa-spinner fa-spin\" style=\"font-size:30px;\"></span></div>");           
            $('#containerForm').modal('hide');
    
        },
        error:function (response) {
            var errors = response.responseJSON;
            if($.isEmptyObject(errors)==false){
                $.each(errors,function (key,value) {
                    $('#'+key).closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block">'+value+'</span>');
                });
            }
    
        },
    });
    
      
    
    
    
        });
    
    
        });
    