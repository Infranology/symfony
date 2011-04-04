<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Locale;

/**
 * Provides simple utilities towards ext/intl functions.
 */
class IntlUtils
{
    /**
     * Constants named like in ext/intl and ICU source code, represents no error.
     */
    const U_ZERO_ERROR = 0;
    const U_ZERO_ERROR_MESSAGE = 'U_ZERO_ERROR';

    /**
     * Default error name.
     */
    const U_ZERO_ERROR_NAME = 'U_ZERO_ERROR';

    /**
     * Get symbolic name for a given error code
     *
     * @param  int     $errorCode   The ICU error code
     * @return string               The name of the error code constant or IntlUtils::U_ZERO_ERROR_NAME if intl
     *                              extension is not loaded
     */
    static public function getErrorName($errorCode)
    {
        if (static::isIntlExtensionLoaded()) {
            return intl_error_name($errorCode);
        }

        return static::U_ZERO_ERROR_NAME;
    }

    /**
     * Get the last error code
     *
     * @return int   Error code returned by the last API function call or IntlUtils::U_ZERO_ERROR if intl extension
     *               is not loaded
     */
    static public function getErrorCode()
    {
        if (static::isIntlExtensionLoaded()) {
            return intl_get_error_code();
        }

        return static::U_ZERO_ERROR;
    }

    /**
     * Get description of the last error
     *
     * @return string   Error code returned by the last API function call or IntlUtils::U_ZERO_ERROR_MESSAGE if intl
     *                  extension is not loaded
     */
    static public function getErrorMessage()
    {
        if (static::isIntlExtensionLoaded()) {
            return intl_get_error_message();
        }

        return static::U_ZERO_ERROR_MESSAGE;
    }

    /**
     * Check whether the given error code indicates failure
     *
     * @param  int   $errorCode   The ICU error code
     * @return bool               true if the code indicates some failure, and false in case of success, warning or
     *                            if intl extension is not loaded
     */
    static public function isFailure($errorCode)
    {
        if (static::isIntlExtensionLoaded()) {
            return intl_is_failure($errorCode);
        }

        return false;
    }

    /**
     * Check if the intl extension is loaded
     * @return bool
     */
    static private function isIntlExtensionLoaded()
    {
        return extension_loaded('intl');
    }
}
