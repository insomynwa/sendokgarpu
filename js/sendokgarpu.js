var topic_id;
var topic = 0;
function loadPage(page) {
	$.ajax({
		type: "GET",
		url: "index.php/cat",
		data: "page="+page,
		cache: false,
		success:
			function(data) {
				$("#main-content").html(data);
			}
	}); }

function goToArticle(kategori_id, t){
	loadPage(kategori_id);
	topic = t; }