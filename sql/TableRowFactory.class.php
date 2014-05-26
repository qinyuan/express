<?php
interface TableRowFactory {
  function getRowCount();
  function getRows();
  function getPageSize();
  function getPageNum();
  function getTableHeads();
  function getChangePageHref();
  function setPageNum($pageNum);
}
?>