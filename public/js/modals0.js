$(function(){


    $(document).on('click','.show_modal',function(event){
        //alert();
        event.preventDefault();
        var url = $(this).attr('data-href'),
         method=$(this).attr('method'),
         title = $(this).attr('title');
         $.get(url,function(data){
             $('#title').text(title);
             $('#modal_body').html(data);
         });

     });


//function post_form(el){


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
        $('select#clearing_agent_id').append('<option value="' + data.id + '" selected="selected">' + data.name + '</option>').trigger('change.select2');;
                
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
        $('select#vessel_id').append('<option value="' + data.id + '" selected="selected">' + data.name + '</option>').trigger('change.select2');;
                
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
        $('select#exporter_id').append('<option value="' + data.id + '" selected="selected">' + data.name + '</option>').trigger('change.select2');;
                
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
        $('select#shipping_line_id').append('<option value="' + data.id + '" selected="selected">' + data.name + '</option>').trigger('change.select2');;
                
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

       $('#modalForm').modal('hide');
       //$('#attachments_tab').attr('class','active');

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
                
               // $('#modalForm').modal('hide');
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
        $('select#transporter_id').append('<option value="' + data.id + '" selected="selected">' + data.transporter_name + '</option>').trigger('change.select2');;
                
               // $('#modalForm').modal('hide');
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
               // $('#modal').modal('hide');
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


    });
