(function(api) {

    api.sectionConstructor['ecommerce-trendy-outfits-upsell'] = api.Section.extend({
        attachEvents: function() {},
        isContextuallyActive: function() {
            return true;
        }
    });

})(wp.customize);