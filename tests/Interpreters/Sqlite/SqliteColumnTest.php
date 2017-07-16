<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Afsardo\Schema\Interpreters\Sqlite\SqliteColumn;

class SqliteColumnTest extends TestCase
{
    /** @test */
    public function it_represents_a_boolean_column()
    {
        $column = new SqliteColumn("is_admin", "tinyint", 1, 0);

        $this->assertEquals('is_admin', $column->name());
        $this->assertEquals('boolean', $column->type());
        $this->assertEquals(1, $column->size());
        $this->assertEquals(0, $column->default());
    }

    /** @test */
    public function it_represents_a_string_column()
    {
        $column = new SqliteColumn("email", "varchar");

        $this->assertEquals('email', $column->name());
        $this->assertEquals('string', $column->type());
    }

    /** @test */
    public function it_represents_a_text_column()
    {
        $column = new SqliteColumn("about", "text");

        $this->assertEquals('about', $column->name());
        $this->assertEquals('text', $column->type());
    }

    /** @test */
    public function it_represents_an_integer_column()
    {
        $column = new SqliteColumn("coach_id", "integer", null, null, false, true);

        $this->assertEquals('coach_id', $column->name());
        $this->assertEquals('integer', $column->type());
        $this->assertFalse($column->nullable());
        $this->assertTrue($column->increments());
    }

    /** @test */
    public function it_represents_a_float_column()
    {
        $column = new SqliteColumn("price", "float");

        $this->assertEquals('price', $column->name());
        $this->assertEquals('float', $column->type());
        $this->assertTrue($column->nullable());
        $this->assertFalse($column->increments());
        $this->assertFalse($column->unsigned());
    }

    /** @test */
    public function it_represents_a_decimal_column()
    {
        $column = new SqliteColumn("percentage", "numeric");

        $this->assertEquals('percentage', $column->name());
        $this->assertEquals('decimal', $column->type());
        $this->assertTrue($column->nullable());
        $this->assertFalse($column->increments());
    }

    /** @test */
    public function it_represents_a_date_column()
    {
        $column = new SqliteColumn("tested_at", "date");

        $this->assertEquals('tested_at', $column->name());
        $this->assertEquals('date', $column->type());
    }

    /** @test */
    public function it_represents_a_datetime_column()
    {
        $column = new SqliteColumn("tested_at", "datetime");

        $this->assertEquals('tested_at', $column->name());
        $this->assertEquals('dateTime', $column->type());
    }

    /** @test */
    public function it_represents_a_time_column()
    {
        $column = new SqliteColumn("tested_at", "time");

        $this->assertEquals('tested_at', $column->name());
        $this->assertEquals('time', $column->type());
    }

    /** @test */
    public function it_represents_a_binary_column()
    {
        $column = new SqliteColumn("raw_data", "blob");

        $this->assertEquals('raw_data', $column->name());
        $this->assertEquals('binary', $column->type());
    }

    /** @test */
    public function it_compares_columns()
    {
        $columnA = new SqliteColumn("price", "numeric");
        $columnB = new SqliteColumn("coach_id", "integer", null, null, false, true);
        $columnC = new SqliteColumn("price", "float");

        $this->assertFalse($columnA->equals($columnB));
        $this->assertTrue($columnA->equals($columnC));
    }

    /** @test */
    public function it_knows_if_it_is_a_double_column()
    {
        $columnA = new SqliteColumn("coach_id", "integer", null, null, false, true);
        $columnB = new SqliteColumn("percentage", "numeric");
        $columnC = new SqliteColumn("raw_data", "blob");
        $columnD = new SqliteColumn("price", "float");

        $this->assertFalse($columnA->isDouble());
        $this->assertFalse($columnB->isDouble());
        $this->assertFalse($columnC->isDouble());
        $this->assertFalse($columnD->isDouble());
    }

    /** @test */
    public function it_knows_if_it_is_a_decimal_column()
    {
        $columnA = new SqliteColumn("coach_id", "integer", null, null, false, true);
        $columnB = new SqliteColumn("percentage", "numeric");
        $columnC = new SqliteColumn("raw_data", "blob");
        $columnD = new SqliteColumn("price", "float");

        $this->assertFalse($columnA->isDecimal());
        $this->assertFalse($columnB->isDecimal());
        $this->assertFalse($columnC->isDecimal());
        $this->assertFalse($columnD->isDecimal());
    }

    /** @test */
    public function it_knows_if_it_is_an_enum_column()
    {
        $columnA = new SqliteColumn("coach_id", "integer", null, null, false, true);
        $columnB = new SqliteColumn("percentage", "numeric");
        $columnC = new SqliteColumn("raw_data", "blob");
        $columnD = new SqliteColumn("price", "float");

        $this->assertFalse($columnA->isEnum());
        $this->assertFalse($columnB->isEnum());
        $this->assertFalse($columnC->isEnum());
        $this->assertFalse($columnD->isEnum());
    }

    /** @test */
    public function it_knows_if_it_is_a_boolean_column()
    {
        $columnA = new SqliteColumn("coach_id", "integer", null, null, false, true);
        $columnB = new SqliteColumn("percentage", "numeric");
        $columnC = new SqliteColumn("raw_data", "blob");
        $columnD = new SqliteColumn("price", "float");

        $this->assertFalse($columnA->isBoolean());
        $this->assertFalse($columnB->isBoolean());
        $this->assertFalse($columnC->isBoolean());
        $this->assertFalse($columnD->isBoolean());
    }
}
