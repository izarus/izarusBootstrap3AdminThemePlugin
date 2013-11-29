[?php if ($sf_user->hasFlash('notice')): ?]
  <div class="alert alert-success">
    <a href="#" class="close fade" data-dismiss="alert">&times;</a>
    [?php echo __($sf_user->getFlash('notice'), array(), 'sf_admin') ?]
  </div>
[?php endif; ?]

[?php if ($sf_user->hasFlash('error')): ?]
  <div class="alert alert-danger">
    <a href="#" class="close fade" data-dismiss="alert">&times;</a>
    [?php echo __($sf_user->getFlash('error'), array(), 'sf_admin') ?]
  </div>
[?php endif; ?]

[?php if ($sf_user->hasFlash('warning')): ?]
  <div class="alert alert-warning">
    <a href="#" class="close fade" data-dismiss="alert">&times;</a>
    [?php echo __($sf_user->getFlash('warning'), array(), 'sf_admin') ?]
  </div>
[?php endif; ?]

[?php if ($sf_user->hasFlash('success')): ?]
  <div class="alert alert-success">
    <a href="#" class="close fade" data-dismiss="alert">&times;</a>
    [?php echo __($sf_user->getFlash('success'), array(), 'sf_admin') ?]
  </div>
[?php endif; ?]

[?php if ($sf_user->hasFlash('info')): ?]
  <div class="alert alert-info">
    <a href="#" class="close fade" data-dismiss="alert">&times;</a>
    [?php echo __($sf_user->getFlash('info'), array(), 'sf_admin') ?]
  </div>
[?php endif; ?]