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

	/**
	 * @param $selector
	 * @return array|mixed
	 */
	public function getElement($selector)
	{
		$els = $this->_findElements($selector);
		return $els ? reset($els) : $els;
	}

	/**
	 * @param $selector
	 * @throws \Exception
	 */
	public function clickElement($selector)
	{
		$el = $this->getElement($selector);

		if ($el) {
			$el->click();
		} else {
			throw new \Exception('Element can\'t be found: "' . $selector . '"');
		}
	}
}
