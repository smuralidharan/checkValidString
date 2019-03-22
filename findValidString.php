<?php
//Tested with the following string list
// [a+{(b)}][ - invalid
// [a+{b)}] - invalid
// [a+{(b)}] - valid
// [] - valid
$str = "[a+{(b)}]";
echo $check = checkValidString($str);
function checkValidString($str)
{
	$allowed_list = ["[", "(", "{"];
	$closed_list = ["]", ")", "}"];
	//Checked initially whether both open & close brackets matches and exit if it fails
	if(substr_count($str,"[") == substr_count($str,"]") && substr_count($str,"(") == substr_count($str,")") && substr_count($str,"{") == substr_count($str,"}"))
	{
		foreach($allowed_list as $key => $val)
		{
			//Get the first and last position of the matching brackets in a string to find the substring 
			$firstPos = strpos($str, $val);
			$nextPos = strpos($str, $closed_list[$key]);
			if($firstPos !== false)
			{
				if($nextPos !== false)
				{
					$searchable_str = substr($str, $firstPos+1, $nextPos-$firstPos-1);
					// I checked $key >= 2, to loop through all three allowed lists
					if($key >= 2)
						checkValidString($searchable_str);
				}
				else
				{
					return "invalid";
					
				}
			}
		}
		return "valid";
	}
	else
		return "invalid";
}


?>