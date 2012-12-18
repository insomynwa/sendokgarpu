<script>
	$(document).ready(function(){
		$("a").css("cursor","pointer");
		$("title").html("<?php echo $title; ?>");

		load_content("<?php echo $content; ?>");
		
		$(".edit-resep").click(function(){
			alert(this.id);
		});
		$(".edit-member").click(function(){
			alert(this.id);
		});

		function load_content(content) {
			$.get(
				"index.php/daftar-konten",
				{ content:content},
				function(data) {
					var tbl_data;
					if(data.type=="resep") {
						tbl_data = "<tr><td>No</td>\
									<td>Tanggal</td>\
									<td>Kategori</td>\
									<td>Judul</td>\
									<td>Penulis</td></tr>";
						for(i=0; i<(data.judul).length; i++){
							tbl_data = tbl_data+"<tr><td>"+(i+1)+"</td>\
												<td>"+data.tanggal[i]+"</td>\
												<td>"+data.kategori[i]+"</td>\
												<td>"+data.judul[i]+"</td>\
												<td>"+data.penulis[i]+"</td>\
												<td><a class='edit-resep' id='"+data.id[i]+"' >Edit</a></td>\
												<td><a class='delete-resep' id='"+data.id[i]+"' >Delete</a></td></tr>";
						}
					}
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
												<td><a class='edit-member' id='"+data.id[i]+"' >Edit</a></td>\
												<td><a class='delete-member' id='"+data.id[i]+"' >Delete</a></tr>";
						}
					}
					$("#tbl-manage").html(tbl_data);
				},
				"json"
			);
			return false;
		}
	});
</script>
<table id="tbl-manage"></table>