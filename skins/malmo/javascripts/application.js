jQuery( function ($) {
	$( 'div.vectorMenu' ).each( function () {
		var $el = $( this );
		$el.find( 'h5:first a:first' )
			// For accessibility, show the menu when the hidden link in the menu is clicked (bug 24298)
			.click( function ( e ) {
				$el.find( '.menu:first' ).toggleClass( 'menuForceShow' );
				e.preventDefault();
			} )
			// When the hidden link has focus, also set a class that will change the arrow icon
			.focus( function () {
				$el.addClass( 'vectorMenuFocus' );
			} )
			.blur( function () {
				$el.removeClass( 'vectorMenuFocus' );
			} );
	} );

  // Hack to style some buttons
  $("#wpSave, .mw-prefs-buttons input").addClass("btn btn-primary");
  $("#wpPreview, #wpDiff, #mw-editform-cancel, .mw-prefs-buttons a").addClass("btn");

  // Add a wrapper block around tables to make them responsive
  $("body.ns-subject table").wrap('<div class="table-wrapper"/>');

  // MediaWiki core sets the placeholder to "Sök", override it
  setTimeout(function() {
    $("#searchInput").attr('placeholder', 'Gå till wikisida');
  }, 100);
});
