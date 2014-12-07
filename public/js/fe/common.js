$(document).ready(function() {
	$('.carousel').carousel();
	$('.datepicker').datepicker();
	$(".select2").each(function() {
		options = {
			width: 'resolve'
		};
		if ($(this).attr('data-no-search'))
			options['minimumResultsForSearch'] = -1; // Hide the seach box
		$(this).select2(options);
	});

	$('[btn-confirm="confirm"]').on('click', function() {
		var dataConfirm = $(this).attr('data-confirm');
		console.log(dataConfirm);
		if (typeof dataConfirm === "undefined") {
			dataConfirm = "Bạn có chắc chắn ?";
		}
		var dataUrl = $(this).attr('data-url');
		bootbox.confirm(dataConfirm, 'Hủy bỏ', 'Đồng ý', function(result) {
			if (result) {
				location.href = dataUrl;
			}
		});
		return false;
	});
	$(document).on('click', '.btn-add-to-cart, .btn-remove-from-cart', function() {
		$_booksCounter = $('#books-counter');
		$_thisLink = $(this);
		var originalText = $_thisLink.text();
		var sendData = {book_id: $_thisLink.data('book-id')};
		var bookId = $_thisLink.data('book-id');
		$.ajax({
			type: 'POST',
			url: $_thisLink.data('url'),
			data: sendData,
			beforeSend: function() {
				$_thisLink.text('Đang xử lý ...');
			},
			complete: function() {
				$_thisLink.text(originalText);
			},
			success: function(response) {
				if (response.success) {
					$('.btn-add-to-cart[data-book-id="' + bookId + '"]').toggleClass('hide');
					$('.btn-remove-from-cart[data-book-id="' + bookId + '"]').toggleClass('hide');
					$_booksCounter.text(response.books_count);
				}
			}
		});
	});

	$('#btn-submit-cart').on('click', function(e) {
		var $form = $('#form-cart');
		var cart = [];
		$('#cart-table tbody tr').each(function() {
			var bookId = $(this).find('.cart-input-book-id').val();
			var bookScope = $(this).find('.cart-input-book-scope').val();
			var bookNumber = $(this).find('.cart-book-count').val();
			cart.push({
				bookId: bookId,
				scope: bookScope,
				number: bookNumber
			});
		});
		var $inputCart = $('<input>')
				.attr('type', 'hidden')
				.attr('name', 'cart')
				.val(JSON.stringify(cart));
		$form.append($inputCart).submit();
		e.preventDefault();
	});
});