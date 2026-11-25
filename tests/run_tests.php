#!/usr/bin/env php
<?php
/**
 * Simple Test Runner for Xmlrpc Security Tests
 * 
 * This script provides a simple way to run the security tests
 * without requiring a full PHPUnit installation.
 * 
 * Usage: php tests/run_tests.php
 */

// Define BASEPATH for CodeIgniter
define('BASEPATH', dirname(__FILE__) . '/../system/');

echo "===========================================\n";
echo "Xmlrpc Security Fix - Test Suite\n";
echo "===========================================\n\n";

$tests_passed = 0;
$tests_failed = 0;
$errors = array();

// Test 1: Check that var_dump is removed
echo "Test 1: Checking var_dump removal... ";
$file_path = BASEPATH . 'libraries/Xmlrpc.php';
$content = file_get_contents($file_path);
$pattern = '/^\s*var_dump\s*\(/m';

if (!preg_match($pattern, $content)) {
	echo "✓ PASSED\n";
	$tests_passed++;
} else {
	echo "✗ FAILED\n";
	$tests_failed++;
	$errors[] = "var_dump() still found in Xmlrpc.php";
}

// Test 2: Check that security comment is present
echo "Test 2: Checking security comment... ";
if (strpos($content, 'Security fix: var_dump() removed to prevent information disclosure') !== false) {
	echo "✓ PASSED\n";
	$tests_passed++;
} else {
	echo "✗ FAILED\n";
	$tests_failed++;
	$errors[] = "Security comment not found in Xmlrpc.php";
}

// Test 3: Check that debug structure is maintained
echo "Test 3: Checking debug structure... ";
if (strpos($content, '---PARSED---') !== false && strpos($content, '---END PARSED---') !== false) {
	echo "✓ PASSED\n";
	$tests_passed++;
} else {
	echo "✗ FAILED\n";
	$tests_failed++;
	$errors[] = "Debug structure markers not found";
}

// Test 4: Check for other dangerous functions
echo "Test 4: Checking for other dangerous functions... ";
$dangerous_patterns = array(
	'/^\s*print_r\s*\(/m',
	'/^\s*var_export\s*\(/m',
	'/^\s*debug_print_backtrace\s*\(/m',
	'/^\s*debug_zval_dump\s*\(/m'
);

$found_dangerous = false;
foreach ($dangerous_patterns as $pattern) {
	if (preg_match($pattern, $content)) {
		$found_dangerous = true;
		break;
	}
}

if (!$found_dangerous) {
	echo "✓ PASSED\n";
	$tests_passed++;
} else {
	echo "✗ FAILED\n";
	$tests_failed++;
	$errors[] = "Potentially dangerous debugging function found";
}

// Test 5: Check that the file is valid PHP
echo "Test 5: Checking PHP syntax... ";
$output = array();
$return_var = 0;
exec("php -l " . escapeshellarg($file_path) . " 2>&1", $output, $return_var);

if ($return_var === 0) {
	echo "✓ PASSED\n";
	$tests_passed++;
} else {
	echo "✗ FAILED\n";
	$tests_failed++;
	$errors[] = "PHP syntax error in Xmlrpc.php: " . implode("\n", $output);
}

// Summary
echo "\n===========================================\n";
echo "Test Results\n";
echo "===========================================\n";
echo "Tests Passed: $tests_passed\n";
echo "Tests Failed: $tests_failed\n";
echo "Total Tests:  " . ($tests_passed + $tests_failed) . "\n";

if ($tests_failed > 0) {
	echo "\n--- ERRORS ---\n";
	foreach ($errors as $error) {
		echo "  • $error\n";
	}
	echo "\n";
	exit(1);
} else {
	echo "\n✓ All tests passed!\n\n";
	exit(0);
}

/* End of file run_tests.php */
/* Location: ./tests/run_tests.php */
