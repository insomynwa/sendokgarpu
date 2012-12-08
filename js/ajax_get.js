$(document).ready(function() {

	loadpage(7);

	function loadpage(page) {
		$.ajax({
				type: "GET",
				url: "index.php/cat",
				dataType: "json",
				data: "page="+page,
				cache: false,
				success:
					function(data) {
						$("title").html(data.judul+' | Saus Tomat').fadeIn("slow");
						$("#mystyle").html(data.css);
						$("#main-content").html(data.template).fadeIn("slow");
						$("#title-konten").html(data.judul).fadeIn("slow");
						$("#content-script").html(data.script);
					}
			});
	}

	$("a").css("cursor","pointer");
	$("a:contains('masakan')").click( function() { loadpage(1); });
	$("a:contains('minuman')").click( function() { loadpage(2); });
	$("a:contains('tentang')").click( function() { loadpage(3); });
	$("a:contains('kontak')").click( function() { loadpage(4); });
	$("a:contains('resep')").click( function() { loadpage(5); });
	$("a:contains('login')").click( function() { loadpage(6); });
	$("a:contains('beranda')").click( function() { loadpage(7); });

});