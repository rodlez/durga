$('#trumbowyg-editor')
.trumbowyg({        
    btns: [
        ['base64'],
        ['viewHTML'],
        ['undo', 'redo'], // Only supported in Blink browsers
        ['formatting'],
        ['strong', 'em', 'del'],
        ['superscript', 'subscript'],
        ['link'],
        ['insertImage'], 
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['unorderedList', 'orderedList'],
        ['horizontalRule'],
        ['removeformat'],
        ['fullscreen']
    ],    
    autogrow: true,
    svgPath: '/trumbowyg/dist/ui/icons.svg'    
});