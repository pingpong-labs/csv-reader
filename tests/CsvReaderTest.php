<?php

use Pingpong\CsvReader\CsvReader;

class CsvReaderTest extends PHPUnit_Framework_TestCase {
	
	public function setUp()
	{
		$this->csvReader = new CsvReader(__DIR__ . '/test.csv');
	}

	public function test_initialize()
	{
		$this->assertInstanceOf('Pingpong\CsvReader\CsvReader', $this->csvReader);
		$this->assertInstanceOf('Illuminate\Support\Collection', $this->csvReader->getData());
	}

	public function test_get_count_data()
	{
		$this->assertEquals(2, $this->csvReader->count());
	}

	public function test_get_iterator()
	{
		foreach ($this->csvReader as $data)
		{
			$this->assertTrue(is_array($data));
		}
	}

	public function test_to_array()
	{
		$this->assertTrue(is_array($this->csvReader->toArray()));
	}

	public function test_to_json()
	{
		$expected = '{"\\u0000*\\u0000items":[["01","Hello","World"],["02","Lorem","Ipsum"]]}';
		$this->assertEquals($expected, $this->csvReader->toJson());
	}

	public function test_to_object()
	{
		$this->assertInstanceOf('stdClass', $this->csvReader->toObject());
	}

	public function test_get_item_from_array_data()
	{
		$item = $this->csvReader[0];
		$this->assertEquals(3, count($item));
		$this->assertArrayHasKey(0, $item);
		$this->assertArrayHasKey(1, $item);
		$this->assertArrayHasKey(2, $item);
	}

	public function test_array_access_offset_get()
	{
		$item = $this->csvReader[1];
		$this->assertEquals(3, count($item));
		$this->assertArrayHasKey(0, $item);
		$this->assertArrayHasKey(1, $item);
		$this->assertArrayHasKey(2, $item);
	}

	public function test_array_access_offset_unset()
	{
		unset($this->csvReader[0]);
		$this->assertEquals(1, $this->csvReader->count());
	}

	public function test_array_access_offset_set()
	{
		$this->csvReader[2] = 'foo';
		$this->assertEquals('foo', $this->csvReader[2]);
	}

	public function test_array_access_offset_exists()
	{
		$this->assertTrue($this->csvReader->offsetExists(0));
		$this->assertTrue(isset($this->csvReader[1]));
		$this->assertFalse(isset($this->csvReader[2]));
		$this->assertFalse(isset($this->csvReader[3]));
	}
	
} 