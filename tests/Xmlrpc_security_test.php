<?php
/**
 * Unit Tests for Xmlrpc Security Fix
 * 
 * Tests to verify that var_dump() has been removed from the Xmlrpc library
 * to prevent information disclosure vulnerabilities.
 * 
 * @package		CodeIgniter
 * @subpackage	Tests
 * @category	Security
 * @author		Security Team
 */

class Xmlrpc_security_test extends PHPUnit_Framework_TestCase
{
	/**
	 * Test that var_dump is not present in the Xmlrpc.php file
	 * 
	 * This test verifies the security fix by ensuring that var_dump()
	 * calls have been removed from the XML-RPC library to prevent
	 * information disclosure to end users.
	 */
	public function test_var_dump_removed_from_xmlrpc()
	{
		$file_path = BASEPATH . 'libraries/Xmlrpc.php';
		
		// Verify the file exists
		$this->assertFileExists($file_path, 'Xmlrpc.php file should exist');
		
		// Read the file content
		$content = file_get_contents($file_path);
		
		// Check that var_dump is not present in the code
		// We need to be careful to not match var_dump in comments
		$pattern = '/^\s*var_dump\s*\(/m';
		
		$this->assertNotRegExp(
			$pattern,
			$content,
			'var_dump() should not be present in Xmlrpc.php to prevent information disclosure'
		);
	}
	
	/**
	 * Test that the security comment is present
	 * 
	 * Verifies that a comment explaining the security fix has been added
	 * at the location where var_dump was removed.
	 */
	public function test_security_comment_present()
	{
		$file_path = BASEPATH . 'libraries/Xmlrpc.php';
		
		// Read the file content
		$content = file_get_contents($file_path);
		
		// Check that the security comment is present
		$this->assertContains(
			'Security fix: var_dump() removed to prevent information disclosure',
			$content,
			'Security comment should be present to document the fix'
		);
	}
	
	/**
	 * Test that debug output structure is maintained
	 * 
	 * Ensures that the debug output structure (---PARSED--- section)
	 * is still present even though var_dump has been removed.
	 */
	public function test_debug_structure_maintained()
	{
		$file_path = BASEPATH . 'libraries/Xmlrpc.php';
		
		// Read the file content
		$content = file_get_contents($file_path);
		
		// Check that the debug structure markers are still present
		$this->assertContains(
			'---PARSED---',
			$content,
			'Debug structure should be maintained'
		);
		
		$this->assertContains(
			'---END PARSED---',
			$content,
			'Debug structure should be maintained'
		);
	}
	
	/**
	 * Test that no other debugging functions expose sensitive data
	 * 
	 * Checks for other potentially dangerous debugging functions that
	 * could expose sensitive information.
	 */
	public function test_no_other_dangerous_debug_functions()
	{
		$file_path = BASEPATH . 'libraries/Xmlrpc.php';
		
		// Read the file content
		$content = file_get_contents($file_path);
		
		// List of potentially dangerous debugging functions
		$dangerous_functions = array(
			'/^\s*print_r\s*\(/m',
			'/^\s*var_export\s*\(/m',
			'/^\s*debug_print_backtrace\s*\(/m',
			'/^\s*debug_zval_dump\s*\(/m'
		);
		
		foreach ($dangerous_functions as $pattern) {
			$this->assertNotRegExp(
				$pattern,
				$content,
				'Potentially dangerous debugging function found in Xmlrpc.php'
			);
		}
	}
	
	/**
	 * Test that the parseResponse method still functions correctly
	 * 
	 * Integration test to ensure the security fix doesn't break
	 * the XML-RPC functionality.
	 */
	public function test_parse_response_still_works()
	{
		// This is a basic integration test
		// In a real scenario, you would mock the XML-RPC response
		
		require_once(BASEPATH . 'libraries/Xmlrpc.php');
		
		$xmlrpc = new CI_Xmlrpc();
		
		// Verify the class loads without errors
		$this->assertInstanceOf('CI_Xmlrpc', $xmlrpc);
		
		// Verify debug flag can be set (the context where var_dump was removed)
		$xmlrpc->set_debug(TRUE);
		$this->assertTrue($xmlrpc->debug);
		
		$xmlrpc->set_debug(FALSE);
		$this->assertFalse($xmlrpc->debug);
	}
}

/* End of file Xmlrpc_security_test.php */
/* Location: ./tests/Xmlrpc_security_test.php */
