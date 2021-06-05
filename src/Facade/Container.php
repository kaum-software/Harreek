<?php

namespace Kaum\Harreek\Facade;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;

class Container
{
    private const DEFAULT_CONTAINERS_NAME = 'Containers';

    /**
     * Get Path by name
     *
     * @param string $name
     * @return array
     */
    public function getPath(string $name): array {
        return \File::directories($this->getSectionPath($name));
    }

    /**
     * Get Section path by name
     *
     * @param string $name
     * @return string
     */
    public function getSectionPath(string $name): string {
        return app_path($this->getDirectoryName() . DIRECTORY_SEPARATOR . $name);
    }

    /**
     * Get Section Names by name
     *
     * @param string $section
     * @return array
     */
    public function getSectionNames(string $section): array {
        $names = [];

        foreach ($this->getPath($section) as $key => $name) {
            $name[] = basename($name);
        }

        return $names;
    }

    /**
     * Get all Container Names
     *
     * @return array
     */
    public function getAllNames(): array {
        $names = [];

        foreach ($this->getAllPaths() as $path) {
            $names[] = basename($path);
        }

        return $names;
    }

    /**
     * Get all section names
     *
     * @return array
     */
    public function getAllSectionNames(): array {
        $names = [];

        foreach ($this->getSectionPaths() as $path) {
            $names[] = basename($path);
        }

        return $names;
    }

    /**
     * Get all section paths
     *
     * @return array
     */
    public function getSectionPaths(): array {
        return \File::directories(app_path($this->getDirectoryName()));
    }

    /**
     * Get the directory name where the containers are located.
     *
     * @return string
     */
    public function getDirectoryName(): string {
        return config('config.porto.containers_name', self::DEFAULT_CONTAINERS_NAME);
    }
}
