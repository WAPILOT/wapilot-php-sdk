<?php

namespace Wapilot\SDK\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array getContacts()
 * @method static array createContact(array $contactData)
 * @method static array updateContact(string $uuid, array $contactData)
 * @method static array deleteContact(string $uuid)
 * @method static array getContactGroups()
 * @method static array createContactGroup(array $groupData)
 * @method static array updateContactGroup(string $uuid, array $groupData)
 * @method static array deleteContactGroup(string $uuid)
 * @method static array getCannedReplies()
 * @method static array createCannedReply(array $replyData)
 * @method static array updateCannedReply(string $uuid, array $replyData)
 * @method static array deleteCannedReply(string $uuid)
 * @method static array sendMessage(array $messageData)
 * @method static array sendMediaMessage(array $mediaData)
 * @method static array sendTemplateMessage(array $templateData)
 * @method static array getTemplates()
 */
class Wapilot extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'wapilot';
    }
}
