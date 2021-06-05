<?php

namespace Kaum\Harreek\Facade;

class Ship
{
    private const DEFAULT_SHIP_NAME = 'Ship';

    /**
     * Get Directory Names inside of the Ship Directory
     *
     * @return array
     */
    public function getFolderNames(): array {
        $names = [];

        foreach ($this->getPath() as $path) {
            $names[] = basename($path);
        }

        return $names;
    }

    /**
     * Get the Path of the Ship
     *
     * @return array
     */
    public function getPath(): array {
        return \File::directories(app_path($this->getDirectoryName()));
    }

    /**
     * Get the Directory Name of the Ship
     *
     * @return string
     */
    public function getDirectoryName(): string {
        return config('config.porto.ship_name', self::DEFAULT_SHIP_NAME);
    }
}
