<?php

// File class represents a file in the DFS
class File {
    private $filename;
    private $size;

    public function __construct($filename, $size) {
        $this->filename = $filename;
        $this->size = $size;
    }

    public function getFilename() {
        return $this->filename;
    }

    public function getSize() {
        return $this->size;
    }
}
