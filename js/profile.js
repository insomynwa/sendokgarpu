var timer;
function dialogForm(f1,f2,ttl) {
	$(".error-message").html('').hide();
	$(f1).show();
	$(f1).clearForm();
	$(f2).hide();
	$("#dialog-form").dialog({
		modal: true, draggable: false,closeOnEscape: true,resizable: false, dialogClass: "dialog-form-style",
		width: 400, title: 'Pengaturan '+ttl });
	is_dialog_opened = true; }
function goToContent(page , content) {
	$.get(
		"index.php/"+url_content,
		{ page:page, content:content  },
		function(data) {
			$(".profil-content").html(data).fadeIn('slow');
		}
	); }
function setSmiley(){
	$(".smiley").accordion({ active: 1, collapsible: true,autoHeight: false });}