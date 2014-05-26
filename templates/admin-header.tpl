<div class="header">
  <div>
    <h3> |
      {foreach from=$navigation_array item=item}
        {if $item.current} 
          {$item.text} |
        {else}
          <a style="color:green;" href="{$item.href}">{$item.text}</a> |
        {/if}
      {/foreach} 
    </h3>
    <div class="exit">
      [{$admin_name}]&nbsp;&nbsp;
      <span><a id="editAdminPassword" href="javascript:void(0)">ĞŞ¸ÄÃÜÂë</a></span>
      <span><a href="logout.php?isAdmin=">ÍË³ö</a></span>
    </div>
  </div>
</div>