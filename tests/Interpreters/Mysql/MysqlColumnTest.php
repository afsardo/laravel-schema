<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Afsardo\Schema\Interpreters\Mysql\MysqlColumn;

class MysqlColumnTest extends TestCase
{

    /** @test */
    public function it_represents_a_boolean_column()
    {
        $column = new MysqlColumn("is_admin", "tinyint", 1, 0);

        $this->assertEquals('is_admin', $column->name());
        $this->assertEquals('tinyInteger', $column->type());
        $this->assertEquals(1, $column->size());
        $this->assertEquals(0, $column->default());
    }

    /** @test */
    public function it_represents_a_char_column()
    {
        $column = new MysqlColumn("handle", "char", 12);

        $this->assertEquals('handle', $column->name());
        $this->assertEquals('char', $column->type());
        $this->assertEquals(12, $column->size());
    }

    /** @test */
    public function it_represents_a_string_column()
    {
        $column = new MysqlColumn("email", "varchar");

        $this->assertEquals('email', $column->name());
        $this->assertEquals('string', $column->type());
    }

    /** @test */
    public function it_represents_a_text_column()
    {
        $column = new MysqlColumn("about", "text");

        $this->assertEquals('about', $column->name());
        $this->assertEquals('text', $column->type());
    }

    /** @test */
    public function it_represents_a_mediumtext_column()
    {
        $column = new MysqlColumn("about", "mediumtext");

        $this->assertEquals('about', $column->name());
        $this->assertEquals('mediumText', $column->type());
    }

    /** @test */
    public function it_represents_a_longtext_column()
    {
        $column = new MysqlColumn("about", "longtext");

        $this->assertEquals('about', $column->name());
        $this->assertEquals('longText', $column->type());
    }

    /** @test */
    public function it_represents_an_integer_column()
    {
        $column = new MysqlColumn("coach_id", "int", null, null, false, true);

        $this->assertEquals('coach_id', $column->name());
        $this->assertEquals('integer', $column->type());
        $this->assertFalse($column->nullable());
        $this->assertTrue($column->increments());
    }

    /** @test */
    public function it_represents_an_biginteger_column()
    {
        $column = new MysqlColumn("coach_id", "bigint", null, null, false, false);

        $this->assertEquals('coach_id', $column->name());
        $this->assertEquals('bigInteger', $column->type());
        $this->assertFalse($column->nullable());
        $this->assertFalse($column->increments());
    }

    /** @test */
    public function it_represents_an_mediuminteger_column()
    {
        $column = new MysqlColumn("coach_id", "mediumint", 100, null, false, false);

        $this->assertEquals('coach_id', $column->name());
        $this->assertEquals('mediumInteger', $column->type());
        $this->assertEquals(100, $column->size());
        $this->assertFalse($column->nullable());
        $this->assertFalse($column->increments());
    }

    /** @test */
    public function it_represents_an_tinyinteger_column()
    {
        $column = new MysqlColumn("coach_id", "tinyint", 15, 23, false, false);

        $this->assertEquals('coach_id', $column->name());
        $this->assertEquals('tinyInteger', $column->type());
        $this->assertEquals(15, $column->size());
        $this->assertEquals(23, $column->default());
        $this->assertFalse($column->nullable());
        $this->assertFalse($column->increments());
        $this->assertFalse($column->isBoolean());
    }

    /** @test */
    public function it_represents_an_smallinteger_column()
    {
        $column = new MysqlColumn("coach_id", "smallint", 5, null, true, true);

        $this->assertEquals('coach_id', $column->name());
        $this->assertEquals('smallInteger', $column->type());
        $this->assertEquals(5, $column->size());
        $this->assertTrue($column->nullable());
        $this->assertTrue($column->increments());
    }

    /** @test */
    public function it_represents_a_double_column()
    {
        $column = new MysqlColumn("price", "double");

        $this->assertEquals('price', $column->name());
        $this->assertEquals('double', $column->type());
        $this->assertTrue($column->nullable());
        $this->assertFalse($column->increments());
        $this->assertFalse($column->unsigned());
    }

    /** @test */
    public function it_represents_a_decimal_column()
    {
        $column = new MysqlColumn("percentage", "decimal");

        $this->assertEquals('percentage', $column->name());
        $this->assertEquals('decimal', $column->type());
        $this->assertTrue($column->nullable());
        $this->assertFalse($column->increments());
    }

