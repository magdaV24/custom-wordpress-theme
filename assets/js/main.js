$(document).ready(function(){
    const button = $("#show-comments-button");
    const commentsSection = $(".comments-section");
    
    button.click(function(){
        commentsSection.toggleClass("hide");
        button.text(function(i, text){
            return text === "Show Comments" ? "Hide Comments" : "Show Comments";
        });
    });
});

