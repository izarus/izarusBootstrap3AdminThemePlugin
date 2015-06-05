[?php include_stylesheets_for_form($form) ?]
[?php include_javascripts_for_form($form) ?]

[?php include_partial('<?php echo $this->getModuleName() ?>/flashes') ?]

<div role="tabpanel">
[?php if(count($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit'))>1): ?]
<ul class="nav nav-tabs" role="tablist">
[?php $i=1; foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?]
[?php if ('NONE' != $fieldset): ?]
  <li role="presentation"[?php if($i==1): ?] class="active"[?php endif; ?]><a href="#tab[?php echo $i; ?]" role="tab" data-toggle="tab">[?php echo __($fieldset, array(), '<?php echo $this->getI18nCatalogue() ?>') ?]</a></li>
[?php endif; ?]
[?php $i++; endforeach; ?]
</ul>
[?php endif; ?]

<form action="#" class="form-horizontal">

<div class="tab-content">
  [?php $i=1; foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?]
    [?php include_partial('<?php echo $this->getModuleName() ?>/show_fieldset', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset, 'numtab'=>$i)) ?]
  [?php $i++; endforeach; ?]
</div>

</form>
</div>