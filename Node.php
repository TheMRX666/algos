<?php

// Node class represents storage nodes in the network
class Node {
    private $nodeId;
    private $files;

    public function __construct($nodeId) {
        $this->nodeId = $nodeId;
        $this->files = [];
    }

    public function storeFile(File $file) {
        $this->files[$file->getFilename()] = $file;
    }

    public function retrieveFile($filename) {
        if (isset($this->files[$filename])) {
            return $this->files[$filename];
        } else {
            return null;
        }
    }
}
