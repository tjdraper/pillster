_.defer(function() {
	var $statusContainer = $('#sub_hold_field_status'),
		$statusOptions = $statusContainer.find('option'),
		$statusFieldSet = $statusContainer.children('.holder');
		statusPills = '<div class="pillster">';
	
	$statusOptions.each(function(i, option) {
		var $option = $(option),
			value = $option.attr('value'),
			label = $option.text()
			selected = false;

		statusPills += '<a href="#" class="pillster__status';

		statusPills += ' pillster__status--' + value;

		if ($option.attr('selected')) {
			statusPills += ' selected'
		}

		statusPills += '" ';

		statusPills += 'data-value="' + value + '"'

		statusPills += '>';

		statusPills += label;

		statusPills += '</a>';

		$option.addClass('status-select').addClass('status-select-' + value);
	});

	statusPills += '</div>';

	$statusFieldSet.hide();

	$statusContainer.append(statusPills);

	var $pills = $('.pillster__status');

	$pills.on('click', function(e) {
		var $this = $(this);

		e.preventDefault();

		$statusOptions.attr('selected', false);

		$('.status-select-' + $this.data('value')).attr('selected', true);

		$pills.removeClass('selected');

		$this.addClass('selected');

		return false;
	});
});