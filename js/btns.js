 $(".oneNote").on("mousemove", function(){
     $(this).find($(".btnsOneNote")).css("display", "flex");
 })
 $(".oneNote").on("mouseleave", function(){
     $(this).find($(".btnsOneNote")).css("display", "none");
 })

 $(".oneNote").on("click", function(){
    $(this).find($(".oneNoteDesc")).css('display', 'flex');
 })