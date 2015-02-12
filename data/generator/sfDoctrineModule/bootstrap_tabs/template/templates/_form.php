[?php use_stylesheets_for_form($form) ?]
[?php use_javascripts_for_form($form) ?]

<div role="tabpanel">
[?php if(count($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit'))>1): ?]
<ul class="nav nav-tabs" role="tablist">
[?php $i=1; foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?]
[?php if ('NONE' != $fieldset): ?]
  <li role="presentation"[?php if($i==1): ?] class="active"[?php endif; ?]><a href="#tab[?php echo $i; ?]" role="tab" data-toggle="tab">[?php echo __($fieldset, array(), '<?php echo $this->getI18nCatalogue() ?>') ?]</a></li>
[?php endif; ?]
[?php $i++; endforeach; ?]
</ul>
<br>
[?php endif; ?]

[?php include_partial('<?php echo $this->getModuleName() ?>/flashes') ?]

[?php echo form_tag_for($form, '@<?php echo $this->params['route_prefix'] ?>', array('class' => 'form-horizontal')) ?]
  [?php echo $form->renderHiddenFields(false) ?]

  [?php if ($form->hasGlobalErrors()): ?]
    [?php echo $form->renderGlobalErrors() ?]
  [?php endif; ?]
<div class="tab-content">
  [?php $i=1; foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?]
    [?php include_partial('<?php echo $this->getModuleName() ?>/form_fieldset', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset, 'numtab'=>$i)) ?]
  [?php $i++; endforeach; ?]
</div>
  [?php include_partial('<?php echo $this->getModuleName() ?>/form_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?]
</form>
</div>
