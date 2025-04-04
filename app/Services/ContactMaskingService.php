<?php

namespace App\Services;

class ContactMaskingService
{
    public function maskPhone(?string $phone): string
    {
        if (!$phone || strlen($phone) < 8) {
            return '07******';
        }

        return substr($phone, 0, 2) . str_repeat('*', strlen($phone) - 4) . substr($phone, -2);
    }

    public function maskEmail(?string $email): string
    {
        if (!$email || !str_contains($email, '@')) {
            return '***@***.com';
        }

        [$name, $domain] = explode('@', $email);
        $maskedName = substr($name, 0, 1) . str_repeat('*', max(1, strlen($name) - 2)) . substr($name, -1);
        $domainParts = explode('.', $domain);
        $maskedDomain = str_repeat('*', strlen($domainParts[0])) . '.' . end($domainParts);

        return $maskedName . '@' . $maskedDomain;
    }

    public function maskGuardianContact(?string $contact): string
    {
        return $contact ? '**********' : 'N/A';
    }
}