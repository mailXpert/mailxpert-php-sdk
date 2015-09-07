<?php

namespace Mailxpert\Model;

use Mailxpert\Exceptions\MailxpertSDKException;

/**
 * Class SegmentFactory
 * @package Mailxpert\Model
 */
class SegmentFactory extends Factory
{
    /**
     * @param mixed $data
     *
     * @return Segment|SegmentCollection
     * @throws MailxpertSDKException
     */
    public static function parse($data)
    {
        return parent::parse($data);
    }

    /**
     * @param $data
     *
     * @return SegmentCollection
     */
    protected static function buildCollection($data)
    {
        $segments = new SegmentCollection();

        foreach ($data as $segmentData) {
            $segment = static::buildElement($segmentData);
            $segments->add($segment);
        }

        return $segments;
    }

    /**
     * @param $data
     *
     * @return Segment
     */
    protected static function buildElement($data)
    {
        $segment = new Segment($data['id']);
        $segment->fromAPI($data);

        return $segment;
    }
}
