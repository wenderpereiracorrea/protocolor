<? // AJAX AUTO COMPLETAR EDITOR E LOCAL **************************************************** ?>
<script type="text/javascript" src="lib/jquery.js"></script>
<script type='text/javascript' src='lib/jquery.bgiframe.min.js'></script>
<script type='text/javascript' src='lib/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='lib/thickbox-compressed.js'></script>
<script type='text/javascript' src='lib/jquery.autocomplete.js'></script>
<script type='text/javascript' src='lib/localdata.js'></script>
<link rel="stylesheet" type="text/css" href="lib/jquery.autocomplete.css" />
	
<script type="text/javascript">
$().ready(function() {

	function log(event, data, formatted) {
		$("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");
	}
	
	function formatItem(row) {
		return row[0] + " (<strong>id: " + row[1] + "</strong>)";
	}
	function formatResult(row) {
		return row[0].replace(/(<.+?>)/gi, '');
	}
	
	$("#singleBirdRemote").autocomplete("autocomplete_search.php?tabela=setor", {
		width: 260,
		selectFirst: false
	});

	$("#singleBirdRemote2").autocomplete("autocomplete_search.php?tabela=setor", {
		width: 260,
		selectFirst: false
	});
	$("#singleBirdRemote3").autocomplete("autocomplete_search.php?tabela=especie", {
		width: 260,
		selectFirst: false
	});


});

function changeOptions(){
	var max = parseInt(window.prompt('Please type number of items to display:', jQuery.Autocompleter.defaults.max));
	if (max > 0) {
		$("#suggest1").setOptions({
			max: max
		});
	}
}

function changeScrollHeight() {
    var h = parseInt(window.prompt('Please type new scroll height (number in pixels):', jQuery.Autocompleter.defaults.scrollHeight));
    if(h > 0) {
        $("#suggest1").setOptions({
			scrollHeight: h
		});
    }
}

function changeToMonths(){
	$("#suggest1")
		// clear existing data
		.val("")
		// change the local data to months
		.setOptions({data: months})
		// get the label tag
		.prev()
		// update the label tag
		.text("Month (local):");
}
</script>
<? // AJAX AUTO COMPLETAR EDITOR E LOCAL **************************************************** ?>
