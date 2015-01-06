<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function domain($domain) {
	return preg_replace('/^[\w]{2,6}:\/\/([\w\d\.\-]+).*$/', '$1', $domain);
}

/* End of file domain_helper.php */
/* Location: ./application/helpers/domain_helper.php */