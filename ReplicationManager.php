<?php

// ReplicationManager class manages file replication for fault tolerance
class ReplicationManager {
    private $fileStorage;

    public function __construct(FileStorage $fileStorage) {
        $this->fileStorage = $fileStorage;
    }

    public function replicateFile(File $file) {
        foreach ($this->fileStorage->getStorageNodes() as $node) {
            $node->storeFile($file);
        }
    }
}