image001 		= new Image();
image001.src 	= "images/spacer.gif";

image002 		= new Image();
image002.src 	= "images/logo.gif";

image003 		= new Image();
image003.src 	= "images/top_bg.gif";

image004 		= new Image();
image004.src 	= "images/employer_panel_bottom_left.gif";

image005 		= new Image();
image005.src 	= "images/top_blue_left.gif";

image006 		= new Image();
image006.src 	= "images/top_blue_middle.gif";

image007 		= new Image();
image007.src 	= "images/top_blue_right.gif";

image008 		= new Image();
image008.src 	= "images/top_red_left.gif";

image009 		= new Image();
image009.src 	= "images/top_red_middle.gif";

image010 		= new Image();
image010.src 	= "images/top_red_right.gif";




image011 		= new Image();
image011.src 	= "images/left_window_topleft.gif";

image012 		= new Image();
image012.src 	= "images/left_window_bar_top.gif";

image013 		= new Image();
image013.src 	= "images/left_window_topright.gif";

image014 		= new Image();
image014.src 	= "images/left_window_bar_left.gif";

image015 		= new Image();
image015.src 	= "images/left_window_bar_right.gif";

image016 		= new Image();
image016.src 	= "images/left_window_bottomleft.gif";

image017 		= new Image();
image017.src 	= "images/left_window_bar_bottom.gif";

image018 		= new Image();
image018.src 	= "images/left_window_bottomright.gif";

image019 		= new Image();
image019.src 	= "images/left_window_bar_title.gif";






image020 		= new Image();
image020.src 	= "images/center_window_topleft.gif";

image021 		= new Image();
image021.src 	= "images/center_window_bar_top.gif";

image022 		= new Image();
image022.src 	= "images/center_window_topright.gif";

image023 		= new Image();
image023.src 	= "images/center_window_bar_left.gif";

image024 		= new Image();
image024.src 	= "images/center_window_bar_right.gif";

image025 		= new Image();
image025.src 	= "images/center_window_bottomleft.gif";

image026 		= new Image();
image026.src 	= "images/center_window_bar_bottom.gif";

image027 		= new Image();
image027.src 	= "images/center_window_bottomright.gif";



function print_page(url_jobdetail) {
	var leftPos	= (screen.availWidth-750) / 2;
	var topPos	= (screen.availHeight-500) / 2;
	PrintJob	= window.open(url_jobdetail ,'','width=750,height=500,scrollbars=yes,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);
}

function open_photo(photo_id) {
	var leftPos	= (screen.availWidth-500) / 2;
	var topPos	= (screen.availHeight-500) / 2;
	PrintJob	= window.open('employer_job_jobseekers_detail_photo.php?photo=' + photo_id ,'','width=500,height=500,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);
}