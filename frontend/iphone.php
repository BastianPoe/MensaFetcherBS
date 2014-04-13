<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
         "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Braunschweiger Mensen</title>
	<meta name="viewport" content="width=320; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
	<style type="text/css" media="screen">@import "./iui/iui.css";</style>
	<script type="application/x-javascript" src="./iui/iui.js"></script>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-15" /> -->
</head>

<body>
    <div class="toolbar">
        <h1 id="pageTitle"></h1>
        <a id="backButton" class="button" href="#"></a>
    </div>
    
<?
$Prefix = "../backend/";

$Dirs = Array(	
    "kath" => "Katharinenstra&szlig;e",
		"kath_b" => "Katharinenstra&szlig;e Folgewoche",
    "360" => "360°",
		"360_b" => "360° Folgewoche",
		"beeth" => "Beethovenstra&szlig;e",
		"beeth_b" => "Beethovenstra&szlig;e Folgewoche",
		"hbk" => "HBK",
		"hbk_b" => "HBK Folgewoche",
    "hiuni" => "Hildesheim Uni",
    "hiuni_b" => "Hildesheim Uni Folgewoche",
    "hiho"  => "Hildesheim Hohnsen",
    "hiho_b" => "Hildesheim Hohnsen Folgewoche",
    "luecam" => "Lüneburg Campus",
    "luecam_b" => "Lüneburg Campus Folgewoche",
    "luerof"   => "Lüneburg Rotes Feld",
    "luerof_b" => "Lüneburg Rotes Feld Folgewoche"
);

$Tage = Array(	"mo" => "Montag",
		"di" => "Dienstag",
		"mi" => "Mittwoch",
		"do" => "Donnerstag",
		"fr" => "Freitag",
		"sa" => "Samstag");

?>
    <ul id="home" title="Braunschweiger Mensen" selected="true">
<?
foreach($Dirs as $Dir => $Name) {
?>
	<li><a href="#<? echo $Dir; ?>"><? echo $Name; ?></a></li>
<?
}
?>
    </ul>

<?
    
foreach($Dirs as $Dir => $Name) {
?>
    <ul id="<? echo $Dir; ?>" title="<? echo $Name; ?>">
<?
	foreach($Tage as $Short => $Tag) {
		if( is_file($Prefix . $Dir . "/" . $Short . ".csv") ) {
?>
    	<li><a href="#<? echo $Dir . "_" . $Short; ?>"><? echo $Tag; ?></a></li>
<?
		}
	}
?>
    </ul>

<?
}

foreach($Dirs as $Dir => $Name) {
	foreach($Tage as $Short => $Tag) {
		if( is_file($Prefix . $Dir . "/" . $Short . ".csv") ) {
?>
    <ul id="<? echo $Dir . "_" . $Short; ?>" title="<? echo $Tag . " " . $Name; ?>">
<?

			$fp = fopen($Prefix . $Dir . "/" . $Short . ".csv", "r");

			while($dat = fgetcsv($fp, 1024, ";") ) {
				if( count($dat) > 1 ) {
					if( $dat[2] != "" ) {
?>
	<li><? echo $dat[0] . " [" . $dat[1] . ", " . $dat[2] . "&euro;, " . $dat[3] . "&euro;, " . $dat[4] . "&euro;]"; ?></li>
<?
					} else {
?>
	<li><? echo $dat[0]; ?></li>
<?
					}
				} elseif(strlen($dat[0]) > 0) {
?>
	<li class="group"><? echo $dat[0]; ?></li>
<?
				}
			}

			fclose($fp);
?>
    </ul>

<?
		}
	}
}

?>

</body>
</html>
