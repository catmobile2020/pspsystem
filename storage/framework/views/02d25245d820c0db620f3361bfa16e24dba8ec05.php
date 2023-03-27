<script>
	var old = <?php echo json_encode(old(), 15, 512) ?>;
	$("input.form-control, textarea.form-control").each(function() {
		$(this).val(old[$(this).attr("name")]);
	});
	$('select.form-control').each(function() {
		$(this).val(old[$(this).attr("name")]);
	});
</script>
<?php /**PATH /home/catsw/psp.cat-sw.com/resources/views/layouts/old.blade.php ENDPATH**/ ?>