(function($) {
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

	$(".btn-save-book").on("click", function() {
		var redirect = $(this).attr('data-redirect');
		var formUrl = $("#form-book").attr('action');
		formUrl += '?redirect=' + redirect;
		$("#form-book").attr('action', formUrl).submit();
	});
	$('[btn-confirm="post-confirm"]').on('click', function() {
		var dataConfirm = $(this).attr('data-confirm');
		var $form = $(this).parent('form');
		if (typeof dataConfirm === "undefined") {
			dataConfirm = "Bạn có chắc chắn ?";
		}
		bootbox.confirm(dataConfirm, 'Hủy bỏ', 'Đồng ý', function(result) {
			if (result) {
				$form.submit();
			}
		});
		return false;
	});
	$('[data-modal="show-modal"]').on('click', function(e) {
		var dataUrl = $(this).attr('data-url');
		$.get(dataUrl, function(result) {
			$(result).modal();
		});
		return false;
	});
	$("#btn-disapprove-book").on('click', function() {
		$("#form-disapprove-book").toggle(300);
	});

	$('.order-action-approve').on('click', function(e) {
		var orderId = $(this).attr('data-id');
		var $form = $('#form-approve-order');
		$form.find('.order-id').val(orderId);
		$('#modal-order-approve').modal({backdrop: false});
		e.preventDefault();
	});
	$('.order-action-reject').on('click', function(e) {
		var orderId = $(this).attr('data-id');
		var $form = $('#form-reject-order');
		$form.find('.order-id').val(orderId);
		$('#modal-order-reject').modal({backdrop: false});
		e.preventDefault();
	});

	$('.statistics-select-time').on('change', function(e) {
		var type = $(this).val();
		if (type === 'custom') {
			$('.custom-select-time').show();
			$('.custom-select-time').find('input').prop('disabled', false);
		} else {
			$('.custom-select-time').hide();
			$('.custom-select-time').find('input').prop('disabled', true);
		}
		e.preventDefault();
	});
	/**
	 * ---------------------------------------------------------------------------------------------------------
	 * -------------------------------VALIDATION----------------------------------------------------------------
	 * */
	$("#form-disapprove-book").validate({
		rules: {
			reason: "required"
		},
		messages: {
			reason: "Bạn chưa nhập lý do báo lỗi"
		}
	});
	/**
	 * Circulation
	 * */
	var cirHandle = {
		$circulationReader: $("#circulation-reader"),
		$circulationBook: $("#circulation-book"),
		$circulationListBook: $("#circulation-list-book"),
		ajaxFailMsg: 'Đã có lỗi xảy ra, vui lòng thử lại',
		msgLostBook: 'Bạn có chắc chắn báo mất tài liệu này ?',
		readerId: 0,
		bookItemId: 0,
		focusOnBook: function() {
			cirHandle.$circulationBook.find('input.barcode-scanner').focus();
		},
		focusOnReader: function() {
			cirHandle.$circulationReader.find('input.barcode-scanner').focus();
		},
		init: function() {
			this.$circulationReader.find('input.barcode-scanner').focus();
			//cirHandle.$circulationBook.find('input.barcode-scanner').attr('disabled','disabled');
			var defaultCirReader = this.$circulationReader.html(),
					defaultCirBook = this.$circulationBook.html(),
					defaultListBook = this.$circulationListBook.html();
			this.$circulationReader.on('change', '.barcode-scanner', function() {
				var barcode = $(this).val();
				var dataUrl = $(this).attr('data-url');
				if (barcode !== "") {
					$.ajax({
						url: dataUrl,
						type: 'POST',
						dataType: 'json',
						data: {barcode: barcode},
						success: function(result) {
							if (result.status === true) {
								cirHandle.focusOnBook();
								cirHandle.readerId = result.reader_id;
								cirHandle.$circulationReader.html(result.reader_html);
								cirHandle.$circulationListBook.html(result.list_book_html);
							} else {
								bootbox.alert(result.message);
								cirHandle.readerId = 0;
								cirHandle.focusOnReader();
								cirHandle.$circulationReader.html(defaultCirReader);
								cirHandle.$circulationListBook.html(defaultListBook);
								cirHandle.$circulationBook.html(defaultCirBook);
								return false;
							}
						},
						error: function() {
							bootbox.alert(cirHandle.ajaxFailMsg);
							cirHandle.readerId = 0;
							cirHandle.focusOnReader();
							cirHandle.$circulationReader.html(defaultCirReader);
							cirHandle.$circulationBook.html(defaultCirBook);
							cirHandle.$circulationListBook.html(defaultListBook);
							return false;
						}

					});
				} else {
					cirHandle.readerId = 0;
					cirHandle.$circulationReader.html(defaultCirReader);
					cirHandle.$circulationBook.html(defaultCirBook);
					cirHandle.$circulationListBook.html(defaultListBook);
					cirHandle.focusOnReader();
					return false;
				}
			});

			this.$circulationBook.on('change', '.barcode-scanner', function() {
				var barcode = $(this).val();
				var dataUrl = $(this).attr('data-url');
				if (barcode != "") {
					if (cirHandle.readerId !== 0) {
						$.ajax({
							url: dataUrl,
							type: 'POST',
							dataType: 'json',
							data: {barcode: barcode, readerId: cirHandle.readerId},
							success: function(result) {
								if (result.status === true) {
									cirHandle.bookItemId = result.book_item_id;
									cirHandle.$circulationBook.html(result.book_html);
									cirHandle.focusOnBook();
								} else {
									bootbox.alert(result.message);
									cirHandle.bookItemId = 0;
									cirHandle.$circulationBook.html(defaultCirBook);
									cirHandle.focusOnBook();
									return false;
								}
							},
							error: function() {
								bootbox.alert(cirHandle.ajaxFailMsg);
								cirHandle.bookItemId = 0;
								cirHandle.$circulationBook.html(defaultCirBook);
								cirHandle.focusOnBook();
								return false;
							}

						});
					} else {
						bootbox.alert('Lỗi: Phải quét thẻ bạn đọc trước');
						cirHandle.$circulationBook.html(defaultCirBook);
						cirHandle.focusOnReader();
						return false;
					}

				} else {
					cirHandle.bookItemId = 0;
					cirHandle.$circulationBook.html(defaultCirBook);
					cirHandle.focusOnBook();
					return false;
				}
			});

			this.$circulationBook.on('click', '#btn-borrow-book', function() {
				if (cirHandle.bookItemId !== 0 && cirHandle.readerId !== 0) {
					var dataUrl = $(this).attr('data-url');
					$.ajax({
						url: dataUrl,
						type: "POST",
						dataType: "JSON",
						data: {readerId: cirHandle.readerId, bookItemId: cirHandle.bookItemId},
						success: function(result) {
							cirHandle.$circulationListBook.html(result.list_book_html);
							cirHandle.$circulationReader.find("#cir-count-local").html(result.countLocal);
							cirHandle.$circulationReader.find("#cir-count-remote").html(result.countRemote);
							cirHandle.$circulationBook.html(defaultCirBook);
							cirHandle.focusOnBook();
						},
						error: function() {
							bootbox.alert(cirHandle.ajaxFailMsg);
							cirHandle.$circulationBook.html(defaultCirBook);
							cirHandle.focusOnBook();
							return false;
						}
					});
				} else {
					bootbox.alert('Thao tác mượn tài liệu không hợp lệ, vui lòng thử lai');
					cirHandle.$circulationBook.html(defaultCirBook);
					cirHandle.focusOnBook();
					return false;
				}
			});
			this.$circulationBook.on('click', '#btn-return-book', function() {
				if (cirHandle.bookItemId !== 0 && cirHandle.readerId !== 0) {
					var dataUrl = $(this).attr('data-url');
					$.ajax({
						url: dataUrl,
						type: "POST",
						dataType: "JSON",
						data: {readerId: cirHandle.readerId, bookItemId: cirHandle.bookItemId},
						success: function(result) {
							cirHandle.$circulationListBook.html(result.list_book_html);
							cirHandle.$circulationBook.html(defaultCirBook);
							cirHandle.$circulationReader.find("#cir-count-local").html(result.countLocal);
							cirHandle.$circulationReader.find("#cir-count-remote").html(result.countRemote);
							cirHandle.focusOnBook();
						},
						error: function() {
							bootbox.alert(cirHandle.ajaxFailMsg);
							cirHandle.$circulationBook.html(defaultCirBook);
							cirHandle.focusOnBook();
							return false;
						}
					});
				} else {
					bootbox.alert('Thao tác mượn tài liệu không hợp lệ, vui lòng thử lai');
					cirHandle.$circulationBook.html(defaultCirBook);
					cirHandle.focusOnBook();
					return false;
				}

			});

			this.$circulationBook.on('click', '#btn-extra-book', function() {
				if (cirHandle.bookItemId !== 0 && cirHandle.readerId !== 0) {
					var dataUrl = $(this).attr('data-url');
					$.ajax({
						url: dataUrl,
						type: "POST",
						dataType: "JSON",
						data: {readerId: cirHandle.readerId, bookItemId: cirHandle.bookItemId},
						success: function(result) {
							cirHandle.$circulationListBook.html(result.list_book_html);
							cirHandle.$circulationBook.html(defaultCirBook);
							cirHandle.focusOnBook();
						},
						error: function() {
							bootbox.alert(cirHandle.ajaxFailMsg);
							cirHandle.$circulationBook.html(defaultCirBook);
							cirHandle.focusOnBook();
							return false;
						}
					});
				} else {
					bootbox.alert('Thao tác gia hạn tài liệu không hợp lệ, vui lòng thử lai');
					cirHandle.$circulationBook.html(defaultCirBook);
					cirHandle.focusOnBook();
					return false;
				}
			});
			this.$circulationBook.on('click', '#btn-lost-book', function() {
				bootbox.confirm(cirHandle.msgLostBook, function(result) {
					if (result === true) {
						if (cirHandle.bookItemId !== 0 && cirHandle.readerId !== 0) {
							var dataUrl = cirHandle.$circulationBook.find('#btn-lost-book').attr('data-url');
							$.ajax({
								url: dataUrl,
								type: "POST",
								dataType: "JSON",
								data: {readerId: cirHandle.readerId, bookItemId: cirHandle.bookItemId},
								success: function(result) {
									cirHandle.$circulationListBook.html(result.list_book_html);
									cirHandle.$circulationBook.html(defaultCirBook);
									cirHandle.$circulationReader.find("#cir-count-local").html(result.countLocal);
									cirHandle.$circulationReader.find("#cir-count-remote").html(result.countRemote);
									cirHandle.focusOnBook();
								},
								error: function() {
									bootbox.alert(cirHandle.ajaxFailMsg);
									cirHandle.$circulationBook.html(defaultCirBook);
									cirHandle.focusOnBook();
									return false;
								}
							});
						} else {
							bootbox.alert('Thao tác mượn tài liệu không hợp lệ, vui lòng thử lai');
							cirHandle.$circulationBook.html(defaultCirBook);
							cirHandle.focusOnBook();
							return false;
						}
					}
				});
			});

			this.$circulationReader.on('click', '#reader-history', function() {
				var dataUrl = $(this).attr('data-url');
				$.get(dataUrl, function(result) {
					$(result).modal();
				});
				return false;
			});
		}
	};

	/**
	 * Handle inventory execute
	 * */
	var inventory = {
		$container: $("#inventory-container"),
		$bookInfor: $("#book-infor"),
		ajaxFailMsg: 'Đã có lỗi xảy ra, vui lòng thử lại',
		focusOnInput: function() {
			this.$container.find('.barcode-scanner').val('').focus();
		},
		showError: function(msg) {
			this.$container.find('.alert-error').show().find('span').html(msg);
		},
		hideError: function() {
			this.$container.find('.alert-error').hide();
		},
		scan: function(i) {
			var barcode = this.bookItems[i].barcode;
			inventory.$container.find('.barcode-scanner').val(barcode).trigger('change');
		},
		autoTest: function() {
			var len = this.bookItems.length;
			for (var i = 0; i < 100; i++) {
				setTimeout(inventory.scan(i), 1000 + 1000 * i);
			}

		},
		init: function() {
			var defaultBookInfor = this.$bookInfor.html();
			inventory.focusOnInput();
			//scan barcode
			this.$container.on('change', '.barcode-scanner', function() {
				var barcode = $(this).val();
				var dataUrl = $(this).attr('data-url');
				var storage = inventory.$container.find('.storage').val();
				if (barcode !== '') {
					$.ajax({
						url: dataUrl,
						type: 'POST',
						dataType: 'JSON',
						data: {barcode: barcode, storage: storage},
						success: function(result) {
							if (result.status === true) {
								inventory.hideError();
								inventory.$bookInfor.html(result.book_info);
								var num = inventory.$container.find('.book-scanned-count').html();
								inventory.$container.find('.book-scanned-count').html(parseInt(num) + 1);
								inventory.focusOnInput();
								inventory.hideError();
							} else {
								inventory.showError(result.message);
								inventory.$bookInfor.html(defaultBookInfor);
								inventory.focusOnInput();
							}
						},
						error: function() {
							inventory.$bookInfor.html(defaultBookInfor);
							inventory.hideError();
							bootbox.alert(inventory.ajaxFailMsg);
						}
					});
				} else {
					inventory.$bookInfor.html(defaultBookInfor);
					inventory.hideError();
				}
			});
		}
	};

	/**
	 * Handle ajax pagination,ajax search, checkall, uncheckall items
	 * */
	var tableHandle = {
		$tableContainer: $('.table-container'),
		contanerClass: '.table-container',
		$searchInput: $(".table-search-input"),
		init: function() {
			this.$tableContainer.each(function() {
				$container = $(this);
				//ajax pagination
				$(this).on('click', '.pagination a', function() {
					$paging = $(this);
					//call ajax to get html content for paging
					$.ajax({
						url: $(this).attr('href'),
						data: null,
						type: "GET",
						success: function(result) {
							$paging.parents(tableHandle.contanerClass).html(result);
						},
						error: function() {
							bootbox.alert('Đã có lỗi xảy ra, vui lòng đăng nhập lại');
							return false;
						}
					});
					return false;
				});
				//seach on table
				$(this).on('change', '.table-search-input', function() {
					$input = $(this);
					searchParmas = {};
					ignoreArr = ['type', 'placeholder', 'class', 'id', 'data-url'];
					dataUrl = $(this).attr('data-url');
					//add keyword to search params
					searchParmas.keyword = $(this).val();
					for (k in this.attributes) {
						//get attributes that need to search, to build paramaters for search query
						if (typeof (this.attributes[k].value) !== 'undefined' && $.inArray(this.attributes[k].name, ignoreArr) === -1) {
							attrName = this.attributes[k].name;
							attrValue = this.attributes[k].value;
							searchParmas[attrName] = attrValue;
						}
					}
					//make ajax request 
					$.ajax({
						url: dataUrl,
						type: "GET",
						data: searchParmas,
						success: function(result) {
							$input.parents(tableHandle.contanerClass).html(result);
						},
						error: function() {
							bootbox.alert('Đã có lỗi xảy ra, vui lòng đăng nhập lại');
							return false;
						}
					});
				});
				//checkall 
				$(this).on('click', 'input.checkall', function() {
					checked = $(this).prop('checked');
					$container = $(this).parents(tableHandle.contanerClass);
					$checkItems = $container.find('.checkitem');
					numberOfChecked = 0;
					$checkItems.each(function() {
						$(this).prop('checked', checked);
						numberOfChecked++;
					});
					if (checked) {
						$container.find('.check-info').show().html("(Đã chọn " + numberOfChecked + " mục)");
					} else {
						$container.find('.check-info').hide();
					}

				});
				//check on item on table
				$(this).on('click', 'input.checkitem', function() {
					$container = $(this).parents(tableHandle.contanerClass);
					$checkItems = $container.find('.checkitem');
					numberOfChecked = 0;
					$checkItems.each(function() {
						if ($(this).prop('checked'))
							numberOfChecked++;
					});
					if (numberOfChecked > 0) {
						$container.find('.check-info').show().html("(Đã chọn " + numberOfChecked + " mục)");
					} else {
						$container.find('.check-info').hide();
					}
				});
				//submit after check
				$(this).on('click', '.btn-check-submit', function() {
					$container = $(this).parents(tableHandle.contanerClass);
					$checkItems = $container.find('.checkitem');
					numberOfChecked = 0;
					$checkItems.each(function() {
						if ($(this).prop('checked'))
							numberOfChecked++;
					});
					if (numberOfChecked > 0) {
						$container.find('.form-check').submit();
					} else {
						bootbox.alert('Bạn chưa chọn mục nào');
					}
				});
				//handle delete item, create form which delete method,then submit
				$(this).on('click', 'a[data-method="delete"]', function() {
					dataConfirm = $(this).attr('data-confirm');
					token = $(this).attr('data-token');
					action = $(this).attr('href');
					bootbox.confirm(dataConfirm, 'Hủy bỏ', 'Đồng ý', function(result) {
						if (result) {

							var form =
									$('<form>', {
										'method': 'POST',
										'action': action,
									});
							var tokenInput =
									$('<input>', {
										'type': 'hidden',
										'name': '_token',
										'value': token
									});
							var hiddenInput =
									$('<input>', {
										'name': '_method',
										'type': 'hidden',
										'value': 'delete'
									});
							form.append(tokenInput, hiddenInput).hide().appendTo('body').submit();
							//console.log(form.html());
						}
					});
					return false;
				});
				$(this).on('click', '[data-modal="show-modal"]', function() {
					var dataUrl = $(this).attr('data-url');
					$.get(dataUrl, function(result) {
						$(result).modal();
					});
					return false;
				});
			});
		}
	};
	/**
	 * Ajax upload image and preview
	 * */
	$(".form-upload-image").each(function() {
		var $form = $(this);
		var $uploadError = $form.siblings('.upload-error'),
				$uploadProgress = $form.siblings('.upload-progress'),
				uploadType = $form.attr('upload-type'),
				token = $form.children('.crsf-token').val(),
				$oldFile = $form.children('.old-file'),
				maxSize = 2000000,
				acceptFileTypes = /^image\/(gif|jpe?g|png)$/i,
				msgFileSize = 'Dung lượng ảnh quá lớn, chỉ cho phép dung lượng nhỏ hơn 2M',
				msgFileExt = 'Định dạng ảnh không hợp lệ, chỉ cho phép các định dạng gif, jpeg, jpg, png',
				msgUnsaved = 'Tiến trình upload ảnh chưa hoàn tất, bạn có chắc chắn muốn thoát ?',
				msgFail = 'Đã có lỗi xảy ra, vui lòng thử lại sau';
		uploadErrors = [];
		$form.fileupload({
			url: $form.attr('action'),
			type: 'POST',
			datatype: 'json',
			add: function(event, data) {
				uploadErrors = [];
				// Message on unLoad.
				window.onbeforeunload = function() {
					return msgUnsaved;
				};
				if (data.originalFiles[0]['type'].length && !acceptFileTypes.test(data.originalFiles[0]['type'])) {
					uploadErrors.push(msgFileExt);
				}
				if (data.originalFiles[0]['size'] > maxSize) {
					uploadErrors.push(msgFileSize);
				}
				if (uploadErrors.length > 0) {
					window.onbeforeunload = null;
					$uploadError.children('span').html(uploadErrors[0]);
					$uploadError.show();
				} else {
					data.formData = {'_token': token, 'uploadType': uploadType, 'oldFile': $oldFile.val()};
					data.submit();
				}
			},
			start: function() {
				$uploadProgress.show();
				$uploadError.hide();
				$uploadProgress.children('.bar').css('width', 0 + '%');
			},
			send: function(e, data) {
				// onSend
			},
			progress: function(e, data) {
				var percent = Math.round((data.loaded / data.total) * 100);
				$uploadProgress.children('.bar').css('width', percent + '%');
			},
			fail: function(e, data) {
				// Remove 'unsaved changes' message.
				bootbox.alert(msgFail);
				window.onbeforeunload = null;
			}, done: function(event, data) {
				$uploadError.hide();
				$uploadProgress.hide();
			},
			success: function(result) {
				window.onbeforeunload = null;
				if (result.status === true) {
					$form.find('.image-preview').attr('src', result.image_path);
					$form.find('.old-file').val(result.image_name);
					$('input.image_path').val(result.image_path);
				} else {
					$uploadError.show();
					$uploadError.children('span').html(result.message);
				}
			},
			error: function() {
				bootbox.alert(msgFail);
				window.onbeforeunload = null;
			}
		});
	});
	tableHandle.init();
	cirHandle.init();
	inventory.init();
	//inventory.autoTest();
})(jQuery);