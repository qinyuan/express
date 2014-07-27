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

function beforeSubmit(e) {
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
}

function afterInputChange() {
    if (this.id == 'cusId') {
        $formElements.each(function(){
            if (this.type == 'text' && !$(this).attr('readonly')) {
                $(this).val('');
            }
        });
    }
	updateOrderTemplate(this.id, this.value);
}

function getSortedKeys(optionalJson, prefix) {
    var keys = new Array();
    for (var key in optionalJson) {
        if (key == '__order_id__') continue;
        if (prefix === null || prefix ==='') {
            keys.push(key.substr(1));
        } else if (key.length > prefix.length && 
                key.substr(1, prefix.length) === prefix) {
            keys.push(key.substr(1));
        }
    }
    return keys.sort(function(a, b) {
        return parseInt(optionalJson['_' + b]['__order_id__']) 
            - parseInt(optionalJson['_' + a]['__order_id__']);
    });
}

function completeInfo() {
    if (latestOrders) {
        var cusIdKey = '_' + $('#cusId').val();
        var consignerKey = '_' + $('#consigner').val();
        var receiverKey = '_' + $('#receiver').val();
        var cusJson, consignerJson, receiverJson;
        if ((cusJson = latestOrders[cusIdKey]) && 
            (consignerJson = cusJson[consignerKey]) &&
            (receiverJson = consignerJson[receiverKey])) {
            //the values order is delivery, yiwu_tel, delivery_tel
            $('#delivery').val(receiverJson[0]);
            $('#yiwuTel').val(receiverJson[1]);
            $('#deliveryTel').val(receiverJson[2]);
            $('#payment').focus();
        }
    }
}

function showOptionalPanel(optionalJson, inputElement) {
    function parseCssValue(cssAttr) {
        var str = $inputElement.css(cssAttr).replace(/\D+/, '');
        return str ? parseInt(str) : 1;
    }
    var $optionalInputDiv = $('#optionalInputDiv').empty();

    var $inputElement = $(inputElement);

    var offset = $inputElement.offset();
    var offsetTop = offset.top + $inputElement.height()
        + parseCssValue('padding-top')  + parseCssValue('padding-bottom')
        + parseCssValue('margin-top') + parseCssValue('margin-bottom');
    var offsetLeft = offset.left;
    var width = $inputElement.width()
        + parseCssValue('padding-left') + parseCssValue('padding-right')
        + parseCssValue('margin-left') + parseCssValue('margin-right');

    $optionalInputDiv.width(width).show().offset({
        'top': offsetTop, 
        'left': offsetLeft
    });
    
    if (optionalJson) {
        var keys = getSortedKeys(optionalJson, $inputElement.val());
        for (var i=0, len = keys.length; i < len && i < 10; i++) {
            $('<p>' + keys[i] + '</p>').hover(function() {
                $(this).css('background-color', '#dddddd');
            }, function() {
                $(this).css('background-color', '#ffffff');
            }).click(function() {
                $inputElement.val($(this).text());
                if (inputElement.id == 'receiver') {
                    completeInfo();
                }
            }).appendTo($optionalInputDiv);
        }
    }
}

function showOptionalConsigners() {
    if (latestOrders) {
        var cusIdKey = '_' + $('#cusId').val();
        var cusJson = latestOrders[cusIdKey];
        showOptionalPanel(cusJson, this);
    }
}

function showOptionalReceivers() {
    if (latestOrders) {
        var cusIdKey = '_' + $('#cusId').val();
        var consignerKey = '_' + $('#consigner').val();
        var cusJson, consignerJson;
        if ((cusJson = latestOrders[cusIdKey]) && 
                (consignerJson = cusJson[consignerKey])) {
            showOptionalPanel(consignerJson, this);
        } else {
            showOptionalPanel(null, this);
        }
    }
}

function hideOptionalInput() {
    $('#optionalInputDiv').hide();
}

function htmlClick(e) {
    var target = e.target;
    if (target.id != 'consigner' && target.id != 'receiver') {
        hideOptionalInput();
    }
}

function consignerKeyUp() {
    showOptionalConsigners(this.value);
}

function receiverKeyUp() {
    showOptionalReceivers(this.value);
}

var $formElements = $('form').find('select,input:text');
$formElements.change(afterInputChange);
var orderTemplate = getOrderTemplate();
loadOrderTemplate();

$('html').click(htmlClick);
$('input.dateInput').click(WdatePicker);
$('#addOrderSubmit').click(beforeSubmit);
$('#consigner').focus(showOptionalConsigners).keyup(showOptionalConsigners);
$('#receiver').focus(showOptionalReceivers).keyup(showOptionalReceivers);
$('#yiwuTel').focus(hideOptionalInput);

var $addResult = $('#addResult');
if ($addResult.size() > 0) {
	alert($addResult.val());
}

/**
 * auto complete the order information
 * the keys order is cus_id, consigner, receiver
 * the values order is delivery, yiwu_tel, delivery_tel
 */
var latestOrders = null;
setTimeout(function() {
    $.getJSON('admin-latest-orders.php', function(data){
        latestOrders = data;
    });
}, 500);
