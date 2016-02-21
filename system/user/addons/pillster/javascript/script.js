$(function() {
	var $oldStatus = $('select[name="status"]');
	var $oldStatusOptions = $oldStatus.find('option');
	var inputName = $oldStatus.attr('name');
	var status = '';

	// If status is not on the page, no need to go further
	if (! $oldStatus.length) {
		return;
	}

	// Loop through the status options
	$oldStatusOptions.each(function() {
		var $op = $(this);
		var chosen = '';
		var checked = '';

		// Check if this status is selected
		if ($op.attr('selected') === 'selected') {
			chosen = ' chosen';
			checked = ' checked';
		}

		// Build the new status options
		status += '<label class="choice mr' + chosen + '">';
		status += '<input type="radio" name="' + inputName +'" value="' + $op.val() + '"' + checked +'>';
		status += $op.text() + '</label>';
	});

	// Insert the new options and remove the old one
	$oldStatus.after(status).remove();
});
