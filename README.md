<div align="center">

# Supplier Product Parser

**A lightweight PHP command-line application for parsing supplier product catalogues from CSV or TSV files and reporting unique product combinations.**

![PHP](https://img.shields.io/badge/PHP-7.0%2B-777BB4?logo=php&logoColor=white)
![CLI](https://img.shields.io/badge/Application-CLI-0F172A)
![CSV](https://img.shields.io/badge/Input-CSV-16A34A)
![TSV](https://img.shields.io/badge/Input-TSV-2563EB)
![PHPUnit](https://img.shields.io/badge/Tests-PHPUnit-6C5CE7)

</div>

---

## Overview

Supplier Product Parser is a PHP CLI utility that reads structured supplier-product data from CSV or TSV files, converts each valid row into a product record and generates a CSV report containing counts for unique product combinations.

The project demonstrates practical backend-development skills including:

- command-line argument handling
- structured file processing
- CSV and TSV delimiter support
- object-oriented PHP
- product validation
- exception handling
- aggregation of unique product combinations
- generated CSV output
- basic automated testing with PHPUnit

---

## Features

- Reads product catalogues from `.csv` and `.tsv` files
- Supports configurable input and output paths through CLI options
- Maps structured rows into product objects
- Validates required product information
- Throws exceptions for invalid product records
- Groups matching product attributes into unique combinations
- Counts the number of occurrences for each combination
- Exports combination counts to a CSV file
- Includes sample input and output files
- Includes basic PHPUnit tests for product validation

---

## Requirements

- PHP 7.0 or later
- Composer, when installing test dependencies
- Terminal, PowerShell or another command-line environment

Check your PHP installation:

```bash
php --version
```

---

## Installation

Clone the repository:

```bash
git clone https://github.com/gaurangkumar-patel/supplier-product-parser.git
cd supplier-product-parser
```

Install Composer dependencies:

```bash
composer install
```

---

## Usage

Run the parser with an input file and an output destination:

```bash
php parser.php --file=examples/products_tab_separated.tsv --unique-combinations=examples/combination_count.csv
```

### Available options

| Option                  | Required | Description                                         |
| ----------------------- | -------: | --------------------------------------------------- |
| `--file`                |      Yes | Path to the source CSV or TSV product file          |
| `--unique-combinations` |       No | Path for the generated unique-combination count CSV |

### CSV example

```bash
php parser.php --file=examples/products_comma_separated.csv --unique-combinations=examples/combination_count.csv
```

### TSV example

```bash
php parser.php --file=examples/products_tab_separated.tsv --unique-combinations=examples/combination_count.csv
```

---

## Supported Product Fields

The parser expects product data with the following fields:

| Field            | Required | Example   |
| ---------------- | -------: | --------- |
| `brand_name`     |      Yes | Apple     |
| `model_name`     |      Yes | iPhone 13 |
| `condition_name` |       No | Working   |
| `grade_name`     |       No | Grade A   |
| `gb_spec_name`   |       No | 128GB     |
| `colour_name`    |       No | Blue      |
| `network_name`   |       No | Unlocked  |

A product record without the required brand or model information is treated as invalid and raises an exception.

---

## Output

The generated report contains one row for each unique product combination together with its occurrence count.

Example:

| make  | model          | colour | capacity | network  | grade   | condition | count |
| ----- | -------------- | ------ | -------- | -------- | ------- | --------- | ----: |
| Apple | iPhone 6s Plus | Red    | 256GB    | Unlocked | Grade A | Working   |   129 |

The output path is provided through the `--unique-combinations` CLI option. In the included example, the generated file is saved as `examples/combination_count.csv`.

---

## Project Structure

```text
supplier-product-parser/
├── examples/
│   ├── combination_count.csv
│   ├── products_comma_separated.csv
│   └── products_tab_separated.tsv
├── tests/
│   └── ProductTest.php
├── .gitignore
├── composer.json
├── parser.php
├── Product.php
├── ProductParser.php
└── README.md
```

### Main files

- `parser.php` — CLI entry point and option handling
- `Product.php` — product data model and validation
- `ProductParser.php` — input parsing and combination-count processing
- `tests/ProductTest.php` — basic product validation tests
- `examples/` — example source files and sample generated output

---

## Testing

Run the included PHPUnit tests:

```bash
./vendor/bin/phpunit tests
```

On Windows PowerShell:

```powershell
vendor\bin\phpunit tests
```

The current test coverage includes:

- successful creation of a valid product
- exception handling when required product information is missing

---

## Design Notes

The parser separates product representation from file-processing responsibilities:

```text
CLI input
   ↓
ProductParser
   ↓
Product validation
   ↓
Unique-combination aggregation
   ↓
CSV report
```

This separation makes the application easier to maintain and provides a foundation for additional input formats or validation rules.

---

## Potential Improvements

- Add JSON and XML input support
- Expand PHPUnit coverage for CSV and TSV parsing
- Add malformed-row and missing-file tests
- Introduce namespacing and PSR-4 autoloading
- Move application classes into a `src/` directory
- Add stricter scalar type declarations
- Add configurable field mappings for different supplier formats
- Add continuous integration with GitHub Actions
- Support processing large catalogues through streaming

---

## Repository Topics

```text
php, cli, csv-parser, tsv, data-processing, validation, supplier-data
```

---

## Author

**Gaurang Patel**
Backend Software Engineer — PHP, Laravel, Yii2, REST APIs, MySQL and Redis

- [LinkedIn](https://www.linkedin.com/in/gaurangpatel2326)
- [Portfolio](https://gaurangkumar-patel.github.io/portfolio)
- [GitHub](https://github.com/gaurangkumar-patel)

---

> This repository is a focused technical project demonstrating PHP CLI development, structured file processing, validation and data aggregation.
