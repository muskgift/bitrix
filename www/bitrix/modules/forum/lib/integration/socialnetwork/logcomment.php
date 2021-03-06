<?php
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage forum
 * @copyright 2001-2012 Bitrix
 */
namespace Bitrix\Forum\Integration\Socialnetwork;

use Bitrix\Forum\MessageTable;
use Bitrix\Main\Event;
use Bitrix\Main\EventResult;
use Bitrix\Socialnetwork\Item\LogIndex;

class LogComment
{
	const EVENT_ID_FORUM_COMMENT = 'forum';
	const EVENT_ID_TASKS_COMMENT = 'tasks_comment';
	const EVENT_ID_CALENDAR_COMMENT = 'calendar_comment';

	public static function getEventIdList()
	{
		return array(
			self::EVENT_ID_FORUM_COMMENT,
			self::EVENT_ID_TASKS_COMMENT,
			self::EVENT_ID_CALENDAR_COMMENT
		);
	}

	/**
	 * Return content for LogIndex.
	 *
	 * @param Event $event Event from LogIndex::setIndex().
	 * @return EventResult
	 */
	public static function onIndexGetContent(Event $event)
	{
		$result = new EventResult(
			EventResult::UNDEFINED,
			array(),
			'forum'
		);

		$eventId = $event->getParameter('eventId');
		$sourceId = $event->getParameter('sourceId');

		if (!in_array($eventId, self::getEventIdList()))
		{
			return $result;
		}

		$content = "";
		$message = false;

		if (intval($sourceId) > 0)
		{
			$select = (
				\Bitrix\Main\Config\Option::get('disk', 'successfully_converted', false)
				&& \Bitrix\Main\ModuleManager::isModuleInstalled('disk')
				? array('*', 'UF_FORUM_MESSAGE_DOC')
				: array('*')
			);

			$res = MessageTable::getList(array(
				'filter' => array(
					'=ID' => $sourceId
				),
				'select' => $select
			));
			$message = $res->fetch();
		}

		if ($message)
		{
			$content .= LogIndex::getUserName($message["AUTHOR_ID"])." ";
			$content .= \forumTextParser::clearAllTags($message['POST_MESSAGE']);

			if (!empty($message['UF_FORUM_MESSAGE_DOC']))
			{
				$fileNameList = LogIndex::getDiskUFFileNameList($message['UF_FORUM_MESSAGE_DOC']);
				if (!empty($fileNameList))
				{
					$content .= ' '.join(' ', $fileNameList);
				}
			}
		}

		$result = new EventResult(
			EventResult::SUCCESS,
			array(
				'content' => $content,
			),
			'forum'
		);

		return $result;
	}
}

