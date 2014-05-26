$('td.handle img').click(function() {
	var id = this.id;
	if (id.match(/^edit\d+$/g)) {
		var cusId = id.replace(/\D/g, '');
		location.href = 'admin-customer-edit.php?cusId=' + cusId;
	} else if (id.match(/^delete\d+$/g)) {
		if (!confirm("È·¶¨É¾³ý£¿", false)) {
			return;
		}
		var cusId = id.replace(/\D/g, '');
		$.post('admin-customer-delete.php', {
			'cusId' : cusId
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