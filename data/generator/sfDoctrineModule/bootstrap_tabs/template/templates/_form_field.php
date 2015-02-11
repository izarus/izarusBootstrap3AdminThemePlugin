[?php if ($field->isPartial()): ?]
  [?php include_partial('<?php echo $this->getModuleName() ?>/'.$name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?]
[?php elseif ($field->isComponent()): ?]
  [?php include_component('<?php echo $this->getModuleName() ?>', $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?]
[?php else: ?]
  <div class="form-group [?php echo $class ?][?php $form[$name]->hasError() and print ' has-error' ?]">
      [?php echo $form[$name]->renderLabel($label, array('class' => 'col-lg-'.sfConfig::get('app_bootstrap_admin_labelcols',4).' control-label')) ?]

      <div class="col-lg-[?php echo sfConfig::get('app_bootstrap_admin_fieldcols',8) ?] [?php echo $class ?]">
        [?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?]
        <div class="error-block">[?php echo $form[$name]->renderError() ?]</div>
        [?php if ($help): ?]
          <div>[?php echo __($help, array(), '<?php echo $this->getI18nCatalogue() ?>') ?]</div>
        [?php elseif ($help = $form[$name]->renderHelp()): ?]
          <div>[?php echo $help ?]</div>
        [?php endif; ?]
      </div>

  </div>
[?php endif; ?]
