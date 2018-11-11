<?php
declare(strict_types=1);

namespace App\Tests\Storage;

class CsvFileIterator implements \Iterator
{
    /** @var bool|resource */
    protected $file;

    /** @var int */
    protected $key = 0;

    /** @var mixed */
    protected $current;

    /**
     * CsvFileIterator constructor.
     * @param $file
     */
    public function __construct($file)
    {
        $this->file = fopen($file, 'rb');
    }

    /**
     *
     */
    public function __destruct()
    {
        fclose($this->file);
    }

    /**
     * @return void
     */
    public function rewind(): void
    {
        rewind($this->file);
        $this->getCurrent();
        $this->key = 0;
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return !feof($this->file);
    }

    /**
     * @return string
     */
    public function key(): string
    {
        return 'dataset #' . $this->key;
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return $this->current;
    }

    /**
     * @return void
     */
    public function next(): void
    {
        $this->getCurrent();
        $this->key++;
    }

    /**
     * @return void
     */
    private function getCurrent(): void
    {
        $this->current = fgetcsv($this->file);
        if ($this->current) {
            foreach ($this->current as $key => $value) {
                if ($value === 'null') {
                    $this->current[$key] = null;
                }
                if ($value === 'false') {
                    $this->current[$key] = false;
                }
                if ($value === 'true') {
                    $this->current[$key] = true;
                }
            }
        }
    }
}
