<?php

namespace App\Contracts;

interface AiGeneratorInterface
{
    /**
     * Generate content based on the provided parameter array payload.
     * Expected keys: product_name, description, audience, tone, content_type
     *
     * @param array $data
     * @return string
     */
    public function generate(array $data): string;
}
