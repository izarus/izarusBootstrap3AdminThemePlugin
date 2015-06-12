[?php include_stylesheets_for_form($form) ?]
[?php include_javascripts_for_form($form) ?]

[?php include_partial('<?php echo $this->getModuleName() ?>/flashes') ?]

<form action="#" class="form-horizontal">

  [?php foreach ($configuration->getFormFields($form, 'show') as $fieldset => $fields): ?]
    [?php include_partial('<?php echo $this->getModuleName() ?>/show_fieldset', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?]
  [?php endforeach; ?]

</form>