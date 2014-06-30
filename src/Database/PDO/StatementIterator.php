<?php
namespace Centralino\Database\PDO;

use Centralino\Database;

class StatementIterator implements \Iterator
{
    private $statement;

    private $cursor;

    public function __construct(Statement $statement)
    {
        $this->statement = $statement;
    }

    public function current()
    {
        return $this->statement->nextRow(\PDO::FETCH_OBJ, \PDO::FETCH_ORI_ABS, $this->cursor);
    }

    public function key()
    {

    }

    public function next()
    {
        $this->cursor++;
    }

    public function prev()
    {
        $this->cursor--;
    }

    public function rewind()
    {
        $this->cursor = 0;
    }

    public function valid()
    {

    }
}
