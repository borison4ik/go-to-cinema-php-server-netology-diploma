<?php

namespace App\Http\Utils;

class IndexToKey {
    public static function get($obj) {
        return $obj->mapWithKeys(fn($item) => [$item['id'] => $item])->all();
    }
}