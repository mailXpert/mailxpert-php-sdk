<?php
/**
 * Date: 21/08/15
 */

namespace Mailxpert\Model;

/**
 * Class CustomFieldFactory
 * @package Mailxpert\Model
 */
class CustomFieldFactory extends Factory
{
    /**
     * @param mixed $data
     *
     * @return CustomField|CustomFieldCollection
     * @throws \Mailxpert\Exceptions\MailxpertSDKException
     */
    public static function parse($data)
    {
        return parent::parse($data);
    }

    /**
     * @param $data
     *
     * @return CustomFieldCollection
     */
    protected static function buildCollection($data)
    {
        $customFields = new CustomFieldCollection();

        foreach ($data as $customFieldData) {
            $customField = static::buildElement($customFieldData);
            $customFields ->add($customField);
        }

        return $customFields;
    }

    /**
     * @param $data
     *
     * @return CustomField
     */
    protected static function buildElement($data)
    {
        $customField = new CustomField($data['alias'], $data['id']);
        $customField->fromAPI($data);

        return $customField;
    }
}
