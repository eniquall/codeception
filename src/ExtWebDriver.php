<?php
namespace Codeception\Module;

use Codeception\Module\WebDriver;

class ExtWebDriver extends WebDriver
{
	/**
	 * Public version of protected WebDriver->findElement()
	 * @param $selector
	 * @return mixed
	 */
	public function getField($selector)
	{
		$arr = $this->findFields($selector);
		return reset($arr);
	}
}