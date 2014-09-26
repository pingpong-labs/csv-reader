## Laravel 4 - CSV Reader

[![Build Status](https://travis-ci.org/pingpong-labs/csv-reader.svg?branch=master)](https://travis-ci.org/pingpong-labs/csv-reader)
[![Total Downloads](https://poser.pugx.org/pingpong/csv-reader/downloads.svg)](https://packagist.org/packages/pingpong/csv-reader)
[![Latest Stable Version](https://poser.pugx.org/pingpong/csv-reader/v/stable.svg)](https://packagist.org/packages/pingpong/csv-reader)
[![Latest Unstable Version](https://poser.pugx.org/pingpong/csv-reader/v/unstable.svg)](https://packagist.org/packages/pingpong/csv-reader)
[![License](https://poser.pugx.org/pingpong/csv-reader/license.svg)](https://packagist.org/packages/pingpong/csv-reader)

### Server Requirement

This package is require PHP 5.4 or higher.

### Installation

Open your composer.json file, and add the new required package.

```
"pingpong/csv-reader": "1.0.*"
```

Next, open a terminal and run.

```
composer update
```

Next, Add new aliases in app/config/app.php.

```php
'CsvReader' => 'Pingpong\CsvReader\Facades\CsvReader',
```

Done.

### Usage

Create new instance.

```php
$path = app_path('file.csv');

$csv = CsvReader::get($path); 

// OR

$csv = CsvReader::make($path);
```

Get data.

```php
$data = $csv->getData();
```

Get data as array.

```php
$data = $csv->toArray();
```

Get data as json.

```php
$data = $csv->toJson();
```

Get data as object.

```php
$data = $csv->toObject();
```

Looping.

```php
foreach($csv as $item)
{
	var_dump($item);
}
```

### Without Laravel

Basically all functions and APIs  same as above.

```php
$path = __DIR__ . '/path/to/csvfile.csv';

$csv = new Pingpong\CsvReader\CsvReader($path);

$data = $csv->getData();
```

### License

This package is open-sourced software licensed under [The BSD 3-Clause License](http://opensource.org/licenses/BSD-3-Clause)
