<script>
	function goToCat(kategori_id) { loadPage(kategori_id); }
	function loadContent(content) {
		$.get(
			"index.php/"+list_content,
			{ content:content},
			function(data) {
				var tbl_data;
				if(data.type=="resep") {
					tbl_data = "<tr><td>No</td>\
								<td>Tanggal</td>\
								<td>Kategori</td>\
								<td>Judul</td>\
								<td>Komentar</td>\
								<td>Penulis</td></tr>";
					for(i=0; i<(data.judul).length; i++){
						tbl_data = tbl_data+"<tr><td>"+(i+1)+"</td>\
											<td>"+data.tanggal[i]+"</td>\
											<td class='goto-content'><a onclick='goToCat("+data.kategori_id[i]+");'>"+data.kategori[i]+"</a></td>\
											<td class='goto-content'><a onclick='goToArticle("+data.kategori_id[i]+",this.id);' id='"+data.id[i]+"' >"+data.judul[i]+"</a></td>\
											<td>"+data.komentar[i]+"</td>\
											<td>"+data.penulis[i]+"</td>\
											<td class='edit-resep' ><a onclick='"+data.edit_func[i]+"' id='"+data.id[i]+"' >"+data.edit_txt[i]+"</a></td>\
											<td class='delete'><a onclick='"+data.del_func[i]+"' id='"+data.id[i]+"' >"+data.del_txt[i]+"</a></td></tr>"; }}
				<?php if($this->session->userdata('user_id')==1): ?>
				if(data.type=="member") {
					tbl_data = "<tr><td>No</td>\
								<td>Tanggal Registrasi</td>\
								<td>Username</td>\
								<td>Email</td></tr>";
					for(i=0; i<(data.name).length; i++) {
						tbl_data = tbl_data+"<tr><td>"+(i+1)+"</td>\
											<td>"+data.join[i]+"</td>\
											<td>"+data.name[i]+"</td>\
											<td>"+data.email[i]+"</td>\
											<td class='delete'><a onclick='"+data.del_func[i]+"' id='"+data.id[i]+"' >"+data.del_txt[i]+"</a></tr>";}}
				<?php endif; ?>
				$("#tbl-manage").html(tbl_data).fadeIn('slow');
			}, "json" ); return false; }

	$(document).ready(function(){
		$("a").css("cursor","pointer");
		$("title").html("<?php echo $title; ?>");
		$(navi_content).accordion({ collapsible: true, active: 1 });
		loadContent("<?php echo $content; ?>"); }); </script>
<table id="tbl-manage" border="0"></table>