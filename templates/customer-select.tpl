<select name="cusId" id="cusId">
  {if isset($with_total) && $with_total}
    <option value="">(È«²¿)</option>
  {/if}
  {if isset($with_empty) && $with_empty}
    <option value="">(Î´Ñ¡Ôñ)</option>
  {/if}
  {foreach from=$customers item=customer}
    <option value="{$customer.cus_id}" 
      {if isset($def_cus_id) && $def_cus_id == $customer.cus_id}
        selected="selected"
      {/if}
    >{$customer.cus_name}</option>
  {/foreach}
</select>