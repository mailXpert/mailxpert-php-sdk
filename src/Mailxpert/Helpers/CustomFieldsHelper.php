<?php
/**
 * Date: 21/08/15
 */

namespace Mailxpert\Helpers;

use Mailxpert\Mailxpert;
use Mailxpert\Model\CustomFieldCollection;
use Mailxpert\Request\CustomFieldsChoicesRequest;

/**
 * Class CustomFieldsHelper
 * @package Mailxpert\Helpers
 */
class CustomFieldsHelper
{
    /**
     * @param Mailxpert             $mailxpert
     * @param CustomFieldCollection $customFields
     */
    public static function loadChoices(Mailxpert $mailxpert, CustomFieldCollection $customFields)
    {
        foreach ($customFields as $customField) {
            if (in_array($customField->getType(), ['choice', 'choice_multiple', 'choice_expanded'])) {
                $response = CustomFieldsChoicesRequest::get($mailxpert, $customField->getId());

                $customField->setChoices($response->getMailxpertNode());
            }
        }
    }
}
