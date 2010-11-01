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

class merge_results implements pts_option_interface
{
	public static function run($r)
	{
		$result_files_to_merge = array();

		foreach($r as $result_file)
		{
			if(pts_types::is_result_file($result_file))
			{
				array_push($result_files_to_merge, $result_file);
			}
		}

		if(count($result_files_to_merge) < 2)
		{
			echo "\nAt least two saved result names must be supplied.\n";
			return;
		}

		do
		{
			$rand_file = rand(1000, 9999);
			$merge_to_file = "merge-" . $rand_file . '/';
		}
		while(is_dir(SAVE_RESULTS_DIR . $merge_to_file));
		$merge_to_file .= "composite.xml";

		// Merge Results
		$merged_results = call_user_func(array("pts_merge", "merge_test_results_array"), $result_files_to_merge);
		pts_client::save_test_result($merge_to_file, $merged_results);

		echo "Merged Results Saved To: " . SAVE_RESULTS_DIR . $merge_to_file . "\n\n";
		pts_client::display_web_page(SAVE_RESULTS_DIR . dirname($merge_to_file) . "/index.html");
	}
}

?>
