/*

 * [Provide Short Descption Here]
 * $id: menu.js
 * Created:        @tassaad   
 * Last Update:    @tassaad
 */


$(function () {
    /*Create global functions to be used across the Application*/
    window.sharedFunctions = function () {

        function goToUrl(url)
        {
            if(url != '')
            {

                if(!window.location)
                {
                    document.location = url;
                } else
                {
                    window.location = url;
                }
            }
        }

        function submitForm(object) {
            var id = object.attr("id").split("_");
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
                    if($('#' + id[2] + '_modal').length > 0) {
                        setTimeout(function () {
                            $('#' + id[2] + '_modal').modal('hide');
                            window.location.reload();
                        }, 1500);
                    }
                    window.location.reload();

                }
            });
        }

        return {
            "goToUrl": goToUrl,
            "submitForm": submitForm
        }
    }();




});