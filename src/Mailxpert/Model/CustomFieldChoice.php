<?php
/**
 * Date: 21/08/15
 */

namespace Mailxpert\Model;

/**
 * Class CustomFieldChoice
 * @package Mailxpert\Model
 */
class CustomFieldChoice
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $label;

    /**
     * @var string
     */
    private $alias;

    /**
     * @var int
     */
    private $position;

    /**
     * @var boolean
     */
    private $checked;

    /**
     * CustomFieldChoice constructor.
     *
     * @param string      $alias
     * @param string|null $id
     */
    public function __construct($alias, $id = null)
    {
        $this->alias = $alias;
        $this->id = $id;
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
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = (int) $position;
    }

    /**
     * @return boolean
     */
    public function isChecked()
    {
        return $this->checked;
    }

    /**
     * @param boolean $checked
     */
    public function setChecked($checked)
    {
        if (!is_bool($checked)) {
            if ($checked === 0 || $checked == 'false') {
                $checked = false;
            } else {
                $checked = true;
            }
        }

        $this->checked = $checked;
    }

    /**
     * @return array
     */
    public function toAPI()
    {
        return [
            'label' => $this->getLabel(),
            'alias' => $this->getAlias(),
            'position' => $this->getPosition(),
            'checked' => ($this->isChecked()) ? 'true' : 'false',
        ];
    }

    /**
     * @param array $data
     */
    public function fromAPI($data)
    {
        foreach ($data as $field => $value) {
            switch ($field) {
                case 'label':
                    $this->setLabel($value);
                    break;
                case 'alias':
                    $this->setAlias($value);
                    break;
                case 'position':
                    $this->setPosition($value);
                    break;
                case 'checked':
                    $this->setChecked($value);
                    break;
            }
        }
    }
}
