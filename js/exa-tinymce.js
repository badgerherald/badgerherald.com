(function() {
    tinymce.create('tinymce.plugins.exa_pullquote', {
        init : function(ed, url) {
            ed.addButton('pullquote', {
                title : 'Pull Quote',
                cmd : 'pullquote',
                text : 'Pull Quote',
                icon : false
            });

            ed.addCommand('pullquote', function() {
                var selected_text = ed.selection.getContent(),
                    byline = selected_text.split( new RegExp(/--/));
                var return_text = '';

                    if( byline.length > 1){
                        quote = byline[0];
                        byline = '<span class="quoteby"> &mdash;&nbsp;' + byline[ (byline.length -1)] + '</span>';
                    }
                    else{
                        quote = selected_text;
                        byline = '';
                    }

                
                return_text = '<div class="pullquote"><span class="quote">' + quote + '</span>' + byline +'</div>';
                ed.execCommand('mceInsertContent', 0, return_text);
            });

        },
        // ... Hidden code
    });

    // Register plugin
    tinymce.PluginManager.add( 'exa_pullquote', tinymce.plugins.exa_pullquote );
})();