<?php
/**
 * Date: 21/08/15
 */

namespace Mailxpert\Model;

/**
 * Class CustomFieldChoiceCollection
 * @package Mailxpert\Model
 */
class CustomFieldChoiceCollection extends ArrayCollection
{
    /**
     * @param mixed $offset
     *
     * @return CustomFieldChoice|null
     */
    public function offsetGet($offset)
    {
        return parent::offsetGet($offset);
    }
}
