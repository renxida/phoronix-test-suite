<?php

/*
	Phoronix Test Suite
	URLs: http://www.phoronix.com, http://www.phoronix-test-suite.com/
	Copyright (C) 2008 - 2010, Phoronix Media
	Copyright (C) 2008 - 2010, Michael Larabel

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

class upload_result implements pts_option_interface
{
	public static function argument_checks()
	{
		return array(
		new pts_argument_check(0, array("pts_types", "is_result_file"), null, "No result file was found.")
		);
	}
	public static function run($r)
	{
		$use_file = $r[0];

		if(pts_global::result_upload_supported($use_file) == false)
		{
			return false;
		}

		pts_client::set_test_flags();
		if((pts_c::$test_flags ^ pts_c::auto_mode))
		{
			$tags_input = pts_global::prompt_user_result_tags();
			echo "\n";
		}

		$upload_url = pts_global::upload_test_result($use_file, $tags_input);

		if(!empty($upload_url))
		{
			echo "\nResults Uploaded To: " . $upload_url . "\n\n";
			pts_module_manager::module_process("__event_global_upload", $upload_url);
		}
		else
		{
			echo "\nResults Failed To Upload.\n";
		}
	}
}

?>
