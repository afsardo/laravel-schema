<?php

namespace Tests;

use PDO;
use Afsardo\Schema\Interpreter;
use PHPUnit\Framework\TestCase;
use Afsardo\Schema\Interpreters\Parser;
use Illuminate\Database\SQLiteConnection;

class InterpreterTest extends TestCase
{
    private function createSqliteConnection()
    {
        return new SQLiteConnection(new PDO('sqlite::memory:'), ':memory:', '', ['driver' => 'sqlite']);
    }

    /** @test */
    public function query_parsers_must_implement_parser_interface()
    {
        foreach (Interpreter::$queriesParsers as $parser) {
            $this->assertTrue(in_array(Parser::class, class_implements($parser)));
        }
    }

    /** @test */
    public function dump_parsers_must_implement_parser_interface()
    {
        foreach (Interpreter::$dumpParsers as $parser) {
            $this->assertTrue(in_array(Parser::class, class_implements($parser)));
        }
    }

    // /** @test */
    // public function it_resolves_a_table_from_sqlite_queries()
    // {
    //     $interpreter = (new Interpreter)->connection($this->createSqliteConnection());
    //     $table = $interpreter->fromQueries([
    //         ["query" => ""]
    //     ]);
    // }
}
