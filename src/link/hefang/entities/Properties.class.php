<?php

namespace link\hefang\entities;
defined("PHP_HELPERS") or die(1);

use link\hefang\exceptions\FileNotFoundException;
use link\hefang\exceptions\IOException;
use link\hefang\helpers\StringHelper;

class Properties
{
   private $map = [];
   private $defaults = null;

   /**
    * Properties constructor.
    * @param Properties $default
    */
   public function __construct(Properties $default = null)
   {
      $this->defaults = $default;
   }

   public function setProperty(string $key, string $value)
   {
      $this->map[$key] = $value;
   }

   /**
    * @param string $filename
    * @throws IOException
    */
   public function loadFile(string $filename)
   {
      if (!file_exists($filename)) throw new FileNotFoundException($filename);
      $text = file_get_contents($filename);
      $this->loadText($text);
   }

   public function loadText(string $text)
   {
      $content = trim($text);
      $lines = explode("\n", $content);
      foreach ($lines as $line) {
         $kv = explode("=", $line);
         if (count($kv) < 2) {
            continue;
         }
         $this->map[$kv[0]] = $kv[1];
      }
   }

   public function save(string $filename, string $comments = null)
   {
      try {
         $this->store($filename, $comments);
      } catch (IOException $e) {
      }
   }

   /**
    * @param string $filename
    * @param string|null $comments
    * @throws IOException
    */
   public function store(string $filename, string $comments = null)
   {
      if (is_file($filename) && !is_writable($filename)) {
         throw new IOException("文件'$filename'不可写且不可写");
      }
      $text = $comments ? "# $comments\n" : "";
      $text .= "#" . date("Y-m-d H:i:s") . "\n";
      foreach ($this->map as $key => $value) {
         $text .= "$key=$value\n";
      }
      $res = file_put_contents($filename, $text);
      if (!$res) throw new IOException($filename);
   }

   /**
    * @param string $key
    * @param string|null $defaultValue
    * @return null|string
    */
   public function getProperty(string $key, string $defaultValue = null)
   {
      $value = array_key_exists($key, $this->map) ? $this->map[$key] :
         ($this->defaults === null ? $defaultValue : $this->defaults->getProperty($key, $defaultValue));
      return StringHelper::isNullOrBlank($value) ? $defaultValue : $value;
   }

   public function propertyNames()
   {
      return array_keys($this->map);
   }

}
