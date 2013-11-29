[?php

/**
 * <?php echo $this->getModuleName() ?> module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage <?php echo $this->getModuleName()."\n" ?>
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: helper.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class Base<?php echo ucfirst($this->getModuleName()) ?>GeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? '<?php echo $this->params['route_prefix'] ?>' : '<?php echo $this->params['route_prefix'] ?>_'.$action;
  }

  public function linkToNew($params)
  {
    return link_to('<i class="glyphicon glyphicon-plus"></i> '.__($params['label'], array(), 'sf_admin'), '@'.$this->getUrlForAction('new'), array('class' => 'btn btn-info'));
  }

  public function linkToEdit($object, $params)
  {
    return link_to(__($params['label'], array(), 'sf_admin'), $this->getUrlForAction('edit'), $object, array('class' => 'btn btn-primary'));
  }

  public function linkToDelete($object, $params)
  {
    if ($object->isNew())
    {
      return '';
    }

    return link_to(__($params['label'], array(), 'sf_admin'), $this->getUrlForAction('delete'), $object, array('method' => 'delete', 'confirm' => !empty($params['confirm']) ? __($params['confirm'], array(), 'sf_admin') : $params['confirm'], 'class' => 'btn btn-danger'));
  }

  public function linkToList($params)
  {
    return link_to(__($params['label'], array(), 'sf_admin'), '@'.$this->getUrlForAction('list'), array('class' => 'btn btn-default'));
  }

  public function linkToSave($object, $params)
  {
    return '<button type="submit" class="btn btn-primary">'.__($params['label'], array(), 'sf_admin').'</button>';
  }

  public function linkToSaveAndAdd($object, $params)
  {
    if (!$object->isNew())
    {
      return '';
    }

    return '<button type="submit" value="'.__($params['label'], array(), 'sf_admin').'" name="_save_and_add" class="btn btn-primary">'.__($params['label'], array(), 'sf_admin').'</button>';
  }
}
