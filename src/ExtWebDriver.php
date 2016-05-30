<?php
namespace Codeception\Module;

use Codeception\Module\WebDriver;
use Facebook\WebDriver\WebDriverElement;

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
	 * @return WebDriverElement
	 */
	public function getElement($selector)
	{
		$els = $this->_findElements($selector);
		if (!empty($els) && is_array($els)) {
			return reset($els); // return first element
		}

		// nothing was found
		return null;
	}

	/**
	 * Wrapper for WebDriver->_findElements()
	 * @param $selector
	 * @return array
	 */
	public function getElements($selector)
	{
		return $this->_findElements($selector);
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
