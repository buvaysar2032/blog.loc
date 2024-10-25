<?php

namespace common\enums;

/**
 * Class CodeStatus
 *
 * @package common\enums
 * @author m.kropukhinsky <m.kropukhinsky@peppers-studio.ru>
 */
enum CodeStatus: int implements DictionaryInterface
{
    use DictionaryTrait;

    case NOT_ISSUED = 0;
    case ISSUED = 1;

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return match ($this) {
            self::ISSUED => 'Выдан',
            self::NOT_ISSUED  => 'Не выдан',
        };
    }

    /**
     * {@inheritdoc}
     */
    public function color(): string
    {
        return match ($this) {
            self::ISSUED => 'var(--bs-success)',
            self::NOT_ISSUED => 'var(--bs-danger)'
        };
    }
}
