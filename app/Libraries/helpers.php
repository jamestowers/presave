<?php
/**
 * Custom global functions
 */

use Illuminate\Support\Str;

/**
 * Sanitize a filename by removing any weird characters
 * @param  String - filename to sanitize
 * @return String - sanitized filename
 */
function santizeFileName($filename)
{
  $ext = pathinfo($filename, PATHINFO_EXTENSION);
  $new_str = preg_replace('/'. preg_quote($ext, '/') . '$/', '', $filename);
  
  return Str::slug($new_str) . '.' . $ext;
}