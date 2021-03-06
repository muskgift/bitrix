<?php

namespace Bitrix\Sale\Cashbox;

use Bitrix\Main;
use Bitrix\Main\NotImplementedException;
use Bitrix\Sale\Result;

abstract class Cashbox
{
	const EVENT_ON_GET_CUSTOM_CASHBOX_HANDLERS = 'OnGetCustomCashboxHandlers';

	/** @var array $fields */
	private $fields = array();

	/**
	 * @return void
	 */
	public static function init()
	{
		$handlers = static::getHandlerList();
		Main\Loader::registerAutoLoadClasses(null, $handlers);
	}

	/**
	 * @return array
	 */
	public static function getHandlerList()
	{
		static $handlerList = array();

		if (!$handlerList)
		{
			$handlerList = array(
				'\Bitrix\Sale\Cashbox\CashboxBitrix' => '/bitrix/modules/sale/lib/cashbox/cashboxbitrix.php',
				'\Bitrix\Sale\Cashbox\Cashbox1C' => '/bitrix/modules/sale/lib/cashbox/cashbox1c.php',
				'\Bitrix\Sale\Cashbox\CashboxAtolFarm' => '/bitrix/modules/sale/lib/cashbox/cashboxatolfarm.php'
			);

			$event = new Main\Event('sale', static::EVENT_ON_GET_CUSTOM_CASHBOX_HANDLERS);
			$event->send();
			$resultList = $event->getResults();

			if (is_array($resultList) && !empty($resultList))
			{
				foreach ($resultList as $eventResult)
				{
					/** @var  Main\EventResult $eventResult */
					if ($eventResult->getType() === Main\EventResult::SUCCESS)
					{
						$params = $eventResult->getParameters();
						if (!empty($params) && is_array($params))
							$handlerList = array_merge($handlerList, $params);
					}
				}
			}
		}

		return $handlerList;
	}

	/**
	 * @param array $settings
	 * @return Cashbox|null
	 */
	public static function create(array $settings)
	{
		static::init();

		$handler = $settings['HANDLER'];
		if (class_exists($handler))
			return new $handler($settings);

		return null;
	}

	/**
	 * Base constructor.
	 * @param $settings
	 */
	private function __construct($settings)
	{
		$this->fields = $settings;
	}

	/**
	 * @param $name
	 * @return mixed
	 */
	public function getField($name)
	{
		return $this->fields[$name];
	}

	/**
	 * @return Ofd|null
	 */
	public function getOfd()
	{
		static $ofd = null;

		if ($ofd === null)
		{
			$handler = $this->getField('OFD');
			if (class_exists($handler))
			{
				$testMode = $this->getField('OFD_TEST_MODE') === 'Y';
				$ofd = Ofd::create($handler, $testMode);
			}
		}

		return $ofd;
	}

	/**
	 * @param Check $check
	 * @return Result
	 */
	abstract public function buildCheckQuery(Check $check);

	/**
	 * @param $id
	 * @return array
	 */
	abstract public function buildZReportQuery($id);

	/**
	 * @throws NotImplementedException
	 * @return string
	 */
	public static function getName()
	{
		throw new NotImplementedException();
	}

	/**
	 * @param $name
	 * @param $code
	 * @return mixed
	 */
	public function getValueFromSettings($name, $code = null)
	{
		$map = $this->fields['SETTINGS'];
		if (isset($map[$name]))
		{
			if (is_array($map[$name]))
			{
				if (isset($map[$name][$code]))
					return $map[$name][$code];
			}
			else
			{
				return $map[$name];
			}
		}

		return null;
	}

	/**
	 * @param array $linkParams
	 * @return string
	 */
	public function getCheckLink(array $linkParams)
	{
		if ($linkParams)
		{
			/** @var Ofd $ofd */
			$ofd = $this->getOfd();
			if ($ofd !== null)
				return $ofd->generateCheckLink($linkParams);
		}

		return '';
	}

	/**
	 * @param $errorCode
	 * @throws NotImplementedException
	 * @return int
	 */
	protected static function getErrorType($errorCode)
	{
		throw new NotImplementedException();
	}

	/**
	 * @param array $data
	 * @throws NotImplementedException
	 * @return array
	 */
	protected static function extractCheckData(array $data)
	{
		throw new NotImplementedException();
	}

	/**
	 * @param array $data
	 * @throws NotImplementedException
	 * @return array
	 */
	protected static function extractZReportData(array $data)
	{
		throw new NotImplementedException();
	}

	/**
	 * @param array $data
	 * @return Result
	 */
	public static function applyCheckResult(array $data)
	{
		$result = static::extractCheckData($data);

		return CheckManager::savePrintResult($result['ID'], $result);
	}

	/**
	 * @param array $data
	 * @return Result
	 */
	public static function applyZReportResult(array $data)
	{
		$result = static::extractZReportData($data);

		return ReportManager::saveZReportPrintResult($result['ID'], $result);
	}

	/**
	 * @param int $modelId
	 * @return array
	 */
	public static function getSettings($modelId = 0)
	{
		return array();
	}


	/**
	 * @param $data
	 * @return Result
	 */
	public static function validateSettings($data)
	{
		return new Result();
	}
}