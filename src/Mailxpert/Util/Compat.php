<?php
namespace Mailxpert\Util;

/**
 * Date: 20/08/15
 */
class Compat
{
    /**
     * Due to a conception mistake, the access token was returned with some POST request in the early stage of MX API V2.0 and was removed from it.
     * This patch fix potential access_token present in the header Location
     *
     * @param string $url
     *
     * @return string
     */
    public static function cleanHeaderLocation($url)
    {
        $urlElements = parse_url($url);

        parse_str($urlElements['query'], $query);

        if (isset($query['access_token'])) {
            unset($query['access_token']);
        }

        $newUrl = sprintf('%s://%s%s', $urlElements['scheme'], $urlElements['host'], $urlElements['path']);

        if (count($query)) {
            $newUrl .= '?'.http_build_query($query);
        }

        return $newUrl;
    }
}
