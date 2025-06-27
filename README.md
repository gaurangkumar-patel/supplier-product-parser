# Supplier Product List Processor

This is a command-line PHP application that reads product data from CSV or TSV files, prints each product, and outputs a file that counts unique product combinations.

---

### ✅ Requirements

- PHP 7.0 or higher
- Composer (optional, for autoloading/testing)
- Terminal/Command Line access

---

### 🚀 How to Run

```bash
php parser.php --file=examples/products_tab_separated.tsv --unique-combinations=output/combination_count.csv
```

- `--file`: Input CSV or TSV file with product data
- `--unique-combinations`: Output file to save combination counts (optional)

---

### 🧱 Product Fields

Each product should have the following fields:

| Field Name      | Required | Description              |
| --------------- | -------- | ------------------------ |
| brand\_name     | ✅        | Brand (e.g. Apple)       |
| model\_name     | ✅        | Model (e.g. iPhone 13)   |
| condition\_name | ❌        | Condition (e.g. Working) |
| grade\_name     | ❌        | Grade (e.g. Grade A)     |
| gb\_spec\_name  | ❌        | Storage (e.g. 128GB)     |
| colour\_name    | ❌        | Colour (e.g. Blue)       |
| network\_name   | ❌        | Network (e.g. Unlocked)  |


Missing `make` or `model` will throw an exception.

---

### 📤 Output Example (CSV)

| make  | model          | colour | capacity | network  | grade   | condition | count |
| ----- | -------------- | ------ | -------- | -------- | ------- | --------- | ----- |
| Apple | iPhone 6s Plus | Red    | 256GB    | Unlocked | Grade A | Working   | 129   |

---

### 🧪 Bonus

- Add unit tests using PHPUnit or Pest
- Extend for JSON/XML support

---

### 📂 Folder Structure

```
.
├── Product.php
├── ProductParser.php
├── parser.php
├── tests/
│   └── ProductTest.php
├── examples/
│   └── products_tab_separated.tsv
├── output/
│   └── combination_count.csv (generated)
├── README.md
├── composer.json
└── .gitignore

```

### 🧪 Unit Testing (Bonus ✅)
Basic test cases are included using PHPUnit to verify:

✅ Successful creation of a Product

❌ Exception thrown when make or model is missing

```bash
./vendor/bin/phpunit tests

```

💡 Bonus: Extending Support for JSON & XML
The parser is structured in a way that makes it easy to support additional formats like .json or .xml.

- Here’s how your parse() method inside ProductParser.php is designed:

```bash

public function parse(string $filename): array
{
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    switch ($ext) {
        case 'csv':
        case 'tsv':
            return $this->parseCsv($filename);
        case 'json':
            return $this->parseJson($filename); // (To be implemented)
        case 'xml':
            return $this->parseXml($filename);  // (To be implemented)
        default:
            throw new Exception("Unsupported file format: $ext");
    }
}

```
- You can add parseJson() and parseXml() methods in the future to expand functionality with minimal changes.