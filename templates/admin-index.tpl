<!DOCTYPE html>
<html>
<head>
  {include file='meta_charset.tpl'}
  <title>��̨��¼</title>
  <link rel="stylesheet" href="css/common.css" type="text/css" />
  <link rel="stylesheet" href="css/admin-index.css" type="text/css" />
</head>
<body>
<div class="body">

  <h1>{$company}</h1>
  <h3>��̨��¼</h3>
  <form action="admin-login.php" method="post">
    <table class="formInput">
      <tr>
        <td class="label">�û�����</td>
        <td><input type="text" id="username" name="username" /></td>
      </tr>
      <tr>
        <td class="label">���룺</td>
        <td><input type="password" id="password" name="password" /></td>
      </tr>
      <tr>
        <td colspan="2">
          <input type="submit" id="submit" name="submit" value="��   ¼" />
        </td>
      </tr>
    </table>
  </form>
  
</div>
</body>
<script src="js/jquery.js"></script>
<script>
$('#username').focus();
</script>
</html>