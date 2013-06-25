<?php

/**
 * Yiic abstract command with common methods to use
 */
class AbstractCommand extends CConsoleCommand
{

	/**
	 * @var boolean
	 */
	public $verbose = 0;

	/**
	 * get help with global options
	 *
	 * @see CConsoleCommand::getHelp()
	 * @return string
	 */
	public function getHelp()
	{
		$help = parent::getHelp();
		$global_options = $this->getGlobalOptions();
		if (!empty($global_options))
		{
			$help .= PHP_EOL . 'Global options:';
			foreach($global_options as $name => $value)
			{
				$help .= PHP_EOL . '    [' . $name . '=' . $value . ']';
			}
		}
		return $help;
	}

	/**
	 * collect global options
	 *
	 * @return array
	 */
	protected function getGlobalOptions()
	{
		$options = array();
		$refl = new ReflectionClass($this);
		$properties = $refl->getProperties(ReflectionProperty::IS_PUBLIC);
		foreach($properties as $property)
		{
			if ($property->getName() != 'defaultAction')
			{
				$options[$property->getName()] =  $property->getValue($this);
			}
		}
		return $options;
	}

	/**
	 * show this information
	 *
	 * @return void
	 */
	public function actionHelp()
	{
		$this->printf("Info: ".$this->getHelp());
	}

	/**
	 * printf with line break
	 *
	 * @see printf()
	 * @return void
	 */
	protected function printf()
	{
		$args = func_get_args(); // PHP 5.2 workaround
		call_user_func_array('printf', $args);
		printf(PHP_EOL);
	}

	/**
	 * output text but only if verbose=true
	 *
	 * @see ClearcacheCommand::printf()
	 * @return void
	 */
	protected function verbose()
	{
		if ($this->verbose)
		{
			$args = func_get_args(); // PHP 5.2 workaround
			call_user_func_array(array($this, 'printf'), $args);
		}
	}
}
