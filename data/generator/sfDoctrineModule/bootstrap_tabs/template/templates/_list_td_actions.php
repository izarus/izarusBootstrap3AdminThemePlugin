<td>
<div style="white-space: nowrap;">
<?php foreach ($this->configuration->getValue('list.object_actions') as $name => $params): ?>
<?php if ('_delete' == $name): ?>
    <?php echo $this->addCredentialCondition('[?php echo $helper->linkToDelete($'.$this->getSingularName().', '.$this->asPhp($params).') ?]', $params) ?>
<?php elseif ('_edit' == $name): ?>
    <?php echo $this->addCredentialCondition('[?php echo $helper->linkToEdit($'.$this->getSingularName().', '.$this->asPhp($params).') ?]', $params) ?>
<?php else: ?>
      <?php echo $this->addCredentialCondition($this->getLinkToAction($name, array_replace($params, array('params' => array_merge($params['params'],array('class' => 'btn btn-sm btn-default')))), true), $params) ?>
<?php endif; ?>
<?php endforeach; ?>
</div>
</td>
