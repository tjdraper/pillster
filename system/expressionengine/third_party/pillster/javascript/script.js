_.defer(function() {
	var $statusContainer = $('#sub_hold_field_status'),
		$statusOptions = $statusContainer.find('option'),
		$statusFieldSet = $statusContainer.children('.holder');
		$statusPills = $('<div class="pillster"></div>'),
		$allPills = $(),
		$statusSelectsObj = {};
	
	$statusOptions.each(function(i, option) {
		var $option = $(option),
			value = $option.attr('value'),
			label = $option.text(),
			selected = false,
			thisPill = '';

		$statusSelectsObj[value] = $option;

		thisPill += '<a href="#" class="pillster__status';

		thisPill += ' pillster__status--' + value.replace(/\s+/g, '');

		if ($option.attr('selected')) {
			thisPill += ' selected'
		}

		thisPill += '" ';

		thisPill += 'data-value="' + value + '"';

		thisPill += '>';

		thisPill += label;

		thisPill += '</a>';

		var $thisPill = $(thisPill);

		$statusPills.append($thisPill);

		$allPills = $allPills.add($thisPill);
	});

	$statusFieldSet.hide();

	$statusContainer.append($statusPills);

	$allPills.on('click', function(e) {
		var $this = $(this),
			value = $this.data('value');

		e.preventDefault();

		$statusOptions.attr('selected', false);

		$statusSelectsObj[value].attr('selected', true);

		$allPills.removeClass('selected');

		$this.addClass('selected');

		return false;
	});
});