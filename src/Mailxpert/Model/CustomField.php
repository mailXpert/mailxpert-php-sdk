<?php
/**
 * Date: 21/08/15
 */

namespace Mailxpert\Model;


class CustomField
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $contactListId;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $label;

    /**
     * @var string
     */
    private $alias;

    /**
     * @var string
     */
    private $default;

    /**
     * @var CustomFieldChoiceCollection
     */
    private $choices;

    /**
     * CustomField constructor.
     *
     * @param string      $alias
     * @param string|null $id
     */
    public function __construct($alias, $id = null)
    {
        $this->alias = $alias;
        $this->id = $id;

        $this->choices = new CustomFieldChoiceCollection();
    }

    public function __toString()
    {
        return (string) $this->getAlias();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getContactListId()
    {
        return $this->contactListId;
    }

    /**
     * @param string $contactListId
     */
    public function setContactListId($contactListId)
    {
        $this->contactListId = $contactListId;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    /**
     * @return string
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @param string $default
     */
    public function setDefault($default)
    {
        $this->default = $default;
    }

    /**
     * @return CustomFieldChoiceCollection
     */
    public function getChoices()
    {
        return $this->choices;
    }

    /**
     * @param CustomFieldChoiceCollection $choices
     */
    public function setChoices(CustomFieldChoiceCollection $choices)
    {
        $this->choices = $choices;
    }

    public function toAPI()
    {
        return [
            'contact_list_id' => $this->getContactListId(),
            'type' => $this->getType(),
            'label' => $this->getLabel(),
            'alias' => $this->getAlias(),
            'default' => $this->getDefault()
        ];
    }

    public function fromAPI($data)
    {
        foreach ($data as $field => $value) {
            switch ($field) {
                case 'contact_list_id':
                    $this->setContactListId($value);
                    break;
                case 'type':
                    $this->setType($value);
                    break;
                case 'label':
                    $this->setLabel($value);
                    break;
                case 'alias':
                    $this->setAlias($value);
                    break;
                case 'default':
                    $this->setDefault($value);
                    break;
            }
        }
    }
}