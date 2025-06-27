<?php

class Product
{
    public $make;
    public $model;
    public $colour;
    public $capacity;
    public $network;
    public $grade;
    public $condition;

    public function __construct(array $data)
    {
        #brand_name	model_name	condition_name	grade_name	gb_spec_name	colour_name	network_name
        $this->make      = $data['brand_name'] ?? null;
        $this->model     = $data['model_name'] ?? null;
        $this->colour    = $data['colour_name'] ?? '';
        $this->capacity  = $data['gb_spec_name'] ?? '';
        $this->network   = $data['network_name'] ?? '';
        $this->grade     = $data['grade_name'] ?? '';
        $this->condition = $data['condition_name'] ?? '';

        if (! $this->make || ! $this->model) {
            throw new Exception("Missing required fields: make or model.");
        }
    }

    public function getCombinationKey()
    {
        return strtolower("{$this->make}|{$this->model}|{$this->colour}|{$this->capacity}|{$this->network}|{$this->grade}|{$this->condition}");
    }

    public function __toString()
    {
        return json_encode([
            'make'      => $this->make,
            'model'     => $this->model,
            'colour'    => $this->colour,
            'capacity'  => $this->capacity,
            'network'   => $this->network,
            'grade'     => $this->grade,
            'condition' => $this->condition,
        ]);
    }
}
