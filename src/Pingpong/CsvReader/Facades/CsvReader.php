<?php namespace Pingpong\CsvReader\Facades;

use Pingpong\CsvReader\CsvReader;

class CsvReader {
	
	/**
	 * Make new instance of \Pingpong\CsvReader\CsvReader
	 * 
	 * @param  string $file 
	 * @return \Pingpong\CsvReader\CsvReader
	 */
	public static function make($file)
	{
		return new CsvReader($file);
	}

	/**
	 * Make new instance of \Pingpong\CsvReader\CsvReader
	 * 
	 * @param  string $file 
	 * @return \Pingpong\CsvReader\CsvReader
	 */
	public static function get($file)
	{
		return CsvReader::get($file);
	}

} 