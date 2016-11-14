jQuery.extend(jQuery.validator.messages, {
    required: "必选字段",
    remote: "请修正该字段",
    email: "请输入正确格式的电子邮件",
    mobile: "请正确输入手机号",
    url: "请输入合法的网址",
    date: "请输入合法的日期",
    dateISO: "请输入合法的日期 (ISO).",
    number: "请输入合法的数字",
    digits: "只能输入整数",
    creditcard: "请输入合法的信用卡号",
    equalTo: "请再次输入相同的值",
    accept: "请输入拥有合法后缀名的字符串",
    ajaxcheck:"当前输入已存在，请重新输入！",
    chrnum:"请输入正确的百分数",
    maxlength: jQuery.validator.format("请输入一个 长度最多是 {0} 的字符串"),
    minlength: jQuery.validator.format("请输入一个 长度最少是 {0} 的字符串"),
    rangelength: jQuery.validator.format("请输入 一个长度介于 {0} 和 {1} 之间的字符串"),
    range: jQuery.validator.format("请输入一个介于 {0} 和 {1} 之间的值"),
    max: jQuery.validator.format("请输入一个最大为{0} 的值"),
    min: jQuery.validator.format("请输入一个最小为{0} 的值")
  });

//邮箱 表单验证规则
jQuery.validator.addMethod("email", function (value, element) {
    var email = /^[a-z0-9._%-]+@([a-z0-9-]+\.)+[a-z]{2,4}$/;
    return this.optional(element) || (email.test(value));
}, "邮箱格式不对");

//手机号 表单验证规则
jQuery.validator.addMethod("mobile", function (value, element) {
    var mobile = /^13[\d]{9}$|14^[0-9]\d{8}|^15[0-9]\d{8}$|^1[8|7][0-9]\d{8}$/;
    return this.optional(element) || (mobile.test(value));
}, "手机号格式不对");
//百分率验证规则
jQuery.validator.addMethod("chrnum", function(value, element) {
    var chrnum = /^(?:100|[0-9]\d?)(?:\.00)?$/;
    return this.optional(element) || (chrnum.test(value));
}); 
