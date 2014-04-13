<?

function StripNewline($String) {
	$String = str_replace("\n", "", $String);
	$String = str_replace("\r", "", $String);
	return $String;
}
			
function HtmlTable2Array($Table) {
	$Table = MakeTagsLC($Table);
	$Header = false;

	$Rows = explode("<tr", $Table);

	for($h=0; $h<count($Rows); $h++) {
		$Rows[$h] = "<tr" . $Rows[$h];
		$Cols = explode("<td", $Rows[$h]);
		$Content = false;

		unset($NewLine);
	
		$Set = false;
		
		for($g=1; $g<count($Cols); $g++) {
			$NewString = trim(strip_tags(html_entity_decode("<td" . $Cols[$g])));
			if( strlen($NewString) > 1 && strlen($Headers[$g-1]) > 0 ) {
				$NewLine[$Headers[$g-1]] = trim(strip_tags(html_entity_decode("<td" . $Cols[$g])));
				$Set = true;
			}
		}

		if( $Set ) 
			$Array[] = $NewLine;

		if( !$Header ) {
			for($g=0; $g<count($Cols); $g++) {
				$Cols[$g] = trim(strip_tags("<td" . $Cols[$g]));

				if( strlen($Cols[$g]) > 0 )
					$Content = true;
			}

			if( $Content ) {
				$Header = true;
				$Headers = ShiftArray($Cols);
				$ColsNumber = count($Headers);
			}
		}

	}

	return $Array;
}

function MakeTagsLC($Code) {
	$Input = explode("<", $Code);
	
	for($h=0; $h<count($Input); $h++) {
		$Temp = explode(">", $Input[$h]);
		$Temp[0] = "<" . strtolower($Temp[0]) . ">";

		$Out .= $Temp[0] . $Temp[1];
	}

	return $Out;
}
