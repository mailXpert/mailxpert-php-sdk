<?php

namespace Mailxpert\Model;

/**
 * Class SegmentCollection
 * @package Mailxpert\Model
 */
class SegmentCollection extends ArrayCollection
{
    /**
     * @param mixed $offset
     *
     * @return Segment|null
     */
    public function offsetGet($offset)
    {
        return parent::offsetGet($offset);
    }

    /**
     * @param Segment $segment
     *
     * @return void
     */
    public function add($segment)
    {
        if (!$this->exists(
            function ($key, Segment $element) use ($segment) {
                return $segment->getId() == $element->getId();
            }
        )
        ) {
            parent::add($segment);
        }
    }

    /**
     * @param integer $id
     *
     * @return Segment|null
     */
    public function findById($id)
    {
        $contacts = $this->filter(function (Segment $element) use ($id) {
            return $element->getId() == $id;
        });

        return $contacts->first();
    }
}