    /** @test */
    public function it_represents_a_date_column()
    {
        $column = new MysqlColumn("tested_at", "date");

        $this->assertEquals('tested_at', $column->name());
        $this->assertEquals('date', $column->type());
    }

    /** @test */
    public function it_represents_a_datetime_column()
    {
        $column = new MysqlColumn("tested_at", "datetime");

        $this->assertEquals('tested_at', $column->name());
        $this->assertEquals('dateTime', $column->type());
    }

    /** @test */
    public function it_represents_a_time_column()
    {
        $column = new MysqlColumn("tested_at", "time");

        $this->assertEquals('tested_at', $column->name());
        $this->assertEquals('time', $column->type());
    }

     /** @test */
    public function it_represents_a_timestamp_column()
    {
        $column = new MysqlColumn("tested_at", "timestamp");

        $this->assertEquals('tested_at', $column->name());
        $this->assertEquals('timestamp', $column->type());
    }

    /** @test */
    public function it_represents_a_binary_column()
    {
        $column = new MysqlColumn("raw_data", "blob");

        $this->assertEquals('raw_data', $column->name());
        $this->assertEquals('binary', $column->type());
    }

    /** @test */
    public function it_represents_a_enum_column()
    {
        $column = new MysqlColumn("status", "enum", 'ACTIVE, DISABLED');

        $this->assertEquals('status', $column->name());
        $this->assertEquals('enum', $column->type());
        $this->assertEquals(['ACTIVE', 'DISABLED'], $column->size());
    }

    /** @test */
    public function it_represents_a_json_column()
    {
        $column = new MysqlColumn("metadata", "json");

        $this->assertEquals('metadata', $column->name());
        $this->assertEquals('json', $column->type());
    }

    /** @test */
    public function it_compares_columns()
    {
        $columnA = new MysqlColumn("price", "decimal");
        $columnB = new MysqlColumn("coach_id", "integer", null, null, false, true);
        $columnC = new MysqlColumn("price", "double");

        $this->assertFalse($columnA->equals($columnB));
        $this->assertTrue($columnA->equals($columnC));
    }

    /** @test */
    public function it_knows_if_it_is_a_double_column()
    {
        $columnA = new MysqlColumn("coach_id", "integer", null, null, false, true);
        $columnB = new MysqlColumn("percentage", "decimal");
        $columnC = new MysqlColumn("raw_data", "blob");
        $columnD = new MysqlColumn("price", "double");

        $this->assertFalse($columnA->isDouble());
        $this->assertFalse($columnB->isDouble());
        $this->assertFalse($columnC->isDouble());
        $this->assertTrue($columnD->isDouble());
    }

    /** @test */
    public function it_knows_if_it_is_a_decimal_column()
    {
        $columnA = new MysqlColumn("coach_id", "integer", null, null, false, true);
        $columnB = new MysqlColumn("percentage", "decimal");
        $columnC = new MysqlColumn("raw_data", "blob");
        $columnD = new MysqlColumn("price", "float");

        $this->assertFalse($columnA->isDecimal());
        $this->assertTrue($columnB->isDecimal());
        $this->assertFalse($columnC->isDecimal());
        $this->assertFalse($columnD->isDecimal());
    }

    /** @test */
    public function it_knows_if_it_is_an_enum_column()
    {
        $columnA = new MysqlColumn("status", "enum", "ACTIVE, DISABLED");
        $columnB = new MysqlColumn("percentage", "decimal");
        $columnC = new MysqlColumn("raw_data", "blob");
        $columnD = new MysqlColumn("price", "float");

        $this->assertTrue($columnA->isEnum());
        $this->assertFalse($columnB->isEnum());
        $this->assertFalse($columnC->isEnum());
        $this->assertFalse($columnD->isEnum());
    }

    /** @test */
    public function it_knows_if_it_is_a_boolean_column()
    {
        $columnA = new MysqlColumn("is_admin", "tinyint", 1, 0);
        $columnB = new MysqlColumn("percentage", "decimal");
        $columnC = new MysqlColumn("raw_data", "blob");
        $columnD = new MysqlColumn("price", "float");

        $this->assertTrue($columnA->isBoolean());
        $this->assertFalse($columnB->isBoolean());
        $this->assertFalse($columnC->isBoolean());
        $this->assertFalse($columnD->isBoolean());
    }
}
