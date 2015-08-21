<?php
/**
 * Date: 21/08/15
 */

namespace Mailxpert\Model;


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
     * @param $alias
     *
     * @return CustomFieldCollection
     */
    public function findByAlias($alias)
    {
        return $this->filter(function ($element) use ($alias) {
           return $element->getAlias() == $alias;
        });
    }

    /**
     * @param $alias
     *
     * @return CustomField
     */
    public function getByAlias($alias)
    {
        $elements = $this->findByAlias($alias);

        return $elements->first();
    }
}