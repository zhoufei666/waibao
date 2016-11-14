//dom加载完成后执行的js
$(function () {

    //全选的实现
    $(".check-all").click(function () {
        $(".ids").prop("checked", this.checked);
    });
    $(".ids").click(function () {
        var option = $(".ids");
        option.each(function (i) {
            if (!this.checked) {
                $(".check-all").prop("checked", false);
                return false;
            } else {
                $(".check-all").prop("checked", true);
            }
        });
    });

    //ajax get请求
    $('.ajax-get').click(function () {
        var target;
        var that = this;
        if ($(this).hasClass('confirm')) {
            if (!confirm('确认要执行该操作吗?')) {
                return false;
            }
        }
        if ((target = $(this).attr('href')) || (target = $(this).attr('url'))) {
            $.get(target).success(function (data) {
                if (data.status == 1) {
                    if (data.url) {
                        updateAlert(data.info + ' 正在跳转~', 'success');
                    } else {
                        updateAlert(data.info, 'success');
                    }
                    setTimeout(function () {
                        if (data.url) {
                            location.href = data.url;
                        } else if ($(that).hasClass('no-refresh')) {
                            $('#top-alert').find('button').click();
                        } else {
                            location.reload();
                        }
                    }, 3000);
                } else {
                    updateAlert(data.info);
                    setTimeout(function () {
                        if (data.url) {
                            location.href = data.url;
                        } else {
                            $('#top-alert').find('button').click();
                        }
                    }, 15000);
                }
            });

        }
        return false;
    });

    //ajax post submit请求
    $('.ajax-post').click(function () {
        var target, query, form;
        var target_form = $(this).attr('target-form');
        var that = this;
        var nead_confirm = false;
        if (($(this).attr('type') == 'submit') || (target = $(this).attr('href')) || (target = $(this).attr('url'))) {
            form = $('.' + target_form);
            if ($(this).attr('hide-data') === 'true') {//无数据时也可以使用的功能
                form = $('.hide-data');
                query = form.serialize();
            } else if (form.get(0) == undefined) {
                updateAlert('没有可操作数据。','danger');
                return false;
            } else if (form.get(0).nodeName == 'FORM') {
                if ($(this).hasClass('confirm')) {
                    var confirm_info = $(that).attr('confirm-info');
                    confirm_info=confirm_info?confirm_info:"确认要执行该操作吗?";
                    if (!confirm(confirm_info)) {
                        return false;
                    }
                }
                if ($(this).attr('url') !== undefined) {
                    target = $(this).attr('url');
                } else if(target == '' || target == undefined) {
                    target = form.get(0).action;

                }
                query = form.serialize();
                //自动验证，详情查看jquery.validate
                try{
                    $(form).validate({
                        errorPlacement: function(error, element) {  
                            error.appendTo(element.parent());  
                            error.attr('style','color:red');
                        },
                        submitHandler: function(form1) {  
                            var query1 =$(form1).serialize();;
                            post_ajax_method(that, target, query1);
                        }
                    });
                    return;
                }catch(e){
                    console.log('validate is unfined');
                }
            } else if (form.get(0).nodeName == 'INPUT' || form.get(0).nodeName == 'SELECT' || form.get(0).nodeName == 'TEXTAREA') {
                form.each(function (k, v) {
                    if (v.type == 'checkbox' && v.checked == true) {
                        nead_confirm = true;
                    }
                })
                if (nead_confirm && $(this).hasClass('confirm')) {
                    var confirm_info = $(that).attr('confirm-info');
                    confirm_info=confirm_info?confirm_info:"确认要执行该操作吗?";
                    if (!confirm(confirm_info)) {
                        return false;
                    }
                }
                query = form.serialize();
            } else {
                if ($(this).hasClass('confirm')) {
                    var confirm_info = $(that).attr('confirm-info');
                    confirm_info=confirm_info?confirm_info:"确认要执行该操作吗?";
                    if (!confirm(confirm_info)) {
                        return false;
                    }
                }
                query = form.find('input,select,textarea').serialize();
            }
            if(query==''){
                updateAlert('没有可操作数据','danger');
                return false;
            }
            $(that).addClass('disabled').attr('autocomplete', 'off').prop('disabled', true);

            post_ajax_method(that, target, query);
        }
        return false;
    });

        var post_ajax_method = function(that, target, query) {
        $(that).addClass('disabled').attr('autocomplete', 'off').prop('disabled', true);
        var timestamp3 = new Date().getTime();
        $.post(target, query).success(function(data) {
            if (data.status == 1) {
                if (data.url) {
                    updateAlert(data.info + ' 正在跳转~', 'alert-success');
                } else {
                    updateAlert(data.info, 'alert-success');
                }
                setTimeout(function() {
                    $(that).removeClass('disabled').prop('disabled', false);
                    if (data.url) {
                        location.href = data.url;
                    } else if ($(that).hasClass('no-refresh')) {
                        $('#top-alert').find('button').click();
                    } else {
                        location.reload();
                    }
                }, 1500);
            } else {
                alert(data.info);
                if (data.url != undefined && data.url != '') {
                    window.location.href = data.url;
                }
                //刷新验证码
                if (data.reload_captcha != undefined && data.reload_captcha == true) {
                    re_captcha();
                    $('button[type = submit]').removeClass('disabled').prop('disabled',false);
                }
                // updateAlert(data.info);
                // setTimeout(function() {
                //     $(that).removeClass('disabled').prop('disabled', false);
                //     if (data.url) {
                //         location.href = data.url;
                //     } else {
                //         $('#top-alert').find('button').click();
                //     }
                // }, 1500);
            }
        });
    }

    // 独立域表单获取焦点样式
    $(".text").focus(function () {
        $(this).addClass("focus");
    }).blur(function () {
        $(this).removeClass('focus');
    });
    $("textarea").focus(function () {
        $(this).closest(".textarea").addClass("focus");
    }).blur(function () {
        $(this).closest(".textarea").removeClass("focus");
    });
});

