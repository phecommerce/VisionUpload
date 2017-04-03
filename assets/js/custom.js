
function triggerHtmlEvent(element, eventName) {
    var event;
    if (document.createEvent) {
    event = document.createEvent('HTMLEvents');
    event.initEvent(eventName, true, true);
    element.dispatchEvent(event);
    }
    else {
    event = document.createEventObject();
    event.eventType = eventName;
    element.fireEvent('on' + event.eventType, event);
    }
    }


    <!-- Flag click handler -->
var jq = $.noConflict();
jq('.translation-links a').click(function (e) {
    e.preventDefault();
    var lang = jq(this).data('lang');
    jq('#google_translate_element select option').each(function () {
    if (jq(this).text().indexOf(lang) > -1) {
    jq(this).parent().val(jq(this).val());
    var container = document.getElementById('google_translate_element');
    var select = container.getElementsByTagName('select')[0];
    triggerHtmlEvent(select, 'change');
    }
    });
    });
