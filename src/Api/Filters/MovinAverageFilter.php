<?php
namespace Src\Api\Filters;

class MovinAverageFilter implements Filter {
    public function filter($object) {
        if ($object->humidity > 50) {
          return null;
        };
        return $object;
    }
}