<?php

namespace Tests;

use PDO;
use PHPUnit\Framework\TestCase;
use Illuminate\Database\SQLiteConnection;
use Afsardo\Schema\Interpreters\TableSchema;
use Afsardo\Schema\Interpreters\Sqlite\SqliteColumn;

class TableSchemaTest extends TestCase
{

    private function createSqliteConnection()
    {
        return new SQLiteConnection(new PDO('sqlite::memory:'));
    }

    /** @test */
    public function a_table_can_be_set_to_drop()
    {
        $table = new TableSchema($this->createSqliteConnection());
        $table->setName('posts');
        $table->setToDrop('drop table if exists posts;');

        $this->assertTrue($table->toDrop());
    }

    /** @test */
    public function it_represents_a_sqlite_table()
    {
        $table = new TableSchema($this->createSqliteConnection());
        $table->setName('users');
        $table->setColumns($columns = collect([
            $columnA = new SqliteColumn("coach_id", "integer", null, null, false, true),
            $columnB = new SqliteColumn("percentage", "numeric"),
            $columnC = new SqliteColumn("raw_data", "blob"),
            $columnD = new SqliteColumn("price", "float"),
        ]));

        $this->assertFalse($table->toDrop());
        $this->assertTrue($table->getColumns()->contains($columnA));
        $this->assertTrue($table->getColumns()->contains($columnB));
        $this->assertTrue($table->getColumns()->contains($columnC));
        $this->assertTrue($table->getColumns()->contains($columnD));
    }

    /** @test */
    public function it_compares_equal_sqlite_tables()
    {
        $tableA = new TableSchema($this->createSqliteConnection());
        $tableA->setName('users');
        $tableA->setColumns($columns = collect([
            $columnAA = new SqliteColumn("coach_id", "integer", null, null, false, true),
            $columnAB = new SqliteColumn("percentage", "numeric"),
            $columnAC = new SqliteColumn("raw_data", "blob"),
            $columnAD = new SqliteColumn("price", "float"),
        ]));

        $tableB = new TableSchema($this->createSqliteConnection());
        $tableB->setName('users');
        // The columns have same names but different types on purpose the package it is
        // not yet complete, so for now the equals method compares tables by name.
        $tableB->setColumns($columns = collect([ 
            $columnBA = new SqliteColumn("price", "integer", null, null, false, true),
            $columnBB = new SqliteColumn("raw_data", "numeric"),
            $columnBC = new SqliteColumn("coach_id", "blob"),
            $columnBD = new SqliteColumn("percentage", "float"),
        ]));

        $this->assertTrue($tableA->equals($tableB));
        $this->assertTrue($tableB->equals($tableA));
    }

    /** @test */
    public function it_compares_different_sqlite_tables()
    {
        $tableA = new TableSchema($this->createSqliteConnection());
        $tableA->setName('users');
        $tableA->setColumns($columns = collect([
            $columnAA = new SqliteColumn("coach_id", "integer", null, null, false, true),
            $columnAB = new SqliteColumn("percentage", "numeric"),
            $columnAC = new SqliteColumn("raw_data", "blob"),
            $columnAD = new SqliteColumn("price", "float"),
        ]));

        $tableB = new TableSchema($this->createSqliteConnection());
        $tableB->setName('users');
        // The columns have same names but different types on purpose the package it is
        // not yet complete, so for now the equals method compares tables by name.
        $tableB->setColumns($columns = collect([ 
            $columnBA = new SqliteColumn("coach_id2", "integer", null, null, false, true),
            $columnBB = new SqliteColumn("percentage", "numeric"),
            $columnBD = new SqliteColumn("price2", "float"),
        ]));

        $this->assertFalse($tableA->equals($tableB));
        $this->assertFalse($tableB->equals($tableA));
    }

}