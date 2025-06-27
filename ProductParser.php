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

        $headers           = [];
        $combinationCounts = [];

        while (($row = fgetcsv($handle, 0, $delimiter)) !== false) {
            if (empty($headers)) {
                $headers = array_map('strtolower', $row);
                continue;
            }

            $data = array_combine($headers, $row);

            try {
                $product = new Product($data);
                $key     = $product->getCombinationKey();

                if (! isset($combinationCounts[$key])) {
                    $combinationCounts[$key] = ['product' => $product, 'count' => 0];
                }
                $combinationCounts[$key]['count']++;

            } catch (Exception $e) {
                echo "Skipping row: " . $e->getMessage() . PHP_EOL;
            }
        }

        fclose($handle);
        return $combinationCounts; // Return final counts
    }

    public function exportUniqueCombinations(array $combinationCounts, string $outputFile): void
    {
        $dir = dirname($outputFile);
        if (! is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        $handle = fopen($outputFile, 'w');
        if (! $handle) {
            throw new Exception("Unable to write to file: $outputFile");
        }

        // Write headers
        fputcsv($handle, ['make', 'model', 'colour', 'capacity', 'network', 'grade', 'condition', 'count']);

        foreach ($combinationCounts as $entry) {
            $p = $entry['product'];
            fputcsv($handle, [
                $p->make,
                $p->model,
                $p->colour,
                $p->capacity,
                $p->network,
                $p->grade,
                $p->condition,
                $entry['count'],
            ]);
        }

        fclose($handle);
    }

}
