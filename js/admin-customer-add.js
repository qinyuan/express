function getCustomerTemplate() {
	var customerStr = $.cookie('customerTemplate');
	if (customerStr == null) {
		var customer = {};
		$formElements.each(function() {
			customer[this.id] = this.value;
		});
	} else {
		var customer = JSON.parse(customerStr);
	}
	return customer;
}

function loadCustomerTemplate() {
	for (var key in customerTemplate) {
		$('#' + key).val(customerTemplate[key]);
	}
}

function updateCustomerTemplate(id, value) {
	customerTemplate[id] = value;
	var customerStr = JSON.stringify(customerTemplate);
	$.cookie('customerTemplate', customerStr);
}

var $formElements = $('form').find('select,input:text');
$formElements.change(function() {
	updateCustomerTemplate(this.id, this.value);
});
var customerTemplate = getCustomerTemplate();
loadCustomerTemplate();

$('#addCustomerSubmit').click(function(e) {
	var $cusName = $('#cusName');
	var $password = $('#password');
	if ($.trim($cusName.val()) == '') {
		alert('客户名称不能为空');
		$cusName.focus();
		e.preventDefault();
	} else if ($.trim($password.val()) == '') {
		alert("密码不能为空");
		$password.focus();
		e.preventDefault();
	}
});

var $addResult = $('#addResult');
if ($addResult.size() > 0) {
	alert($addResult.val());
}