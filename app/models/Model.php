<?php

namespace App\Model;

use SobreFramework\Core\Model as BaseModel;

/***
 * Class Model
 * @package App\Model
 */
class Model extends BaseModel
{
    /**
     * Model constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::_construct($data);
    }
}
