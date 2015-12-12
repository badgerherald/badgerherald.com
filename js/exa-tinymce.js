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
                                                label: 'Quote By',
                                                'value': quoteby
                                            },
                                            {
                                                type: 'listbox',
                                                name: 'align',
                                                label: 'Align',
                                                'values': [
                                                    {text: 'Left', value: 'alignleft'},
                                                    {text: 'Center', value: 'aligncenter'},
                                                    {text: 'Right', value: 'alignright'}
                                                ]
                                            },
                                            {
                                                type: 'checkbox',
                                                name: 'quotation',
                                                label: 'Open quote symbol: Yes'
                                            }


                                        ],
                                        onsubmit: function( event) {
                                            quote = event.data.quote.replace(/(^\"{1})|(\"{1}$)/gm, '');
                                            quoteby = event.data.quoteby;
                                            align = event.data.align || '';
                                            quotation = event.data.quotation ? 'quotation' : '';
                                            if( event.data.quotation)
                                                quote += '"';
                                            return_text  = '<div class="pullquote '+ align +' ' + quotation + '">';
                                            return_text +=      '<span class="quote">' + quote + '</span>';
                                            return_text +=      '<span class="quoteby"> &mdash;&nbsp;' + quoteby + '</span>';
                                            return_text += '</div>';
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