<?php

declare(strict_types=1);

namespace League\OpenAPIValidation\Schema\Keywords;

use cebe\openapi\spec\Schema as CebeSchema;
use League\OpenAPIValidation\Schema\Exception\KeywordMismatch;

use function array_diff;
use function implode;
use function sprintf;

class UnevaluatedProperties extends BaseKeyword
{
    /**
     * @param mixed        $data
     * @param CebeSchema[] $collectionsMatched
     */
    public function validate($data, array $collectionsMatched): void
    {
        $allProperties = $this->getProperties($this->parentSchema, $collectionsMatched);
        $unexpectedProps = array_diff(array_keys($data), $allProperties);
        if (!empty($unexpectedProps)) {
            throw KeywordMismatch::fromKeyword(
                'unevaluatedProperties',
                $data,
                sprintf('Data has unevaluated properties (%s) which are not allowed', implode(',', $unexpectedProps)),
            );
        }
    }

    /**
     * @param CebeSchema[] $collectionsMatched
     *
     * @return array<string,string>
     */
    private function getProperties(CebeSchema $schema, array $collectionsMatched = []): array
    {
        $allProperties = [];
        if (isset($schema->properties)) {
            foreach ($schema->properties as $propName => $propSchema) {
                $allProperties[$propName] = $propName;
            }
        }
        foreach ($collectionsMatched as $matched) {
            $allProperties = $allProperties + $this->getProperties($matched);
        }

        return $allProperties;
    }
}
