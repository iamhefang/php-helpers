<?php
$name = "php-helpers";

$web = "$name.php";
$cli = "$name.php";

$composerJson = json_decode(file_get_contents("./composer.json"), true);

//$version = date("Y.m.d");
//$version = "SNAPSHOT";
$version = $composerJson["version"];

$fnname = __DIR__ . "/build/$name-$version.phar";
//$fnname = "/mnt/CommonData/DevDir/juewei-cms/libraries/php-mvc-SNAPSHOT.phar";

if (!file_exists(__DIR__ . "/build/")) {
   mkdir(__DIR__ . "/build/", 0777, true);
}

$flags = FilesystemIterator::CURRENT_AS_FILEINFO | FilesystemIterator::KEY_AS_FILENAME;

$indexFile = __DIR__ . "/src/" . $web;
$indexContent = file_get_contents(__DIR__ . "/$name-template.php");
$indexContent = str_replace("!!VERSION!!", $version, $indexContent);


file_put_contents($indexFile, $indexContent);


$phar = new Phar($fnname, $flags, "$name.phar");

$phar->buildFromDirectory(__DIR__ . "/src");

$stub = str_replace(
   "ExtractPhar",
   "ExtractPhar" . md5(microtime() . rand(PHP_INT_MIN, PHP_INT_MAX)),
   file_get_contents("stub_template.php")
);
$stub = str_replace("!!WEB_ENTRY!!", $web, $stub);
$stub = str_replace("!!CLI_ENTRY!!", $cli, $stub);
$phar->setStub($stub);

$phar->compressFiles(Phar::GZ);

echo "已生成文件$fnname\n";


copy($fnname, __DIR__ . "/build/$name-latest.phar");
