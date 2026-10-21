<?php
/**
 * 🛠️ GLOBAL WRAPPER DEBUGGER (api/products/debug.php)
 * This script forces Apache to catch compilation syntax crashes.
 */
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

// This forces the configuration to run BEFORE compiling the broken script!
include 'read.php'; 
