
<ul class="pagination pull-right">

  <li><a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=1">&laquo;</a></li>

  <li><a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $pager->getPreviousPage() ?]">&larr;</a></li>

  [?php foreach ($pager->getLinks() as $page): ?]
    <li[?php if ($page == $pager->getPage()) echo ' class="active"' ?]><a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $page ?]">
      [?php echo $page ?]
    </a></li>
  [?php endforeach; ?]

  <li><a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $pager->getNextPage() ?]">&rarr;</a></li>

  <li><a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $pager->getLastPage() ?]">&raquo;</a></li>

</ul>