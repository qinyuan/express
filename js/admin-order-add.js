function getOrderTemplate() {
	var orderStr = $.cookie('orderTemplate');
	if (orderStr == null) {
		var order = {};
		$formElements.each(function() {
			order[this.id] = this.value;
		});
	} else {
		var order = JSON.parse(orderStr);
	}
	if (order['sendDate'] == '') {
		order['sendDate'] = getToday();
	}
	return order;
}

function getToday() {
	var date = new Date();
	var year = date.getFullYear();
	var month = date.getMonth() + 1;
	var day = date.getDate();
	if (month < 10) {
		month = '0' + month;
	}
	if (day < 10) {
		day = '0' + day;
	}
	return year + '-' + month + '-' + day;
}

function loadOrderTemplate() {
	for (var key in orderTemplate) {
		$('#' + key).val(orderTemplate[key]);
	}
}

function updateOrderTemplate(id, value) {
	orderTemplate[id] = value;
	var orderStr = JSON.stringify(orderTemplate);
	$.cookie('orderTemplate', orderStr);
}

var $formElements = $('form').find('select,input:text');
$formElements.change(function() {
    if (this.id == 'cusId') {
        $formElements.each(function(){
            if (this.type == 'text' && !$(this).attr('readonly')) {
                $(this).val('');
            }
        });
    }
	updateOrderTemplate(this.id, this.value);
});
var orderTemplate = getOrderTemplate();
loadOrderTemplate();

$('input.dateInput').click(WdatePicker);

$('#addOrderSubmit').click(function(e) {
	var $cusId = $('#cusId');
	var $sendDate = $('#sendDate');
	if ($cusId.val() <= 0) {
		alert('客户未选择');
		$cusId.focus();
		e.preventDefault();
	} else if ($sendDate.val() == '') {
		alert("日期未选择");
		$sendDate.focus();
		e.preventDefault();
	}
});

var $addResult = $('#addResult');
if ($addResult.size() > 0) {
	alert($addResult.val());
}
