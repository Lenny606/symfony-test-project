<?php

namespace App\Services;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class CachingService
{
    private string $cachePath = __DIR__ . '../../cache/';

    public function __construct()
    {

    }

    public function exists(string $cacheType, string $fileName): bool
    {
        $fullPath = $this->getFullPathName($cacheType, $fileName);

        $status = false;
        if (file_exists($fullPath)) {
            $status = true;
        }

        return $status;
    }

    public function load(string $cacheType, string $fileName): string
    {
        $fullPath = $this->getFullPathName($cacheType, $fileName);
        $content = '';
        if (file_exists($fullPath)) {
            $content = file_get_contents($fullPath);
        }

        return $content;
    }

    public function save(string $cacheType, string $fileName, string $data): bool
    {
        $this->makeDirIfNotExists($cacheType);

        $fullPath = $this->getFullPathName($cacheType, $fileName);

        return file_put_contents($fullPath, $data);
    }

    public function remove(string $cacheType, string $fileName): bool
    {
        $fullPath = $this->getFullPathName($cacheType, $fileName);

        $status = false;
        if (file_exists($fullPath)) {
            $status = unlink($fullPath);
        }

        return $status;
    }

    public function clearCache(string $cacheType, bool $clearAll = false): bool
    {
        if ($clearAll) {
            rmdir($this->pathName());
            return true;
        }

        $dir = $this->pathName($cacheType);
        if (!is_dir($dir)) {
            return false;
        }

        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($files as $fileinfo) {
            $todo = ($fileinfo->isDir() ? 'rmdir' : 'unlink');
            $todo($fileinfo->getRealPath());
        }

        return true;
    }

    private function pathName(string $cacheType = ""): string
    {
        return $this->cachePath . $cacheType;
    }

    private function getFullPathName(string $cacheType, string $fileName): string
    {
        return sprintf('%s%s', $this->pathName($cacheType), $fileName);
    }

    private function makeDirIfNotExists(string $cacheType): void
    {
        $dir = $this->pathName($cacheType);
        if (!$dir) {
            mkdir($dir, 777, true);
        }

    }
}