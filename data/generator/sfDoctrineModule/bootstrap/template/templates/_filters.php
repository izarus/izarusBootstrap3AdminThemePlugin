[?php use_stylesheets_for_form($form) ?]
[?php use_javascripts_for_form($form) ?]

<div id="filterPopup" class="modal fade">

  <div class="modal-dialog">
    <div class="modal-content">
      <form action="[?php echo url_for('<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'filter')) ?]" method="post" class="form-horizontal">

        <div class="modal-header">
          <a class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
          <h4>[?php echo __('Search',null,'bootstrap_admin') ?]</h4>
        </div>

        <div class="modal-body">

          [?php if ($form->hasGlobalErrors()): ?]
            [?php echo $form->renderGlobalErrors() ?]
          [?php endif; ?]

          [?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?]
            [?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?]
              [?php include_partial('<?php echo $this->getModuleName() ?>/filters_field', array(
                'name'       => $name,
                'attributes' => $field->getConfig('attributes', array()),
                'label'      => $field->getConfig('label'),
                'help'       => $field->getConfig('help'),
                'form'       => $form,
                'field'      => $field,
                'class'      => 'control-type-'.strtolower($field->getType()).' control-name-'.$name,
              )) ?]
            [?php endforeach; ?]

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> [?php echo __('Search', array(), 'bootstrap_admin') ?]</button>
          [?php echo link_to(__('Reset', array(), 'sf_admin'), '<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post', 'class' => 'btn btn-default')) ?]
        </div>

        [?php echo $form->renderHiddenFields() ?]

      </form>
    </div>
  </div>
</div>
