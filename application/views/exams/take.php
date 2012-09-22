<html>
<head>
	
<script type="text/javascript">
    function OnClientLoad(editor) {
        editor.removeShortCut("ToggleScreenMode");
    }
</script>
	<script language="JavaScript">
	/* get help for these codes in...
	 * http://udayms.wordpress.com/2006/03/17/ajax-key-disabling-using-javascript/
	 * http://www.openjs.com/scripts/events/keyboard_shortcuts/#remove_docs */
		stopProp = function(e) {
			if (!e) {
				e = window.event;
			}
			if (e && e.stopPropogation)
			  e.stopPropogation();
			else if (window.event && window.event.cancelBubble)
			  e.cancelBubble = true;
		};
		document.onkeydown = function(e){
			if (!e) {
				e = window.event;
			}
			if ((e.which == 122)){
				e.stopPropagation()
				e.cancelBubble = true;
				e.returnValue = false;
				e.keyCode = false; 
				alert ("No new window");
			}
		}
	</script>
</head>

	<div id='promptStart'>
	<h1>F11</h1>
	<p>Press F11 to start exam</p>
	</div>
	
	<div id='examForm'>
		<?php // to call exam function ?>
	</div>
	
</html>