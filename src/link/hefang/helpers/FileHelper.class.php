<?php

namespace link\hefang\helpers;
defined("PHP_HELPERS") or die(1);

final class FileHelper
{
    /**
     * 列出目录内的子目录和文件
     * @param string $rootDir 根目录
     * @param callable|null $filter 过滤器
     *
     * 如只列出'a'开头的文件和目录: function(string $file){return $file{0} === "a";}
     * @return array
     */
    public static function listFilesAndDirs(string $rootDir, callable $filter = null): array
    {
        if (!is_dir($rootDir)) return [];
        $res = [];
        if ($rootDir{strlen($rootDir) - 1} !== DIRECTORY_SEPARATOR) {
            $rootDir = $rootDir . DIRECTORY_SEPARATOR;
        }
        $items = scandir($rootDir);
        foreach ($items as $item) {
            if ($item === "." || $item === "..") continue;
            $file = $rootDir . $item;
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

    /**
     * 列出目录内的所有文件
     * @param string $rootDir 根目录
     * @param callable|null $filter 过滤器
     * @return array
     */
    public static function listFiles(string $rootDir, callable $filter = null): array
    {
        $array = self::listFilesAndDirs($rootDir, function (string $file) {
            return is_file($file);
        });
        return is_callable($filter) ? array_filter($array, $filter) : $array;
    }

    /**
     * 列出目录内的所有子目录
     * @param string $rootDir 根目录
     * @param callable|null $filter 过滤器
     * @return array
     */
    public static function listDirs(string $rootDir, callable $filter = null): array
    {
        $array = self::listFilesAndDirs($rootDir, function (string $file) {
            return is_dir($file);
        });
        return is_callable($filter) ? array_filter($array, $filter) : $array;
    }

    /**
     * 删除文件或目录, 或是文件则直接删除, 若是目录则删除目录本身以及目录内所有文件和子目录
     * @param string $fileOrDir 要删除的文件或目录
     * @return int 删除的文件和目录数
     */
    public static function delete(string $fileOrDir): int
    {
        if (is_dir($fileOrDir)) {
            return self::cleanDir($fileOrDir) + (rmdir($fileOrDir) ? 1 : 0);
        }
        return unlink($fileOrDir) ? 1 : 0;
    }

    /**
     * 清空目录, 不删除目录本身
     * @param string $dir 要清空的目录
     * @return int 删除的文件和子目录数
     */
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

    /**
     * 如果目录以 DIRECTORY_SEPARATOR 结尾, 返回原目录, 否则返回以DIRECTORY_SEPARATOR结尾的目录
     * @param string $dir 目录
     * @return string 结果
     */
    public static function appendDirSeparator(string $dir)
    {
        if ($dir{strlen($dir) - 1} === DIRECTORY_SEPARATOR) return $dir;
        return $dir . DIRECTORY_SEPARATOR;
    }

    private function __construct()
    {
    }
}