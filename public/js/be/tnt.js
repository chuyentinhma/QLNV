(function ($) {
    $('#attach').on('focus',function() {
       $('#file').trigger('click');
    });
    $('#file').on('change',function() {
        $('#attach').val($('input[type=file]').val().replace(/.*(\/|\\)/, ''));
    });
    $('.checkbox').click(function () {
        if ($('[purpose="giám sát"]').is(':checked'))
            $(".news_number").show();  // checked
        else
            $(".news_number").hide();
    });
    $('[btn-confirm="confirm"]').on('click', function() {
		var dataConfirm = $(this).attr('data-confirm');
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
    $('.statistics').on('click', function() {
        searchParams = {};
        searchParams.dateStart = $('#date_begin').val();
        searchParams.dateEnd = $('#date_end').val();
        console.log(searchParams);
        $.ajax({
            url: $(this).attr('data_url'),
            data: searchParams,
            type: 'get',
            success: function (data, textStatus, jqXHR) {
                $('.result_statistic').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('ajax thong ke co loi');
            }
               
        });
    });
    var tableHandle = {
		$tableContainer: $('.table-container'),
		contanerClass: '.table-container',
		$searchInput: $(".table-search-input"),
		init: function() {
			this.$tableContainer.each(function() {
				$container = $(this);
                                // select number of rows on perPage
                                $(this).on('change','.perPage',function() {
                                    $('.table-search-input').trigger('change');
                                });
                                // select purpose order
                                $(this).on('change','.listPurpose', function() {
                                   $('.table-search-input').trigger('change');
                                });
                                //ajax pagination
				$(this).on('click', '.ajax a', function() {
					$paging = $(this);
                                        searchParmas = {};
                                        searchParmas.keyword = $('.table-search-input').val();
                                        searchParmas.perPage = $('.perPage :selected').text();
                                        searchParmas.purpose = $('.listPurpose :selected').text();
					//call ajax to get html content for paging
					$.ajax({
						url: $(this).attr('href'),
						data: searchParmas,
						type: "GET",
						success: function(result) {
							$paging.parents(tableHandle.contanerClass).html(result);
                                                        $(".perPage option:contains("+ searchParmas.perPage + ")").attr('selected', true);
                                                        $(".listPurpose option:contains("+ searchParmas.purpose + ")").attr('selected', true);
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
                                        searchParmas.perPage = $('.perPage :selected').text();
                                        searchParmas.purpose = $('.listPurpose :selected').text();
                                        console.log(searchParmas);
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
                                                        $(".perPage option:contains("+ searchParmas.perPage + ")").attr('selected', true);
                                                        $(".listPurpose option:contains("+ searchParmas.purpose + ")").attr('selected', true);
        
						},
						error: function() {
							bootbox.alert('Đã có lỗi xảy ra, vui lòng kiểm tra lại');
							return false;
						}
					});
				});

			});
		}
	};
    tableHandle.init();
})(jQuery);