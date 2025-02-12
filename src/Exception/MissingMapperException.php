<?php

namespace G4\DataRepository\Exception;

use Exception;
use G4\DataRepository\ErrorCodes;

class MissingMapperException extends Exception
{

    final public const MESSAGE = 'Expected mapper  \G4\DataRepository\MapperCollection.';

    public function __construct()
    {
        parent::__construct(self::MESSAGE, ErrorCodes::MISSING_MAPPER_INSTANCE_EXCEPTION);
    }
}
