{$link=$change_page_href|cat:"?pageNum="}
{$space="&nbsp;&nbsp;&nbsp;&nbsp;"}
<input type="hidden" id="changePageHref" value="{$change_page_href}" />
<div class="count">
  记录数:{$row_count}{$space}
  每页显示:{$page_size}{$space}
  总页数:{$page_count}{$space}
  当前页:{$page_num}
</div>
<div class="link">
  {if $page_num > 1}
    <a href="{$link}1">首页</a>
    <a href="{$link}{$page_num-1}">上一页</a>
  {else}
    <span class='gray'>首页</span>
    <span class='gray'>上一页</span>
  {/if}
  {if $page_num<$page_count}
    <a href='{$link}{$page_num + 1}'>下一页</a>
    <a href='{$link}{$page_count}'>尾页</a>
  {else}
    <span class='gray'>下一页</span>
    <span class='gray'>尾页</span>
  {/if}
  {$space}
  转到第<select id="pageNumSelect">
  {section name=loop loop=$page_count} 
    {$index=$smarty.section.loop.index+1}
    <option value="{$index}"{if $index == $page_num} selected="selected"{/if}>{$index}</option>
  {/section} 
  </select>页
</div>