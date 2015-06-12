  protected function getConfig()
  {
    $configuration = parent::getConfig();
    $configuration['show'] = $this->getFieldsShow();
    return $configuration;
  }

  protected function compile()
  {
    parent::compile();

    $config = $this->getConfig();

    // add configuration for the show view
    $this->configuration['show'] = array( 'fields'         => array(),
                                          'title'          => $this->getShowTitle(),
                                          'actions'        => $this->getShowActions(),
                                          'display'        => $this->getShowDisplay(),
                                        ) ;

    foreach (array('show') as $context)
    {
      foreach ($this->configuration[$context]['actions'] as $action => $parameters)
      {
        $this->configuration[$context]['actions'][$action] = $this->fixActionParameters($action, $parameters);
      }
    }


  }

  public function getShowActions()
  {
    return <?php echo $this->asPhp(isset($this->config['show']['actions']) ? $this->config['show']['actions'] : array('_list' => NULL, '_delete' => NULL, '_edit' => NULL)) ?>;
<?php unset($this->config['show']['actions']) ?>
  }


  public function getShowTitle()
  {
    return '<?php echo isset($this->config['show']['title']) ? $this->config['show']['title'] : 'View '.sfInflector::humanize($this->getModuleName()) ?>';
<?php unset($this->config['show']['title']) ?>
  }

public function getShowDisplay()
  {
    return <?php echo $this->asPhp(isset($this->config['show']['display']) ? $this->config['show']['display'] : array() ) ?>;
<?php unset($this->config['show']['display']) ?>
  }