
function prev(name)
{
	jQuery.ajax({
		type: "POST",
		url: 'getPage.php',
		dataType: 'html',
		data: {search: $('#search').val(), before: name, sort: $('#sort').val(), count: $('#count').val()},

		success: function (data) {
					  $('#results').html(data);
		}
	});
}

function next(name)
{
	jQuery.ajax({
		type: "POST",
		url: 'getPage.php',
		dataType: 'html',
		data: {search: $('#search').val(), after: name, sort: $('#sort').val(), count: $('#count').val()},

		success: function (data) {
					  $('#results').html(data);
		}
	});
}

function search()
{
	jQuery.ajax({
		type: "POST",
		url: 'getPage.php',
		dataType: 'html',
		data: {search: $('#search').val(), sort: $('#sort').val(), count: 0},

		success: function (data) {
					  $('#results').html(data);
		}
	});
}

function newSort(sort)
{
	$('#search').val('');
	jQuery.ajax({
		type: "POST",
		url: 'getPage.php',
		dataType: 'html',
		data: {sort: sort, count: 0},
		success: function (data) {
					  $('#results').html(data);
		}
	});
}