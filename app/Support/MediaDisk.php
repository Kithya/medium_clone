<?php

namespace App\Support;

class MediaDisk
{
    public static function name(): string
    {
        $disk = config('filesystems.default');

        return $disk === 'local' ? 'public' : $disk;
    }
}
