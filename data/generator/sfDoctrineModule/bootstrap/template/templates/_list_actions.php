<?php if ($actions = $this->configuration->getValue('list.actions')): ?>
<div class="btn-group">
<?php foreach ($actions as $name => $params): ?>
<?php if ('_new' == $name): ?>
<?php echo $this->addCredentialCondition('[?php echo $helper->linkToNew('.$this->asPhp($params).') ?]', $params)."\n" ?>
<?php else: ?>
  <?php echo $this->addCredentialCondition($this->getLinkToAction($name, array_merge($params, array('params' => array('class' => 'btn btn-sm btn-default'))), false), $params)."\n" ?>
<?php endif; ?>
<?php endforeach; ?>
</div>
<?php endif; ?>
