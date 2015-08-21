<?php
/**
 * Date: 21/08/15
 */

namespace Mailxpert\Model;


class CustomFieldChoiceFactory extends Factory
{
    /**
     * @param $data
     *
     * @return CustomFieldChoice|CustomFieldChoiceCollection
     * @throws \Mailxpert\Exceptions\MailxpertSDKException
     */
    public static function parse($data)
    {
        return parent::parse($data);
    }

    /**
     * @param $data
     *
     * @return CustomFieldChoiceCollection
     */
    protected static function buildCollection($data)
    {
        $customFieldChoices = new CustomFieldChoiceCollection();

        foreach ($data as $customFieldChoiceData) {
            $customFieldChoice = static::buildElement($customFieldChoiceData);
            $customFieldChoices ->add($customFieldChoice);
        }

        return $customFieldChoices;
    }

    /**
     * @param $data
     *
     * @return CustomFieldChoice
     */
    protected static function buildElement($data)
    {
        $customFieldChoice = new CustomFieldChoice($data['alias'], $data['id']);
        $customFieldChoice->fromAPI($data);

        return $customFieldChoice;
    }

}