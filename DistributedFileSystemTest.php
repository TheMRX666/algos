<?php

require_once 'DistributedFileSystem.php';
require_once 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class DistributedFileSystemTest extends TestCase {
    public function testStoreFile() {
        $dfs = new DistributedFileSystem();
        try {
            $dfs->storeFile("test.txt", 1024);
            $this->assertTrue(true); 
        } catch (Exception $e) {
            $this->fail("Exception thrown: " . $e->getMessage()); 
        }
    }

    public function testRetrieveFile() {
        $dfs = new DistributedFileSystem();
        $dfs->storeFile("test.txt", 1024);
        $file = $dfs->retrieveFile("test.txt");
        $this->assertInstanceOf('File', $file);
    }

    public function testAccessControl() {
        $dfs = new DistributedFileSystem();
        $dfs->storeFile("test.txt", 1024);
        
        // Grant access to a user
        $dfs->grantAccess("user1", "test.txt");
        $this->assertTrue($dfs->checkAccess("user1", "test.txt"));

        // Revoke access from the user
        $dfs->revokeAccess("user1", "test.txt");
        $this->assertFalse($dfs->checkAccess("user1", "test.txt"));
    }
}