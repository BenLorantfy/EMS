var ReportsBox = function(){
	var section = new Section("#reports");
	var onDone = $.customEvent();
	var onConfirm = $.customEvent();

	$("#reportsDone, #reports .sectionBackground").click(function(){
		onDone.trigger();
	})
	
	$("#reportsConFirm").click(function () {
	    
	    OpenInNewTab();
	})

	return $.extend({},section,{
		onDone:onDone
	});

	function OpenInNewTab(url) {
	    if (document.getElementById('SeniorityReportCBox').checked) {

	        var win = window.open("/ems/reports/SeniorityReport.php", '_blank');
	        win.focus();
	    }
	    if (document.getElementById('WeeklyHoursWorkedCBox').checked) {

	        var win = window.open("/ems/reports/WeeklyHoursWorkedReport.php", '_blank');
	        win.focus();
	    }
	    if (document.getElementById('PayRollCBox').checked) {

	        var win = window.open("/ems/reports/PayRollReport.php", '_blank');
	        win.focus();
	    }
	    if (document.getElementById('ActiveEmploymentReportCBox').checked) {

	        var win = window.open("/ems/reports/ActiveEmploymentReport.php", '_blank');
	        win.focus();
	    }
	    if (document.getElementById('InactiveEmploymentReportCBox').checked) {

	        var win = window.open("/ems/reports/InactiveEmploymentReport.php", '_blank');
	        win.focus();
	    }
	    else {
	        $.msgBox.error("No reports selected.", true);
	    }
	}
	
	
}
