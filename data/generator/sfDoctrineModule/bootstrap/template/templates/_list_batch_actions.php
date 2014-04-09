<?php if ($listActions = $this->configuration->getValue('list.batch_actions')): ?>

<div class="btn-group">
  <a class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" href="#">
    [?php echo __('Choose an action', array(), 'sf_admin') ?]
    <span class="caret"></span>
  </a>
  <ul class="batch-actions dropdown-menu">
    <?php foreach ((array) $listActions as $action => $params): ?>
      <?php echo $this->addCredentialCondition('<li><a href="#" data-action="'.$action.'">[?php echo __(\''.$params['label'].'\', array(), \'sf_admin\') ?]</a></li>', $params) ?>
    <?php endforeach; ?>
  </ul>
</div>

<input type="hidden" name="batch_action" value="" />

[?php $form = new BaseForm(); if ($form->isCSRFProtected()): ?]
<input type="hidden" name="[?php echo $form->getCSRFFieldName() ?]" value="[?php echo $form->getCSRFToken() ?]" />
[?php endif; ?]

<script type="text/javascript">
$('.batch-actions a').bind('click', function(){
	var $anchor = $(this),
	    $form = $anchor.closest('form');

	$('input[name="batch_action"]', $form).val($anchor.data('action'));

	$form.submit();

	return false;
});
</script>

<?php endif; ?>
