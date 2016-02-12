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
                    selected_texts = selected_text.split( new RegExp(/--/)),
                    return_text = '';

                var quote = '', quoteby = '', align = '';
                if( selected_text != ''){

                    if( selected_texts.length > 1){
                        quote = selected_texts[0];
                        quoteby = selected_texts[ (selected_texts.length - 1)];
                    }else{
                        quote = selected_text;
                    }
                }
                ed.windowManager.open({
                                    title: 'Insert Pullquote',
                                    width: 500,
                                    height: 400,
                                    body: [
                                        {
                                            type: 'textbox',
                                            name: 'quote',
                                            label: 'Quote',
                                            multiline: true,
                                            style: 'height: 100px;',
                                            'value': quote.replace(/"/g, '')
                                        },
                                        {
                                            type: 'textbox',
                                            name: 'quoteby',
                                            label: 'Citation',
                                            'value': quoteby
                                        },
                                        {
                                            type: 'listbox',
                                            name: 'align',
                                            label: 'Align',
                                            'values': [
                                                {text: 'Full', value: 'aligncenter'},
                                                {text: 'Left', value: 'alignleft'},
                                                {text: 'Right', value: 'alignright'}
                                            ]
                                        },
                                        {
                                            type: 'checkbox',
                                            name: 'quotation',
                                            label: 'Quotemarks?'
                                        }


                                    ],
                                    onsubmit: function( event) {
                                        quote = event.data.quote;
                                        citation = event.data.quoteby;
                                        align = event.data.align || '';
                                        quotemarks = event.data.quotation ? 1 : '';
                                        if( event.data.quotation)
                                            quote += '"';

                                        // No quote? No Shortcode.
                                        if(!quote) {
                                            return;
                                        }

                                        return_text = '[exa_pullquote';

                                        // attr:
                                        if(align) {
                                            return_text += ' align="' + align + '"';
                                        }
                                        // attr:
                                        if(citation) {
                                            return_text += ' cite="' + citation + '"';
                                        }
                                        // attr:
                                        if(quotemarks) {
                                            return_text += ' quotemarks="' + quotemarks + '"';
                                        }
                                        
                                        return_text += "]";
                                        return_text += quote;
                                        return_text += "[/exa_pullquote]";

                                        ed.insertContent(return_text);
                                    }
                });

            });

        },
        // ... Hidden code
    });

    // Register plugin
    tinymce.PluginManager.add( 'exa_pullquote', tinymce.plugins.exa_pullquote );
})();