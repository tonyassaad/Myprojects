/*
 
 * Created:        @tassaad    
 * Last Update:    @tassaad 
 */


$(function () {

    $('#sperform_domain_create_Form_Button').on("click", function () {
        window.sharedFunctions.submitForm($(this));
    });

    $('button[id$="_Button"]').on("click", function () {
        var id = $(this).attr("id").split("_");
        var formid = '';
        for(var i = 0; i < id.length - 1; i++) {
            formid += id[i] + "_";
        }
        var formData = $("form[id='" + formid + "Form']").serialize();
        var url = '/' + id[1] + '/' + id[2];
     
        if(!formData.match(/action=[A-Za-z0-9]+/)) {
        }
        ajax = new requestAjax();
        ajax.sendRequest("post", url, formData, formid + "Loader", formid + "Results", null, null, function (callback) {
            if(typeof callback.response.success != 'undefined') {
            
                window.location.reload();

            }
        });
    });

});
