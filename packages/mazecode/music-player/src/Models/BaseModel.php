<?php

namespace Mazecode\MusicPlayer\Models;

use Illuminate\Database\Eloquent\Model;


class BaseModel extends Model
{
    public function path()
    {
        return '/'.strtolower(__CLASS__).'/'.$this->id;
    }
}
