<?php
/**
 * Created by PhpStorm.
 * User: lidz
 * Date: 2020-09-23
 * Time: 15:00
 */

namespace App\Exceptions;

use Exception;

class ApiException extends Exception {

    public function __construct($message, $code = 400) {
        parent::__construct($message, $code, null);
    }
}
