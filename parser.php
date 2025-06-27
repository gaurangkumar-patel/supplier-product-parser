<?php

require_once 'Product.php';
require_once 'ProductParser.php';

$options = getopt("", ["file:", "unique-combinations::"]);

if (! isset($options['file'])) {
    echo "Usage: php parser.php --file=yourfile.csv [--unique-combinations=output.csv]\n";
    exit(1);
}

$file   = $options['file'];
$output = $options['unique-combinations'] ?? null;

try {
    $parser   = new ProductParser();
    $products = $parser->parse($file);
    if (empty($products)) {
        echo "No products found in the file.\n";
        exit(0);
    }
    printf("Parsed %d products from %s\n", count($products), $file);
    // Print each product
    foreach ($products as $product) {
        echo $product . PHP_EOL;
    }

    if ($output) {
        $parser->exportUniqueCombinations($products, $output);
        echo "Unique combinations exported to $output\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
    exit(1);
}
