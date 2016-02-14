<td class="text-right" style="white-space: nowrap;">
<?php foreach ($this->configuration->getValue('list.object_actions') as $name => $params): ?>

<?php if ( isset( $params['condition'] ) ): ?>
  [?php if ( <?php echo ( isset( $params['condition']['invert'] ) && $params['condition']['invert'] ? '!' : '') . '$' . $this->getSingularName( ) . '->' . $params['condition']['function'] ?>( <?php echo ( isset( $params['condition']['params'] ) ? $params['condition']['params'] : '' ) ?> ) ): ?]
<?php endif; ?>

<?php if ('_delete' == $name): ?>
    <?php echo $this->addCredentialCondition('[?php echo $helper->linkToDelete($'.$this->getSingularName().', '.$this->asPhp($params).') ?]', $params) ?>
<?php elseif ('_edit' == $name): ?>
    <?php echo $this->addCredentialCondition('[?php echo $helper->linkToEdit($'.$this->getSingularName().', '.$this->asPhp($params).') ?]', $params) ?>
<?php elseif ('_show' == $name): ?>
    <?php echo $this->addCredentialCondition('[?php echo $helper->linkToShow($'.$this->getSingularName().', '.$this->asPhp($params).') ?]', $params) ?>
<?php else: ?>
      <?php echo $this->addCredentialCondition($this->getLinkToAction($name, array_replace($params, array('params' => array_merge($params['params'],array('class' => 'btn btn-sm btn-'.((!empty($params['params']['btn']))?$params['params']['btn']:'default' ) )))), true), $params) ?>
<?php endif; ?>

<?php if ( isset( $params['condition'] ) ): ?>
  [?php endif; ?]
<?php endif; ?>

<?php endforeach; ?>
</td>
