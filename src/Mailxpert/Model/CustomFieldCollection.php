<?php
/**
 * Date: 21/08/15
 */

namespace Mailxpert\Model;

/**
 * Class CustomFieldCollection
 * @package Mailxpert\Model
 */
class CustomFieldCollection extends ArrayCollection
{
    /**
     * @param mixed $offset
     *
     * @return CustomField|null
     */
    public function offsetGet($offset)
    {
        return parent::offsetGet($offset);
    }

    /**
     * @param string $alias
     *
     * @return CustomFieldCollection
     */
    public function findByAlias($alias)
    {
        return $this->filter(
            function (CustomField $element) use ($alias) {
                return $element->getAlias() == $alias;
            }
        );
    }

    /**
     * @param string $alias
     *
     * @return CustomField
     */
    public function getByAlias($alias)
    {
        $elements = $this->findByAlias($alias);

        return $elements->first();
    }
}
