$('#cusId').change(function() {
	postFilter('cusId',$(this).val());
});
$('td.handle img').click(function() {
	var id = this.id;
	if (id.match(/^edit\d+$/g)) {
		var orderId = id.replace(/\D/g, '');
		location.href = 'admin-order-edit.php?orderId=' + orderId;
	} else if (id.match(/^delete\d+$/g)) {
		if (!confirm("È·¶¨É¾³ý£¿", false)) {
			return;
		}
		var orderId = id.replace(/\D/g, '');
		$.post('admin-order-delete.php', {
			'orderId' : orderId
		}, function(data) {
			data = $.trim(data);
			if (data === "success" || data.match(/^<DOCTYPE.*$/g)) {
				location.reload();
			} else if (data.match(/error:.*/g)) {
				alert(data.replace(/^error:/g, ''));
			} else {
				alert("Î´Öª´íÎó£¡");
			}
		});
	}
});
