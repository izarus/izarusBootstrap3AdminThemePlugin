<?php

class sfWidgetFormSchemaFormatterBootstrap extends sfWidgetFormSchemaFormatter
{
  protected
    $rowFormat                 = "<div class=\"form-group control-type-%type% control-name-%name% %error_class%\">\n  %label%\n  <div class=\"col-lg-%parentcols%\">%field%</div>\n<div class=\"col-lg-offset-%labelcols% col-lg-%fieldcols%\">%help%\n%error%</div>\n</div>\n%hidden_fields%\n",
    $helpFormat                = "<span class=\"help-block\">%help%</span>",
    $errorRowFormat            = "\n%errors%\n",
    $errorListFormatInARow     = "\n%errors%\n",
    $errorRowFormatInARow      = "<div class=\"text-danger\">%error%</div>\n",
    $namedErrorRowFormatInARow = "<div class=\"text-danger\">%name%: %error%</div>\n",
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
    if(empty($field))
      $label = '';
    
    if(strpos($label,'<label')===false)
      $this->setRowFormat('<div class="hide">'.$this->getRowFormat().'</div>');
    
    $doc = new DOMDocument();
    @$doc->loadHTML($field);
    $xpath = new DOMXPath($doc);
    $pclass = $xpath->evaluate("string(//*/@data-parent-cols)");
    
    $type = strtolower(str_replace(array('sfWidgetForm','Input'),'',get_class($this->widgetSchema[$this->name])));
    if(get_class($this->widgetSchema[$this->name])==get_class($this) || empty($type))
      $type = 'field';
    
    $name = $this->name;
    $this->name = '';
    $name = (empty($name))?'field':$name;   
    
    return strtr($this->getRowFormat(), array(
      '%label%'         => $label,
      '%error_class%'   => count($errors) ? 'has-error' : '',
      '%field%'         => $field,
      '%error%'         => $this->formatErrorsForRow($errors),
      '%help%'          => $this->formatHelp($help),
      '%hidden_fields%' => null === $hiddenFields ? '%hidden_fields%' : $hiddenFields,
      '%name%'          => $name,
      '%type%'          =>  $type,
      '%parentcols%'     => (!empty($pclass))?$pclass:sfConfig::get('app_bootstrap_admin_fieldcols',8),
      '%labelcols%'     => sfConfig::get('app_bootstrap_admin_labelcols',4),
      '%fieldcols%'     => sfConfig::get('app_bootstrap_admin_fieldcols',8),
    ));
  }
} 
