<?php
/**
 * Created by IntelliJ IDEA.
 * User: hefang
 * Date: 2018/12/4
 * Time: 08:42
 */

namespace link\hefang\helpers;
defined("PHP_HELPERS") or die(1);

class FileHelper
{
    public static function listFilesAndDirs(string $rootDir, callable $filter = null): array
    {
        if (!is_dir($rootDir)) return [];
        $res = [];
        $items = scandir($rootDir);
        foreach ($items as $item) {
            if ($item === "." || $item === "..") continue;
            $file = $rootDir . DS . $item;
            if (!is_callable($filter) || $filter($file)) {
                $res[] = $file;
            }
            if (is_dir($file)) {
                $sub = self::listFilesAndDirs($file);
                if (!empty($sub)) {
                    $res = array_merge($res, $sub);
                }
            }
        }
        return $res;
    }

    public static function listFiles(string $rootDir, callable $filter = null): array
    {
        $array = self::listFilesAndDirs($rootDir, function (string $file) {
            return is_file($file);
        });
        return is_callable($filter) ? array_filter($array, $filter) : $array;
    }

    public static function listDirs(string $rootDir, callable $filter = null): array
    {
        $array = self::listFilesAndDirs($rootDir, function (string $file) {
            return is_dir($file);
        });
        return is_callable($filter) ? array_filter($array, $filter) : $array;
    }

    public static function delete(string $fileOrDir): int
    {
        if (is_dir($fileOrDir)) {
            return self::cleanDir($fileOrDir) + (rmdir($fileOrDir) ? 1 : 0);
        }
        return unlink($fileOrDir) ? 1 : 0;
    }

    public static function cleanDir(string $dir)
    {
        $files = array_reverse(self::listFilesAndDirs($dir));
        $count = 0;
        foreach ($files as $file) {
            if (is_dir($file)) {
                $count += (rmdir($file) ? 1 : 0);
            } else {
                $count += (unlink($file) ? 1 : 0);
            }
        }
        return $count;
    }

    private function __construct()
    {
    }
}