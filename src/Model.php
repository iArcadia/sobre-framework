<?php

namespace SobreFramework\Core;

use SobreFramework\Core\Traits\useTimestampAttributes;

/**
 * Class Model
 * @package SobreFramework\Core
 */
class Model
{
    use useTimestampAttributes;

    /**
     * Model constructor.
     *
     * @constructor
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->__fill($data);
    }

    /**
     * Fill all instance properties which have an corresponding setter method.
     *
     * @param array $data
     * @return $this
     */
    public function __fill(array $data = []): self
    {
        foreach ($data as $key => $value) {
            $setter = 'set' . snakeToCamel($key);

            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }

        return $this;
    }

    /**
     * Get the manager class of the model.
     *
     * @static
     * @return string
     */
    public static function manager(): string
    {
        $self = static::class;

        return $self . 'Manager';
    }
}
