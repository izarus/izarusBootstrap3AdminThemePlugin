<?php

class izarusBootstrapWidgetFormDateTime extends sfWidgetFormDateTime
{
  public function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);

    $this->attributes = array_merge($this->attributes, array('style'=>'display:inline;width:auto;'));

    $this->addOption('today',false);
    $this->addOption('today_label','Today');
    $this->addOption('format', '%month%/%day%/%year% %time% %today%');
  }



  /**
   * Renders the widget.
   *
   * @param  string $name        The element name
   * @param  string $value       The date and time displayed in this widget
   * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
   * @param  array  $errors      An array of errors for the field
   *
   * @return string An HTML tag string
   *
   * @see sfWidgetForm
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $date = $this->getDateWidget($attributes)->render($name, $value);

    if (!$this->getOption('with_time'))
    {
      return $date;
    }

    $day_id = $this->generateId($name.'[day]');
    $month_id = $this->generateId($name.'[month]');
    $year_id = $this->generateId($name.'[year]');
    $hour_id = $this->generateId($name.'[hour]');
    $minute_id = $this->generateId($name.'[minute]');

    $template_base = strtr($this->getOption('format'), array(
      '%date%' => $date,
      '%time%' => $this->getTimeWidget($attributes)->render($name, $value),
      '%today%' => '<a class="btn btn-default pull-right" href="#" onclick="return setToday'.$day_id.'(this);">'.$this->getOption('today_label').'</a>',
    ));


    return <<<EOF
$template_base
<script>
function setToday{$day_id}(btn) {
  var fecha = new Date();
  document.querySelector('#{$day_id} [value="'+fecha.getDate()+'"]').selected = true;
  document.querySelector('#{$month_id} [value="'+(fecha.getMonth()+1)+'"]').selected = true;
  document.querySelector('#{$year_id} [value="'+fecha.getFullYear()+'"]').selected = true;
  document.querySelector('#{$hour_id} [value="'+fecha.getHours()+'"]').selected = true;
  document.querySelector('#{$minute_id} [value="'+fecha.getMinutes()+'"]').selected = true;
  btn.blur();
  return false;
}
</script>
EOF;

  }

}