/**
 * Stuff Customizer Scripts
 *
 * @type {{}}
 */

/**
 * Check if we have the object created somewhere else
 * @type {{}}
 */
var Stuff = typeof(Stuff) ? {} : Stuff;

/**
 * Stuff Customizer functions
 *
 * @type {{pairedSettings: Stuff.Customizer.pairedSettings, _addOptionsToSelect: Stuff.Customizer._addOptionsToSelect, _getValueFromRepeater:
 *     Stuff.Customizer._getValueFromRepeater}}
 */
Stuff.Customizer = {
  /**
   * Helpers array
   */
  helpers: {
    /**
     * Cleans an array (undefined values), returns value
     *
     * @param actual
     * @returns {Array}
     */
    cleanArray: function( actual ) {
      var newArray = [];
      for ( var i = 0; i < actual.length; i ++ ) {
        if ( actual[ i ] ) {
          newArray.push( actual[ i ] );
        }
      }
      return newArray;
    }
  },

  /**
   * Disable a select if it does not have values
   * @param id
   */
  checkValuesAndDisable: function( id ) {
    var select = jQuery( id ).find( 'select' ),
        options;
    if ( select.length ) {
      select.val( 0 );
      options = select.find( 'option' );
    }

    if ( 1 === options.length ) {
      select.prop( 'disabled', true );
    }
  },

  /**
   * Populates selects based on another option
   *
   * @param object
   * @param api
   */
  pairedSettings: function( object, api ) {
    var self = this;
    _.each( object, function( v, k ) {
      /**
       * Handle updates ( basically, when the user types in the doctors field -> an option is being created in the select )
       */
      api.control( k ).container.on( 'row:update', _.debounce( function() {
        var val = api.control( k ).setting.get(),
            selects = jQuery( '.repeater-sections' ).find( '[data-field=\'' + v.field + '\']' );

        _.each( selects, function( k ) {
          jQuery( k ).empty();
          self._addOptionsToSelect( jQuery( k ), val, v.filter );
        } );

      }, 500 ) );

      /**
       * When you remove a row, the value gets cleaned ( array could contain undefined elements, we need to get RID of them )
       */
      api.control( k ).container.on( 'row:remove', function() {
        var val = api.control( k ).setting.get(),
            selects = jQuery( '.repeater-sections' ).find( '[data-field=\'' + v.field + '\']' );
        val = self.helpers.cleanArray( val );
        _.each( selects, function( k ) {
          jQuery( k ).empty();
          self._addOptionsToSelect( jQuery( k ), val, v.filter );
        } );
      } );
    } );
  },

  /**
   * Create options from an object of values
   * @param select
   * @param options
   * @param key
   * @private
   */
  _addOptionsToSelect: function( select, options, key ) {
    if ( select.hasClass( 'selectized' ) ) {
      select[ 0 ].selectize.clearOptions();
      select[ 0 ].selectize.addOption( { value: 'all', text: 'All' } );
      _.each( options, function( v ) {
        select[ 0 ].selectize.addOption( { value: v[ key ], text: v[ key ] } );
        select[ 0 ].selectize.refreshOptions( false );
        //select[ 0 ].selectize.setValue( 'all', false );
      } );
    } else {
      select.append( jQuery( '<option></option>' ).attr( 'value', 'all' ).text( 'All' ) );
      _.each( options, function( v ) {
        select.append( jQuery( '<option></option>' ).attr( 'value', v[ key ] ).text( v[ key ] ) );
      } );
    }
  },

  /**
   * Content panels should be last ( The nested panels functionality adds Panels and then Sections )
   */
  handleAwfulSorting: function() {
    jQuery( document ).on( 'epsilon-reflown-panels', function() {
      var element = jQuery( '#accordion-panel-stuff_panel_section_content' );
      element.appendTo( element.parent() );
    } );
  },

  /**
   * Handles active callback
   *
   * @param object
   */
  handleActiveCallback: function( object ) {
    var self = this;
    _.each( object, function( v, k ) {
      self._handleActiveCallback( wp.customize.control( k ).setting.get(), v );

      wp.customize.control( k ).container.find( 'input' ).on( 'change', function() {
        self._handleActiveCallback( wp.customize.control( k ).setting.get(), v );
      } );
    } );
  },

  /**
   *
   * @param currentValue
   * @param obj
   * @returns {boolean}
   * @private
   */
  _handleActiveCallback: function( currentValue, obj ) {
    if ( obj.value === currentValue ) {
      _.each( obj.fields, function( k ) {
        jQuery( '#' + k ).removeClass( 'hidden-section-panel' );
      } );
    } else {
      _.each( obj.fields, function( k ) {
        jQuery( '#' + k ).addClass( 'hidden-section-panel' );
      } );
    }
  }
};

/**
 * Sort'of document ready
 */
wp.customize.bind( 'ready', function() {

  var obj = {

  };

    Stuff.Customizer.pairedSettings( obj, wp.customize );

  var activeCallbacked = {
    'show_on_front': {
      value: 'page',
      fields: [ 'accordion-section-stuff_repeatable_section' ]
    }
  };

    Stuff.Customizer.checkValuesAndDisable( '#customize-control-stuff_contact_form' );

  //Stuff.Customizer.handleActiveCallback( activeCallbacked );
    Stuff.Customizer.handleAwfulSorting();
} );
