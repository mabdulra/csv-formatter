$(document).ready(function(){
    //  If there is no CSV file on load, disable the submit button
    if( $("#csvFile").val()=='' ){
        $("#submit").attr('disabled',true);
    }
    
    //  When a CSV file is provided, enable the submit button
    $("#csvFile").on('change',function(){
        $("#submit").attr('disabled',false);
    });
    
    //  AJAX call to upload the CSV file to the server
    $("#submission").submit(function(e){
        var formURL     = $(this).attr("action");
        var formData    = new FormData(this);
        
        $.ajax({
            url:            formURL,
            type:           "POST",
            data:           formData,
            
            mimeType:       "multipart/form-data",
            contentType:    false,
            cache:          false,
            processData:    false,
            
            success: function( response ){
                //  Print results in empty div
                $("#results").html(response);
                
                //  Refresh the form
                $("#submission").get(0).reset();
                
                //  Disable the submit button
                $("#submit").attr('disabled',true);
            }
        });
        
        //  Disable default submission of form
        e.preventDefault();
        e.unbind();
    });
});