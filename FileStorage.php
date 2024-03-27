<?php

// FileStorage class handles file storage operations
class FileStorage {
    private $storageNodes;

    public function __construct() {
        $this->storageNodes = [];
    }

    public function addNode(Node $node) {
        $this->storageNodes[] = $node;
    }

    public function getStorageNodes() {
        return $this->storageNodes;
    }

    public function storeFile(File $file) {
        if (empty($this->storageNodes)) {
            throw new Exception("No storage nodes available.");
        }
        // For simplicity, let's assume a simple hashing algorithm to decide which node to store the file on
        $nodeIndex = crc32($file->getFilename()) % count($this->storageNodes);
        $this->storageNodes[$nodeIndex]->storeFile($file);
    }
}