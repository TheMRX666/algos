<?php

// SecurityManager class handles security mechanisms for the DFS
class SecurityManager {
    private $userPermissions; // Map user to their permitted files

    public function __construct() {
        $this->userPermissions = [];
    }

    public function grantAccess($user, $filename) {
        if (!isset($this->userPermissions[$user])) {
            $this->userPermissions[$user] = [];
        }
        $this->userPermissions[$user][$filename] = true;
    }

    public function revokeAccess($user, $filename) {
        if (isset($this->userPermissions[$user])) {
            unset($this->userPermissions[$user][$filename]);
        }
    }

    public function checkAccess($user, $filename) {
        if (isset($this->userPermissions[$user]) && isset($this->userPermissions[$user][$filename])) {
            return true; // User has access to the file
        } else {
            return false; // Access denied
        }
    }
}