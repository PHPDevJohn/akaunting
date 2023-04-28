<?php

namespace App\Services\Document;

use App\Interfaces\Service\DocumentNumberService;
use App\Models\Common\Contact;

class CoreDocumentNumberService implements DocumentNumberService
{
    public function getNextDocumentNumber(string $type, ?Contact $contact): string
    {
        $type = $this->resolveTypeAlias($type);

        $prefix = setting($type . '.number_prefix');
        $next = (string)setting($type . '.number_next');
        $digit = (int)setting($type . '.number_digit');

        return $prefix . str_pad($next, $digit, '0', STR_PAD_LEFT);
    }

    public function increaseNextDocumentNumber(string $type, ?Contact $contact): void
    {
        $type = $this->resolveTypeAlias($type);

        $next = setting($type . '.number_next', 1) + 1;

        setting([$type . '.number_next' => $next]);
        setting()->save();
    }

    protected function resolveTypeAlias(string $type): string
    {
        if ($alias = config('type.document.' . $type . '.alias')) {
            return $alias . '.' . str_replace('-', '_', $type);
        }

        return $type;
    }
}
