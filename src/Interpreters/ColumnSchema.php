<?php

namespace Afsardo\Schema\Interpreters;

interface ColumnSchema {

    public function name();

    public function type();

    public function size();
    
    public function default();

    public function nullable();

    public function unsigned();

    public function increments();

    public function equals(ColumnSchema $other);

}