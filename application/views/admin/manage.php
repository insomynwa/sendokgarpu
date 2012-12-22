<script>
	function yesnodialog(content,id){
		$("#dialog").dialog({
			title: "Hapus Resep",
			modal: true,
			closeOnEscape: true,
			buttons: [
				{
					text: "Ya",
					click: function() {
						$.post(
							"index.php/delete-resep",
							{ resep:id}
						);
						load_content(''+content);
						$(this).dialog("close");
					}
				},
				{
					text: "Tidak",
					click: function() {
						$(this).dialog("close");
					}
				}
			]
			});
	}

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
											<td><a class='edit-resep' onclick='goto_content(\"11\" , this.id)' id='"+data.id[i]+"' >Edit</a></td>\
											<td><a class='delete' onclick='yesnodialog(\"resep\",this.id);' id='"+data.id[i]+"' >Delete</a></td></tr>";
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

	$(document).ready(function(){
		$("a").css("cursor","pointer");
		$("title").html("<?php echo $title; ?>");

		load_content("<?php echo $content; ?>");
	});
</script>
<table id="tbl-manage"></table>
<div id="dialog" hidden="hidden">Yakin ingin dihapus?</div>