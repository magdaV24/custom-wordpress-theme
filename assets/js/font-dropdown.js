$(document).ready(function(){
    applySavedFont();
    const dropdown = $("#font-selector");
    
    dropdown.change(function(e){
        e.preventDefault();
        const selectedFont = $(this).val();
        changeFont(selectedFont);
    });

    function changeFont(fontName) {
        $(':root').css('--roboto', fontName);
        localStorage.setItem('selectedFont', fontName);
    }
})

function applySavedFont() {
    const selectedFont = localStorage.getItem('selectedFont');
    if (selectedFont) {
        $(':root').css('--roboto', selectedFont);
    }
}