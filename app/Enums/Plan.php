<?php

namespace App\Enums;

enum Plan: string
{
    case Free = 'free';
    case Pro = 'pro';
    case Business = 'business';

    public function label(): string
    {
        return match($this) {
            self::Free => 'Gratis',
            self::Pro => 'Pro',
            self::Business => 'Bisnis',
        };
    }

    public function limits(): array
    {
        return config("sshelf.plans.{$this->value}.limits");
    }
}
