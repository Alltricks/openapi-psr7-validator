<?php

declare(strict_types=1);

namespace League\OpenAPIValidation\Schema;

use cebe\openapi\spec\Schema;

use function in_array;
use function is_array;

class CheckTypeHelper
{
    static function schemaIsTypeOf(Schema $schema, string $type): bool
    {
        return $schema->type === $type || (is_array($schema->type) && in_array($type, $schema->type));
    }
}