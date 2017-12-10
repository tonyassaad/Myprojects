/*
 * Copyright © 2017 NyCard S.A.R.L, All Rights Reserved
 *
 * [Nymcard Admin Panel]
 * $id: main.js
 * Created:        @tassaad    Apr 13, 2017 | 4:26:36 PM
 * Last Update:    @tassaad    Apr 13, 2017 | 4:26:36 PM
 */
$(function () {
    $("#perform_dologin_Button").on('click', function (e) {
        var id = $(this).attr("id").split("_");
        var form_id = '';
        form_id += id[0] + "_" + id[1] + "_Form";
        // $(this).attr("disabled",true);
        form_data = $("form[id='" + form_id + "']").serialize();
        login();
    })

    sharedFunctions.showHidePassword();

    function login() {
        ajax = new requestAjax();
        ajax.sendRequest("post", '/login/doLogin', form_data, "perform_dologin_" + "Loader", "perform_dologin_" + "Results", null, null
                , function (callback) {
                    //send firebasetoken to the FireBaseSDK
                    var data = {
                        'firebase_token': callback.firebase_token
                    };
                    if(callback.response == 'Connection Error') {
                    }
                    if(typeof callback.firebase_token != 'undefined') {
                        //callback to get AccessToken
                        firebase_sdk = new firebaseSdk(data.firebase_token);
                        firebase_sdk.siginWithToken();
                        firebase_sdk.initApp(function (callback_data) {
                            /*push back the id token to server side*/
                            data["user_data"] = callback_data;
                            console.log('Firebase data : ' + callback_data);
                            ajax.sendRequest("post", '/sendtoken', data, null, null, null, null, null, function (callback) {
                            });
                        })
                        setTimeout(function () {
                            sharedFunctions.goToUrl($("#referer").val());
                        }, 1500);
                    }
                });
    }

    $("button[id$='_LoginButton']").click(function (e) {
        initiateAuthFlow($(this));
    })
    function loginWithFirebaseToken() {

    }

    function initiateAuthFlow(object) {
        var id = object.attr("id").split("_");
        form_id = id[0] + "_" + id[1] + "_" + id[2] + "_Form";
        form_data = $("form[id='" + form_id + "']").serialize();
        ajax = new requestAjax();
        var url = '/' + id[1] + '/' + id[2];

        ajax.sendRequest("post", url, form_data, id[0] + "_" + id[1] + "_" + id[2] + "_Loader", id[0] + "_" + id[1] + "_" + id[2] + "_Results", null, null, function (callback) {
            //send firebasetoken to the FireBaseSDK
            if(typeof callback.firebase_token != 'undefined') {
                var data = {
                    'firebase_token': callback.firebase_token
                };
                loginWithFirebaseToken(data.firebase_token)
                firebase_sdk = new firebaseSdk(data.firebase_token);
                firebase_sdk.siginWithToken();
                firebase_sdk.initApp(function (callback_data) {
                    /*push back the id token to server side*/
                    data["user_data"] = callback_data;
                    console.log('Firebase data : ' + data);
                    ajax.sendRequest("post", '/sendtoken', data, id[0] + "_" + id[1] + "_" + id[2] + "_Loader",  id[0] + "_" + id[1] + "_" + id[2] + "_Results", null, null, null, function (callback) {
                    });
                })
                setTimeout(function () {
                    sharedFunctions.goToUrl('/account/list2');
                }, 1500);
            }

            if(typeof callback.response != 'undefined') {
                switchFlow(callback.response);
            }
        });
    }
    function switchFlow(auth_flow) {
        switch(auth_flow) {
            case 'mobile_verification':
                window.sharedFunctions.goToUrl('/login/mobileverification');
                break;
            case 'password_change':
                window.sharedFunctions.goToUrl('/login/changepasscode');
                break;
        }
    }
});