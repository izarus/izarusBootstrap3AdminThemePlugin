<hr>
<div class="show-actions text-right">
<div class="btn-group">
<?php foreach ($this->configuration->getValue('show.actions') as $name => $params): ?>

<?php if ('_list' == $name): ?>
  <?php echo $this->addCredentialCondition('[?php echo $helper->linkToList('.$this->asPhp($params).') ?]', $params) ?>
<?php elseif ('_edit' == $name): ?>
  <?php echo $this->addCredentialCondition('[?php echo $helper->linkToEdit($'.$this->getSingularName().', '.$this->asPhp($params).') ?]', $params) ?>
<?php elseif ('_delete' == $name): ?>
  <?php echo $this->addCredentialCondition('[?php echo $helper->linkToDelete($form->getObject(), '.$this->asPhp($params).') ?]', $params) ?>
<?php else: ?>
[?php if (method_exists($helper, 'linkTo<?php echo $method = ucfirst(sfInflector::camelize($name)) ?>')): ?]
<?php echo $this->addCredentialCondition('[?php echo $helper->linkTo'.$method.'($form->getObject(), '.$this->asPhp($params).') ?]', $params) ?>

[?php else: ?]
<?php echo $this->addCredentialCondition($this->getLinkToAction($name, array_replace($params, array('params' => array_merge($params['params'],array('class' => 'btn btn-sm btn-default')))), true), $params) ?>

[?php endif; ?]
<?php endif; ?>

<?php endforeach; ?>
</div>
</div>
