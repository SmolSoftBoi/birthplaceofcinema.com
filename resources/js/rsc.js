$(document).on('pagecreate', function(event, ui) {



	/**
	 * Account - Newsletter
	 * 
	 * Toggles newsletter subscription.
	 * 
	 * APIs:
	 *  - newsletter/subscribe
	 *  - newsletter/unsubscribe
	 */
	var queryNewsletter;

	$('#newsletter').change(function() {
		var thisNewsletter = $(this);

		if (thisNewsletter.val() == 'on') {
			queryNewsletter = $.ajax({
				url: '/api/newsletter/subscribe'
			}).fail(function(data) {
				thisNewsletter.val('off').flipswitch('refresh');
			});
		}

		if (thisNewsletter.val() == 'off') {
			queryNewsletter = $.ajax({
				url: '/api/newsletter/unsubscribe'
			}).fail(function() {
				thisNewsletter.val('on').flipswitch('refresh');
			});
		}
	});



	/**
	 * Account - Favourites
	 * 
	 * Toggles favourites subscription.
	 * 
	 * APIs:
	 *  - favorites/subscribe
	 *  - favorites/unsubscribe
	 */
	var queryFavorites;

	$('#favorites').change(function() {
		var thisFavorites = $(this);

		if (thisFavorites.val() == 'on') {
			queryFavorites = $.ajax({
				url: '/api/favorites/subscribe'
			}).fail(function(data) {
				thisFavorites.val('off').flipswitch('refresh');
			});
		}

		if (thisFavorites.val() == 'off') {
			queryNewsletter = $.ajax({
				url: '/api/favorites/unsubscribe'
			}).fail(function() {
				thisFavorites.val('on').flipswitch('refresh');
			});
		}
	});



	/**
	 * Films and Events - Favourites
	 * 
	 * Toggles film or event favorite.
	 * 
	 * APIs:
	 *  - favorites/add
	 *  - favorites/remove
	 */
	$('.favorite').each(function() {
		var thisFavorite = $(this);
		var query;

		$(this).click(function() {
			var action = $(thisFavorite).data('action');
			var filmeventId = $(thisFavorite).data('filmevent-id');

			if (action == 'add') {
				query = $.ajax({
					url: '/api/favorites/add',
					data: {
						'filmevent_id': filmeventId
					}
				}).done(function() {
					$(thisFavorite).text('Remove from Favorites');
					$(thisFavorite).data('action', 'remove');
				});
			}

			if (action == 'remove') {
				query = $.ajax({
					url: '/api/favorites/remove',
					data: {
						'filmevent_id': filmeventId
					}
				}).done(function() {
					$(thisFavorite).text('Add to Favorites');
					$(thisFavorite).data('action', 'add');
				});
			}
		});
	});



	/**
	 * Film or Event - Trailers
	 * 
	 * Plays trailer and shows controls.
	 */
	$('.trailer').each(function() {
		$(this).click(function() {
			$(this)[0].play();
			$(this)[0].controls = true;
		});
	});



	/**
	 * Film or Event - Book
	 * 
	 * Books tickets; calculates price, uses Stripe payment gateway to complete transaction, and shows ticket.
	 * 
	 * APIs:
	 *  - filmsevents/filmeventtimehtml
	 *  - filmsevents/pay
	 */
	if ($('#book').length) {
		var queryBook;

		$('#date').change(function() {
			var thisDate = $(this);
			var thisTime = $('#time');

			thisTime.selectmenu('disable').selectmenu('refresh');

			var filmeventId = $(this).data('filmevent-id');
			var date = $(this).val();
	
			queryBook = $.ajax({
				url: '/api/filmsevents/filmeventtimeshtml',
				data: {
					'filmevent_id': filmeventId,
					'date': date
				}
			}).done(function(data) {
				thisTime.html(data);
				thisTime.selectmenu('enable').selectmenu('refresh');
			}).fail(function() {
				thisDate.val(date).selectmenu('refresh');
				thisTime.selectmenu('enable').selectmenu('refresh');
			});
		});

		$('.ticket').each(function() {
			$(this).change(function() {
				var adultSubTotal = $('#adult').val() * $('#adult').data('price');
				var childSubTotal = $('#child').val() * $('#child').data('price');
				var studentSubTotal = $('#student').val() * $('#student').data('price');
				var total = adultSubTotal + childSubTotal + studentSubTotal;

				$('#adult').closest('tr').find('.price').text('£' + adultSubTotal.toFixed(2));
				$('#child').closest('tr').find('.price').text('£' + childSubTotal.toFixed(2));
				$('#student').closest('tr').find('.price').text('£' + studentSubTotal.toFixed(2));
				$('tfoot').find('.price').text('£' + total.toFixed(2));
			});
		});

		var handler = StripeCheckout.configure({
			key: 'pk_test_Dy9FyWDNnyrY54WxpjeucCGa',
			token: function(token) {
				if (token.id) {
					var payData = $('form').serializeArray();
					payData.push({
						name: 'filmevent_id',
						value: filmEventItem.filmevent_id
					});
					payData.push({
						name: 'token_id',
						value: token.id
					});

					var query = $.ajax({
						url: '/api/filmsevents/pay',
						type: 'POST',
						data: payData
					}).done(function(data) {
						data = $.parseJSON(data);
						$(':mobile-pagecontainer').pagecontainer('change', '/filmsevents/ticket/' + data.booked_filmevent_id);
					});
				}
			}
		});

		$('#pay').on('click', function(e) {
			var adultSubTotal = $('#adult').val() * $('#adult').data('price');
			var childSubTotal = $('#child').val() * $('#child').data('price');
			var studentSubTotal = $('#student').val() * $('#student').data('price');
			var total = adultSubTotal + childSubTotal + studentSubTotal;

			if (total === 0) return false;

			total = total.toFixed(2).replace('.', '');

			handler.open({
				name: 'Regent Street Cinema',
				description: header,
				amount: total,
				currency: 'GBP',
				email: session.user
			});
			e.preventDefault();
		});

		$(window).on('popstate', function() {
			handler.close();
		});
	}



	/**
	 * Name a Seat - Seat Map
	 * 
	 * Selects or deselects seat.
	 * Zooms seat map in or out.
	 */
	var size = 0;

	$('#requestseat').hide();
	$('.seatmap > table > tbody > tr').each(function() {
		var rowSize = $('.seatmap > table > tbody > tr[data-row="' + $(this).data('row') + '"] > td').length;
		if (rowSize > size) size = rowSize;
	});
	if ($(window).width() > (size * ($('.seatmap > table > tbody > tr > td.seat').outerWidth(true) + 10))) {
		size = 20;
		$('#zoom').hide();
	} else {
		size = 10;
	}

	$('.seatmap > table > tbody > tr > td.seat').each(function() {
		$(this).width(size);
		$(this).height(size);

		$(this).click(function() {
			if ($(this).hasClass('disabled')) {
				$(this).fadeTo('fast', 0.2).fadeTo('fast', 1);
			} else {
				if ($(this).hasClass('selected')) {
					$(this).removeClass('selected');
				
					$('#requestseat').hide();
				} else {
					$('.seatmap > table > tbody > tr > td.seat').each(function() {
						$(this).removeClass('selected');
					});
					$(this).addClass('selected');
				
					$('#requestseat').show();
				}
			}
		});
	});

	$('#zoom').click(function() {
		if ($(this).data('zoom') === 'in') {
			$('.seatmap > table > tbody > tr > td.seat').each(function() {
				$(this).width(20);
				$(this).height(20);
			});

			$(this).data('zoom', 'out').removeClass('ui-icon-zoomin').addClass('ui-icon-zoomout').text('Zoom Out');
		} else if ($(this).data('zoom') === 'out') {
			$('.seatmap > table > tbody > tr > td.seat').each(function() {
				$(this).width(10);
				$(this).height(10);
			});

			$(this).data('zoom', 'in').removeClass('ui-icon-zoomout').addClass('ui-icon-zoomin').text('Zoom In');
		}
	});

	$('#requestseat').click(function() {
		var seat = $('.seat.selected').parent().data('row') + $('.seat.selected').data('seat');
		$('.screen').css('bottom', '58px').css('left', '0').css('right', '0').css('top', '44px');
		setTimeout(function() {
			$(':mobile-pagecontainer').pagecontainer('change', '/nameseat/requestseat/' + seat, {
				transition: 'slideup'
			});
		}, 1000);
	});

	$('.screen').click(function() {
		$('.screen').css('bottom', '').css('left', '').css('right', '').css('top', '');
	});



});