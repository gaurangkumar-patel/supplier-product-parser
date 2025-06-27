<?php

require_once 'Product.php';

class ProductParser
{
    public function parse(string $filepath): array
    {
        if (! file_exists($filepath)) {
            throw new Exception("File not found: $filepath");
        }

        $extension = pathinfo($filepath, PATHINFO_EXTENSION);
        $delimiter = ($extension === 'tsv') ? "\t" : ",";

        $handle = fopen($filepath, 'r');
        if (! $handle) {
            throw new Exception("Unable to open file: $filepath");
        }

        $products = [];
        $headers  = [];

        while (($row = fgetcsv($handle, 0, $delimiter)) !== false) {
            if (empty($headers)) {
                $headers = array_map('strtolower', $row);
                continue;
            }

            $data = array_combine($headers, $row);

            try {
                $products[] = new Product($data);
            } catch (Exception $e) {
                echo "Skipping row: " . $e->getMessage() . PHP_EOL;
            }
        }

        fclose($handle);
        return $products;
    }

    public function exportUniqueCombinations(array $products, string $outputFile): void
    {
        $counts = [];

        foreach ($products as $product) {
            $key = $product->getCombinationKey();
            if (! isset($counts[$key])) {
                $counts[$key] = ['product' => $product, 'count' => 0];
            }
            $counts[$key]['count']++;
        }
        $dir = dirname($outputFile);
        if (! is_dir($dir)) {
            mkdir($dir, 0777, true); // Creates the directory recursively
        }
        if (file_exists($outputFile)) {
            unlink($outputFile); // Remove the file if it already exists
        }
        // Open the output file for writing
        $handle = fopen($outputFile, 'w');
        if (! $handle) {
            throw new Exception("Unable to write to file: $outputFile");
        }

        // Write headers
        fputcsv($handle, ['make', 'model', 'colour', 'capacity', 'network', 'grade', 'condition', 'count']);

        foreach ($counts as $entry) {
            /** @var Product $product */
            $product = $entry['product'];
            fputcsv($handle, [
                $product->make,
                $product->model,
                $product->colour,
                $product->capacity,
                $product->network,
                $product->grade,
                $product->condition,
                $entry['count'],
            ]);
        }

        fclose($handle);
    }
}
