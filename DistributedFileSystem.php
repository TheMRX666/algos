<?php

require_once 'File.php';
require_once 'Node.php';
require_once 'FileStorage.php';
require_once 'ReplicationManager.php';
require_once 'LoadBalancer.php';
require_once 'SecurityManager.php';

class DistributedFileSystem {
    private $fileStorage;
    private $replicationManager;
    private $loadBalancer;
    private $securityManager;

    public function __construct() {
        $this->fileStorage = new FileStorage();
        $this->replicationManager = new ReplicationManager($this->fileStorage);
        $this->loadBalancer = new LoadBalancer($this->fileStorage);
        $this->securityManager = new SecurityManager();

        $this->initializeStorageNodes();
    }

    private function initializeStorageNodes() {
        $node1 = new Node("Node1");
        $node2 = new Node("Node2");
        $this->fileStorage->addNode($node1);
        $this->fileStorage->addNode($node2);
    }

    public function storeFile($filename, $size) {
        $file = new File($filename, $size);
        $node = $this->loadBalancer->getNodeForFile($filename);
        $node->storeFile($file);
        $this->replicationManager->replicateFile($file);
    }

    public function retrieveFile($filename) {
        $node = $this->loadBalancer->getNodeForFile($filename);
        return $node->retrieveFile($filename);
    }

    public function grantAccess($user, $filename) {
        $this->securityManager->grantAccess($user, $filename);
    }

    public function revokeAccess($user, $filename) {
        $this->securityManager->revokeAccess($user, $filename);
    }

    public function checkAccess($user, $filename) {
        return $this->securityManager->checkAccess($user, $filename);
    }
}
