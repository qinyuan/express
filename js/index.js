function unifyHeight(className) {
	if (arguments.length > 1) {
		for (var index in arguments) {
			unifyHeight(arguments[index]);
		}
	}
	function displaycolorDivBack(bool) {
		var div = $('div.' + className).filter('.colorDivBack');
		if (bool) {
			div.show();
		} else {
			div.hide();
		}
	}

	var maxContentLegth = 0, standardHeight = 0, standardWidth = 0;
	var $divs = $('div.' + className);
	$divs.each(function() {
		var contentLength = $(this).text().length;
		if (contentLength > maxContentLegth) {
			standardHeight = $(this).height();
			standardWidth = $(this).width();
		}
	});
	$divs.each(function() {
		if ($.trim(this.className) === className) {
			$(this).hover(function() {
				displaycolorDivBack(true);
			}, function() {
				displaycolorDivBack(false);
			});
		} else {
			$(this).height(standardHeight);
			$(this).width(standardWidth);
		}
	});
}


$('#submit').hover(function() {
	$(this).css('background-color', '#8899ff');
}, function() {
	$(this).css('background-color', '#99bbff');
}).click(function(e) {
	$username = $('#username');
	$password = $('#password');
	if ($.trim($username.val()) === '') {
		alert('用户名不能为空');
		e.preventDefault();
		$username.focus();
		return;
	} else if ($.trim($password.val()) === '') {
		alert("密码不能为空");
		$password.focus();
		e.preventDefault();
		return;
	}
});

unifyHeight('input', 'contact');
$('#username').focus();