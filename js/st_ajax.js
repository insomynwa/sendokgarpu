$(document).ready(function() {

	//loadpage(7);

	function loadpage(page) {
		$.ajax({
				type: "GET",
				url: "index.php/cat",
				data: "page="+page,
				cache: false,
				success:
					function(data) {
						$("#main-content").html(data);
					}
			});
	}

	$("a").css("cursor","pointer");
	$("a:contains('masakan')").click( function() { loadpage('1'); });
	$("a:contains('minuman')").click( function() { loadpage('2'); });
	$("a:contains('tentang')").click( function() { loadpage('3'); });
	$("a:contains('kontak')").click( function() { loadpage('4'); });
	$("a:contains('resep')").click( function() { loadpage('5'); });
	$("a:contains('login')").click( function() { loadpage('6'); });
	$("a:contains('beranda')").click( function() { loadpage('7'); });

});