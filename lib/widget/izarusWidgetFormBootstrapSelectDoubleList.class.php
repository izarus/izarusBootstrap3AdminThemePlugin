<?php

/**
 * izarusWidgetFormBootstrapSelectDoubleList
 *
 */
class izarusWidgetFormBootstrapSelectDoubleList extends sfWidgetForm
{
  /**
   * Constructor.
   *
   * Available options:
   *
   *  * choices:            An array of possible choices (required)
   *  * class:              The main class of the widget
   *  * class_select:       The class for the two select tags
   *  * label_unassociated: The label for unassociated
   *  * label_associated:   The label for associated
   *  * unassociate:        The HTML for the unassociate link
   *  * associate:          The HTML for the associate link
   *  * template:           The HTML template to use to render this widget
   *                        The available placeholders are:
   *                          * label_associated
   *                          * label_unassociated
   *                          * associate
   *                          * unassociate
   *                          * associated
   *                          * unassociated
   *                          * class
   *
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
    $this->addRequiredOption('choices');

    $this->addOption('class', 'double_list');
    $this->addOption('class_select', 'double_list_select');
    $this->addOption('label_unassociated', 'Unassociated');
    $this->addOption('label_associated', 'Associated');
    $this->addOption('associate_icon', '<i class="glyphicon glyphicon-chevron-left"></i>');
    $this->addOption('unassociate_icon', '<i class="glyphicon glyphicon-chevron-right"></i>');
    $associated_first = isset($options['associated_first']) ? $options['associated_first'] : true;

    $this->addOption('template', <<<EOF
<div class="row %class%">
  <div class="col-xs-5">
    <div class="panel panel-default">
      <div class="panel-heading" style="padding:4px 10px;">
        %label_associated%
      </div>
      <div class="panel-body" style="padding:0;">
        %associated%
      </div>
    </div>
  </div>
  <div class="col-xs-1 text-center">
    <br><br>
    <ul class="list-unstyled">
      <li>%associate%</li>
      <li>%unassociate%</li>
    </ul>
  </div>
  <div class="col-xs-5">
    <div class="panel panel-default">
      <div class="panel-heading" style="padding:4px 10px;">
        %label_unassociated%
      </div>
      <div class="panel-body" style="padding:0;">
        %unassociated%
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  sfDoubleList.init(document.getElementById('%id%'), '%class_select%');
</script>
EOF
);
  }

  /**
   * Renders the widget.
   *
   * @param  string $name        The element name
   * @param  string $value       The value selected in this widget
   * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
   * @param  array  $errors      An array of errors for the field
   *
   * @return string An HTML tag string
   *
   * @see sfWidgetForm
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    if (is_null($value))
    {
      $value = array();
    }

    $choices = $this->getOption('choices');
    if ($choices instanceof sfCallable)
    {
      $choices = $choices->call();
    }

    $associated = array();
    $unassociated = array();
    foreach ($choices as $key => $option)
    {
      if (in_array(strval($key), $value))
      {
        $associated[$key] = $option;
      }
      else
      {
        $unassociated[$key] = $option;
      }
    }

    $size = isset($attributes['size']) ? $attributes['size'] : (isset($this->attributes['size']) ? $this->attributes['size'] : 10);

    $associatedWidget = new sfWidgetFormSelect(array(
      'multiple' => true,
      'choices' => $associated
      ), array(
      'size' => $size,
      'class' => $this->getOption('class_select').'-selected form-control',
      'ondblclick' => 'sfDoubleList.move(\''.$this->generateId($name).'\', \'unassociated_'.$this->generateId($name).'\'); return false;',
      ));
    $unassociatedWidget = new sfWidgetFormSelect(array(
      'multiple' => true,
      'choices' => $unassociated
      ), array(
      'size' => $size,
      'class' => $this->getOption('class_select').' form-control',
      'ondblclick' => 'sfDoubleList.move(\'unassociated_'.$this->generateId($name).'\', \''.$this->generateId($name).'\'); return false;',
      ));

    return strtr($this->getOption('template'), array(
      '%class%'              => $this->getOption('class'),
      '%class_select%'       => $this->getOption('class_select'),
      '%id%'                 => $this->generateId($name),
      '%label_associated%'   => $this->getOption('label_associated'),
      '%label_unassociated%' => $this->getOption('label_unassociated'),
      '%associate%'          => sprintf(
                                  '<a class="btn btn-block btn-default" href="#" onclick="%s">%s</a>',
                                  'sfDoubleList.move(\'unassociated_'.$this->generateId($name).'\', \''.$this->generateId($name).'\'); return false;',
                                  $this->getOption('associate_icon')),
      '%unassociate%'        => sprintf(
                                  '<a class="btn btn-block btn-default" style="margin-top:10px;" href="#" onclick="%s">%s</a>',
                                  'sfDoubleList.move(\''.$this->generateId($name).'\', \'unassociated_'.$this->generateId($name).'\'); return false;',
                                  $this->getOption('unassociate_icon')),
      '%associated%'         => $associatedWidget->render($name),
      '%unassociated%'       => $unassociatedWidget->render('unassociated_'.$name),
    ));
  }

  /**
   * Gets the JavaScript paths associated with the widget.
   *
   * @return array An array of JavaScript paths
   */
  public function getJavascripts()
  {
    return array('/izarusBootstrap3AdminThemePlugin/js/double_list.js');
  }

  public function __clone()
  {
    if ($this->getOption('choices') instanceof sfCallable)
    {
      $callable = $this->getOption('choices')->getCallable();
      if (is_array($callable))
      {
        $callable[0] = $this;
        $this->setOption('choices', new sfCallable($callable));
      }
    }
  }
}