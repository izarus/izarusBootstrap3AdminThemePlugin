[?php if ($field->isPartial()): ?]
  [?php include_partial('<?php echo $this->getModuleName() ?>/'.$name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?]
[?php elseif ($field->isComponent()): ?]
  [?php include_component('<?php echo $this->getModuleName() ?>', $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?]
[?php else: ?]
  <div class="form-group [?php echo $class ?][?php $form[$name]->hasError() and print ' has-error' ?]">
      [?php echo $form[$name]->renderLabel($label, array('class' => 'col-lg-4 control-label')) ?]

      <div class="col-lg-8 [?php echo $class ?]">
        [?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?]
        <span class="help-block">[?php echo $form[$name]->renderError() ?]</span>
        [?php if ($help): ?]
          <span class="help-block">[?php echo __($help, array(), '<?php echo $this->getI18nCatalogue() ?>') ?]</span>
        [?php elseif ($help = $form[$name]->renderHelp()): ?]
          <span class="help-block">[?php echo $help ?]</span>
        [?php endif; ?]
      </div>

  </div>
[?php endif; ?]
