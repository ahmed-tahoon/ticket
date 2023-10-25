<?php

namespace App\Enums;

enum CustomFieldType: string
{
    case DATE = 'date';
    case DATETIME = 'datetime-local';
    case EMAIL = 'email';
    case NUMBER = 'number';
    case TEL = 'tel';
    case TEXT = 'text';
    case TEXTAREA = 'textarea';
    case TIME = 'time';
    case URL = 'url';

    public function label(): string
    {
        return match ($this) {
            self::DATE => 'Date',
            self::DATETIME => 'Datetime-local',
            self::EMAIL => 'Email',
            self::NUMBER => 'Number',
            self::TEL => 'Tel',
            self::TEXT => 'Text',
            self::TEXTAREA => 'Textarea',
            self::TIME => 'Time',
            self::URL => 'URL',
        };
    }
}
