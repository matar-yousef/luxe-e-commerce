<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case EDITOR = 'editor';
    case USER = 'user';

    public function isAdmin(): bool
    {
        return $this === self::ADMIN;
    }

    public function isEditor(): bool
    {
        return $this === self::EDITOR;
    }

    public function isUser(): bool
    {
        return $this === self::USER;
    }

    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Super Admin',
            self::EDITOR => 'Editor',
            self::USER => 'User',
        };
    }
}
