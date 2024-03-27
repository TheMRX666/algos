<?php

// LoadBalancer class manages load balancing among storage nodes
class LoadBalancer {
    private $fileStorage;

    public function __construct(FileStorage $fileStorage) {
        $this->fileStorage = $fileStorage;
    }

    public function getNodeForFile($filename) {
        $nodes = $this->fileStorage->getStorageNodes();
        if (empty($nodes)) {
            throw new Exception("No available storage nodes found.");
        }
        $nodeCount = count($nodes);
        $fileHash = crc32($filename);
        $nodeIndex = $fileHash % $nodeCount;
        return $nodes[$nodeIndex];
    }
}