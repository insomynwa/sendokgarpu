<?php $this->load->view('pages/basic'); ?>
<?php $this->load->view('pages/subresep'); ?>
<script>
$(document).ready(function() {

	$.ajax({
		url: "index.php/subcat",
		type: "GET",
		data: "subcat=2",
		cache: false,
		success:
			function(topic) {
				$("#topics-list").html(topic);
			}
	});
});
</script>