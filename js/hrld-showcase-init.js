jQuery(document).ready(function($) {
    $($.fn.showcase.defaults.container).showcase({
        slideHtml: function(img) {
            var html = '';
                var hasCaption = '';
                if (img.caption === "" && img.media_credit === "") {
                    hasCaption = ' no-caption';
                }
                html += '<div class="showcase-slide' + hasCaption + '">';
                html += '<div class="showcase-img" style="width:' + img.width + 'px; height:' + img.height + 'px;">';
                html += '<img src="' + img.src + '" alt="' + img.alt + '" title="' + img.title + '" />';
                html += '</div>';
                if (hasCaption === '') {
                    html += '<div class="showcase-content">';
                    html += '<div class="showcase-caption">' + img.caption;
                    html += '<div class="showcase-credit">' + img.media_credit + '</div>';
                    html += '</div>';
                    html += '</div>';                    
                }
                html += '</div>';
                return html;
        }
    });
});