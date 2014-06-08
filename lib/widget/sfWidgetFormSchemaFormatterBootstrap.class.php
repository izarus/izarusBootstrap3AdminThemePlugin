<?php

class sfWidgetFormSchemaFormatterBootstrap extends sfWidgetFormSchemaFormatter
{
  protected
    $rowFormat                 = "<div class=\"form-group form-group-%name% %error_class%\">\n  %label%\n  <div class=\"col-lg-%fieldcols%\">%field%\n%help%\n%error%</div>\n%hidden_fields%</div>\n",
    $helpFormat                = "<span class=\"help-block\">%help%</span>",
    $errorRowFormat            = "\n%errors%\n",
    $errorListFormatInARow     = "\n%errors%\n",
    $errorRowFormatInARow      = "<div class=\"help-block text-danger\">%error%</div>\n",
    $namedErrorRowFormatInARow = "<div class=\"help-block text-danger\">%name%: %error%</div>\n",
    $decoratorFormat           = "%content%",
    $widgetSchema              = null,
    $translationCatalogue      = null,
    $name                      = null
    ;

  public function __construct(sfWidgetFormSchema $widgetSchema)
  {
    parent::__construct($widgetSchema);
    foreach ($this->getWidgetSchema()->getFields() as $field) {
      if ( !($field instanceof sfWidgetFormInputCheckbox) && !($field instanceof sfWidgetFormChoice && $field->getOption('expanded')))
      {
        if ($field->getAttribute('class')){
          $field->setAttribute('class',$field->getAttribute('class').' form-control');
        } else {
          $field->setAttribute('class','form-control');
        }
      }
      if ($field->hasOption('with_empty')) $field->setOption('with_empty',false);
    }
  }

  public function generateLabel($name, $attributes = array()) {
    $labelName = $this->generateLabelName($name);

    $this->name = $name;

    if (false === $labelName)
    {
      return '';
    }

    if (!isset($attributes['for']))
    {
      $attributes['for'] = $this->widgetSchema->generateId($this->widgetSchema->generateName($name));
    }

    if (isset($attributes['class'])) {
      $attributes['class'] .= ' ';
    } else {
      $attributes['class'] = '';
    }

    $attributes['class'] .= 'col-lg-'.sfConfig::get('app_bootstrap_admin_labelcols',4).' control-label';

    return $this->widgetSchema->renderContentTag('label', $labelName, $attributes);
  }

  public function formatRow($label, $field, $errors = array(), $help = '', $hiddenFields = null)
  {
    return strtr($this->getRowFormat(), array(
      '%label%'         => $label,
      '%error_class%'   => count($errors) ? 'has-error' : '',
      '%field%'         => $field,
      '%error%'         => $this->formatErrorsForRow($errors),
      '%help%'          => $this->formatHelp($help),
      '%hidden_fields%' => null === $hiddenFields ? '%hidden_fields%' : $hiddenFields,
      '%name%'          => $this->name,
      '%fieldcols%'     => sfConfig::get('app_bootstrap_admin_fieldcols',8),
    ));
  }
}
