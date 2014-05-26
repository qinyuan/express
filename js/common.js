function postFilter(key, value) {
	var href = $('#changePageHref').val();
	location.href = href + "?" + key + "=" + value;
}

(function() {
	var thickBorder = "4px solid black";
	var thinBorder = "1px solid darkgray";
	$('table.nor').css({
		"borderTop" : thickBorder,
		"borderBottom" : thickBorder,
		"borderCollapse" : "collapse",
		"margin" : "5px"
	});
	$('table.nor th').css({
		"borderBottom" : "2px solid black",
		"borderLeft" : thinBorder,
		"borderRight" : thinBorder,
		"padding" : "4px"
	});
	$('table.nor td').css({
		"border" : thinBorder,
		"padding" : "4px"
	});
	$('table.nor tr:nth-child(even)').css("backgroundColor", "lightgray");

	var bgColor = null;
	$('table.nor tr').hover(function() {
		bgColor = String(this.style.backgroundColor);
		this.style.backgroundColor = "yellow";
	}, function() {
		if (bgColor != null) {
			this.style.backgroundColor = bgColor;
		}
	});

	$('#pageNumSelect').change(function() {
		postFilter('pageNum', this.value);
	});

	$form = $('form');
	if ($form.size() > 0) {
		$form.find('input:text').eq(0).focus();
	}

	$('div.exit a').hover(function() {
		$(this).parent().css('background-color', 'black');
		$(this).css({
			'color' : 'white',
			'text-decoration' : 'none',
			'font-weight' : 'bold'
		});
	}, function() {
		$(this).parent().css('background-color', 'transparent');
		$(this).css({
			'color' : 'black',
			'text-decoration' : 'underline',
			'font-weight' : 'normal'
		});
	});

	function showPasswordEditForm(postUrl, indexUrl) {
		var s = '<div class="editPassword"><table>';

		s += "<tr>";
		s += "<td>����������룺</td>";
		s += '<td><input type="password" id="oldPassword" /></td>';
		s += "</tr>";

		s += "<tr>";
		s += "<td>�����������룺</td>";
		s += '<td><input type="password" id="newPassword1" /></td>';
		s += "</tr>";

		s += "<tr>";
		s += "<td>���ٴ����������룺</td>";
		s += '<td><input type="password" id="newPassword2" /></td>';
		s += "</tr>";

		var action = "return resetPassword('" + postUrl + "','" + indexUrl + "');";
		s += "<tr>";
		s += '<td><button onclick="' + action + '">ȷ��</button></td>';
		s += '<td><button onclick="return cancelResetPassword();">ȡ��</button></td>';
		s += "</tr>";

		s += '</table></div>';
		$(s).appendTo('div.body').fadeIn(500, function() {
			$(this).find('input').eq(0).focus();
		});
	}

	$('#editCusPassword').click(function() {
		showPasswordEditForm('edit-password.php', 'index.php');
	});

	$('#editAdminPassword').click(function() {
		showPasswordEditForm('admin-edit-password.php', 'admin-index.php');
	});
})();
function resetPassword(postUrl, indexHref) {
	var $oldPassword = $('#oldPassword');
	var $newPassword1 = $('#newPassword1');
	var $newPassword2 = $('#newPassword2');
	var oldPassword = $oldPassword.val();
	var newPassword1 = $newPassword1.val();
	var newPassword2 = $newPassword2.val();

	if ($.trim(newPassword1) === '') {
		alert('�����벻��Ϊ�գ�Ҳ����ȫΪ�ո�');
		$newPassword1.focus();
	} else if (newPassword1 !== newPassword2) {
		alert("��������������벻һ��");
		$newPassword1.select();
	} else {
		$.post(postUrl, {
			'oldPassword' : oldPassword,
			'newPassword' : newPassword1
		}, function(data) {
			data = $.trim(data);
			if (data === '0') {
				alert('�������������');
				$oldPassword.select();
			} else if (data === '1') {
				alert('�����޸ĳɹ���');
				location.href = indexHref;
			}
		});
	}
}

function cancelResetPassword() {
	$('div.editPassword').remove();
}