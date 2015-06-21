[?php if ($field->isPartial()): ?]
  [?php include_partial('<?php echo $this->getModuleName() ?>/'.$name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?]
[?php elseif ($field->isComponent()): ?]
  [?php include_component('<?php echo $this->getModuleName() ?>', $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?]
[?php else: ?]
  <div class="form-group [?php echo $class ?][?php $form[$name]->hasError() and print ' has-error' ?]">
      [?php echo $form[$name]->renderLabel($label, array('class' => 'col-lg-'.sfConfig::get('app_bootstrap_admin_labelcols',4).' control-label')) ?]

      <div class="col-lg-[?php echo sfConfig::get('app_bootstrap_admin_fieldcols',8) ?] [?php echo $class ?]">

[?php switch(get_class($form[$name]->getWidget())): ?]
[?php case 'sfWidgetFormDoctrineChoice': ?]
[?php case 'sfWidgetFormChoice': ?]
          [?php $choices = $form[$name]->getWidget()->getChoices(); ?]
          [?php if (is_array($form[$name]->getValue())): ?]
          <ul class="list-unstyled form-control-static">
            [?php foreach ($form[$name]->getValue() as $key => $value): ?]
            <li>[?php echo $choices[$value] ?]</li>
            [?php endforeach; ?]
          </ul>
          [?php else: ?]
          <p class="form-control-static">
            [?php echo $choices[$form[$name]->getValue()] ?]
          </p>
          [?php endif; ?]
[?php break; ?>]
[?php case 'sfWidgetFormInputCheckbox': ?]
        <p class="form-control-static">
          <i class="glyphicon glyphicon-[?php echo ($form[$name]->getValue())?'ok text-success':'remove text-danger' ?]"></i>
        </p>
[?php break; ?>]
[?php case 'sfWidgetFormInputPassword': ?]
        <p class="form-control-static">
          ******
        </p>
[?php break; ?>]
[?php default: ?]
        <p class="form-control-static">
          [?php echo $form[$name]->getValue() ?]
        </p>
[?php break; ?>]
[?php endswitch; ?]

        [?php if ($help): ?]
          <div>[?php echo __($help, array(), '<?php echo $this->getI18nCatalogue() ?>') ?]</div>
        [?php elseif ($help = $form[$name]->renderHelp()): ?]
          <div>[?php echo $help ?]</div>
        [?php endif; ?]
      </div>

  </div>
[?php endif; ?]