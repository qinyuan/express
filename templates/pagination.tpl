{$link=$change_page_href|cat:"?pageNum="}
{$space="&nbsp;&nbsp;&nbsp;&nbsp;"}
<input type="hidden" id="changePageHref" value="{$change_page_href}" />
<div class="count">
  ��¼��:{$row_count}{$space}
  ÿҳ��ʾ:{$page_size}{$space}
  ��ҳ��:{$page_count}{$space}
  ��ǰҳ:{$page_num}
</div>
<div class="link">
  {if $page_num > 1}
    <a href="{$link}1">��ҳ</a>
    <a href="{$link}{$page_num-1}">��һҳ</a>
  {else}
    <span class='gray'>��ҳ</span>
    <span class='gray'>��һҳ</span>
  {/if}
  {if $page_num<$page_count}
    <a href='{$link}{$page_num + 1}'>��һҳ</a>
    <a href='{$link}{$page_count}'>βҳ</a>
  {else}
    <span class='gray'>��һҳ</span>
    <span class='gray'>βҳ</span>
  {/if}
  {$space}
  ת����<select id="pageNumSelect">
  {section name=loop loop=$page_count} 
    {$index=$smarty.section.loop.index+1}
    <option value="{$index}"{if $index == $page_num} selected="selected"{/if}>{$index}</option>
  {/section} 
  </select>ҳ
</div>