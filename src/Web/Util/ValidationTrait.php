<?php

namespace Personare\Exchange\Web\Util;

trait ValidationTrait
{
    function validate($array, $keys)
    {
        $messages = [];

        foreach ($keys as $key) {
            if (empty($array[$key])) {
                $messages[] = "Param '{$key}' is required.";
            }
        }

        return $messages;
    }
}
