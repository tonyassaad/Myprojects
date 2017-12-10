/*

 * Created:        @tassaad  
 * Last Update:    @tassaad  
 */
var imagespath = '../img/ajax-loader.gif';
function requestAjax() {
    this.dataset = null;
    this.sendRequest = function (methodParam, urlParam, dataParam, loadingId, contentId, datatype, options, callback) {

        if(datatype == 1) {
            datatype = 'html';
        }
        if(datatype == 2) {
            datatype = 'xml';
        }
        if(!datatype) {
            datatype = 'json';
        }

        $.ajax({type: methodParam,
            url: urlParam,
            data: dataParam,
            headers: {
                'X-CSRF-TOKEN': $(document).find('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                $("div[id='" + loadingId + "'],span[id='" + loadingId + "']").html("<img style='padding: 5px;' src='/img/Spinner.gif'' border='0' />");
                $("div[id='" + loadingId + "']").show();
            },
            complete: function () {
                if(loadingId != contentId) {
                    $("#" + loadingId).hide();
                }
                //$("div[id='" + contentId + "'],span[id='" + contentId + "']").html('<span class="success inline m-l-md"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;</span>');
            },
            error: function (error, thrown, response) {
 
            },
            success: function (returnedData) {
                this.dataset = returnedData;
                $("#" + contentId).empty();
                if(datatype == 'json') {

                    if(typeof returnedData.response != 'undefined') {

                        if(typeof returnedData.response.error != 'undefined') {
                            ///$("#" + contentId).html($.trim(returnedData.response.error));
                            $("div[id='" + contentId + "'],span[id='" + contentId + "']").html('<span class="error inline m-l-md"><i class="fa fa-ban"></i>&nbsp;&nbsp;' + returnedData.response.error + '</span>');
                        } else if(returnedData.response.success != null) {
                            $("div[id='" + contentId + "'],span[id='" + contentId + "']").html('<span class="success inline m-l-md"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;' + returnedData.response.success + '</span>');
                            //$("#" + contentId).html($.trim(returnedData.response.success));
                        } else {
                            $("div[id='" + loadingId + "']").hide();
                            $("#" + contentId).html($.trim(returnedData.response));
                        }
                    }
                } else
                {
                    $("#" + contentId).html($.trim(returnedData));
                }
                if(typeof callback === 'function') {
                    callback(returnedData);
                }

                if(dataParam.redirect) {
                    //window.location.href = dataParam.redirect;
                }

            },

            dataType: datatype
        });
    }
    this.getReturnedData = function () {
        return 'dataset' + this.dataset;
    }
}
