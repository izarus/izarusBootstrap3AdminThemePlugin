  [?php if ('NONE' != $fieldset): ?]
    <div role="tabpanel" class="tab-pane[?php if($numtab==1): ?] active[?php endif; ?]" id="tab[?php echo $numtab; ?]">
  [?php endif; ?]

<fieldset>
  
  [?php foreach ($fields as $name => $field): ?]
    [?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?]
    [?php include_partial('<?php echo $this->getModuleName() ?>/form_field', array(
      'name'       => $name,
      'attributes' => $field->getConfig('attributes', array()),
      'label'      => $field->getConfig('label'),
      'help'       => $field->getConfig('help'),
      'form'       => $form,
      'field'      => $field,
      'class'      => 'control-type-'.strtolower($field->getType()).' control-name-'.$name,
    )) ?]
  [?php endforeach; ?]
   
</fieldset>
   
  [?php if ('NONE' != $fieldset): ?]
    </div>
  [?php endif; ?]
