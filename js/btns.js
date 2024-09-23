$(".oneNote").on("mousemove", function(){
    $(this).find($(".btnsOneNote")).css("display", "flex");
})
$(".oneNote").on("mouseleave", function(){
    $(this).find($(".btnsOneNote")).css("display", "none");
})



$(".oneNote").on("click", function(e){
    if($(this).find($(".oneNoteDesc")).css('display') == 'flex'){
        $(this).find($(".oneNoteDesc")).css('display', 'none');
    }
    else{
        $(this).find($(".oneNoteDesc")).css('display', 'flex');
    }
})
