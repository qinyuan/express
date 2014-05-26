<!DOCTYPE html>
<html>
<head>
  <meta name="keywords" content="快运,快速,浦江,官方网站" />
  <meta name="description" content="{$company}唯一官方网站" />
  <meta name="title" content="{$company}" />
  {include file='meta_charset.tpl'}
  <title>{$company}</title>
  <link rel="stylesheet" href="css/common.css" type="text/css" />
  <link rel="stylesheet" href="css/index.css" type="text/css" />
</head>
<body>
<div class="body">
  <div id="background"><img src="css/img/background.jpg" /></div>
  
  <div class="company">{$company}</div>
  
  <div class="transparent input"></div>
  <div class="colorDivBack input"></div>
  <div class="input">
    <form action="login.php" method="post">
      <table>
        <tr>
          <td class="label">用户名：</td>
          <td>
            <input class="text" type="text" name="username" id="username" />
          </td>
        </tr>
        <tr>
          <td class="label">密码：</td>
          <td>
            <input class="text" type="password" name="password" id="password" />
          </td>
        </tr>
        <tr>
          <td colspan="2" class="submit">
            <input type="submit" id="submit" name="submit" value="登    录" />
          </td>
        </tr>
      </table>
    </form>
  </div>
  
  <div class="transparent contact"></div>
  <div class="colorDivBack contact"></div>
  <div class="contact">
    <table>
      <tr>
        <td class="label">电话：</td>
        <td class="value">{$tel}</td>
      </tr>
      <tr>
        <td class="label">地址：</td>
        <td class="value">{$address}</td>
      </tr>
    </table>
  </div>

</div>
</body>
<script src="js/jquery.js"></script>
<script src="js/index.js"></script>
</html>