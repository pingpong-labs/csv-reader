<?php namespace Pingpong\CsvReader;

use Countable;
use ArrayAccess;
use IteratorAggregate;
use Illuminate\Support\Collection;
use Illuminate\Support\Contracts\JsonableInterface;
use Illuminate\Support\Contracts\ArrayableInterface;

class CsvReader implements ArrayableInterface, JsonableInterface, IteratorAggregate, Countable, ArrayAccess {
	
	/**
	 * File path will be used.
	 * 
	 * @var string
	 */
	protected $file;

	/**
	 * Results data.
	 * 
	 * @var array
	 */
	protected $data = array();

	/**
	 * @var mixed
	 */
	protected $handle;

	/**
	 * The constructor.
	 * 
	 * @param string $file 
	 */
	public function __construct($file)
	{
		$this->file = $file;
		$this->init();
	}

	/**
	 * Make new instance using static style.
	 * 
	 * @param  string $file 
	 * @return self       
	 */
	public static function make($file)
	{
		return new static($file);
	}

	/**
	 * Alias for "make" method.
	 * 
	 * @param  string $file 
	 * @return self       
	 */
	public static function get($file)
	{
		return static::make($file);	
	}

	/**
	 * Open the file.
	 * 
	 * @return self 
	 */
	public function open()
	{
		$this->handle = fopen($this->file, 'r');

		return $this;
	}

	/**
	 * Close the file.
	 * 
	 * @return void 
	 */
	public function close()
	{
		fclose($this->handle);
	}

	/**
	 * Fetch the csv data and save that to array data.
	 * 
	 * @return self 
	 */
	public function each()
	{
		while ( ! feof($this->handle))
		{
			$this->data[] = fgetcsv($this->handle);
		}

		return $this;
	}

	/**
	 * Get array data.
	 * 
	 * @return \Illuminate\Support\Collection
	 */
	public function getData()
	{
		return new Collection($this->data);
	}

	/**
	 * Initialize the data.
	 * 
	 * @return self 
	 */
	public function init()
	{
		return $this->open()->each()->close();
	}

	/**
	 * Convert current data to array.
	 * 
	 * @return array 
	 */
	public function toArray()
	{
		return (array) $this->getData();
	}

	/**
	 * Convert current data to json.
	 * 
	 * @return string 
	 */
	public function toJson($options = 0)
	{
		return json_encode($this->toArray(), $options);
	}

	/**
	 * Convert current data to object.
	 * 
	 * @return object 
	 */
	public function toObject()
	{
		return (object) $this->toArray();
	}

	/**
	 * Get iterator.
	 * 
	 * @return \Illuminate\Support\Collection 
	 */
	public function getIterator()
	{
		return $this->getData();
	}

	/**
	 * Get count of data
	 * 
	 * @return int 
	 */
	public function count()
	{
		return $this->getData()->count();
	}

	/**
	 * ArrayAccess::offsetGet.
	 * 
	 * @param  string $key 
	 * @return mixed      
	 */
	public function offsetGet($key)
	{
		return $this->getData()->get($key);
	}

	/**
	 * ArrayAccess::offsetExists.
	 * 
	 * @param  string $key 
	 * @return boolean      
	 */
	public function offsetExists($key)
	{
		return isset($this->data[$key]);
	}

	/**
	 * ArrayAccess::offsetSet.
	 * 
	 * @param  string $key 
	 * @return void      
	 */
	public function offsetSet($key, $value)
	{
		$this->data[$key] = $value;
	}

	/**
	 * ArrayAccess::offsetUnset.
	 * 
	 * @param  string $key 
	 * @return void      
	 */
	public function offsetUnset($key)
	{
		if($this->offsetExists($key))
		{
			unset($this->data[$key]);
		}
	}

} 
