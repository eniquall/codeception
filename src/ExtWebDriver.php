<?php
namespace Codeception\Module;

use Codeception\TestCase;
use Facebook\WebDriver\WebDriverElement;

class ExtWebDriver extends \Codeception\Module\WebDriver
{
	public $sessionId;
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

	public function getSessionID()
	{
		return $this->sessionId;
	}

	// save sessionId before it will be unset by parent::_after()
	public function _afterSuite()
	{
		$this->sessionId = $this->sessionId ?: $this->webDriver->getSessionID();
		parent::_afterSuite();
	}

	// save sessionId before it will be unset by parent::_after()
	public function _after(TestCase $test)
	{
		$this->sessionId = $this->sessionId ?: $this->webDriver->getSessionID();
		parent::_afterSuite($test);
	}
}
