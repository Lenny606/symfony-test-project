<?php

namespace App\Enums;

enum Roles {
    case ROLE_ADMIN;
    case ROLE_EDITOR;
    case ROLE_COMMENTER;

    public static function getRole(string $name): ?Roles {
        return match ($name) {
            'ROLE_ADMIN' => self::ROLE_ADMIN,
            'ROLE_EDITOR' => self::ROLE_EDITOR,
            'ROLE_COMMENTER' => self::ROLE_COMMENTER,
            default => null,
        };
    }
}