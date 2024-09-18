// $(".changeComplete").on("change", function(){
//     this.form.submit();
// })


// $("#fixedBtn").on("click", function(){
//     $("#backgroundNewTask").css("display", "flex");
// });
// $(".editItem").on("click", function(){
//     $("#backgroundNewTask").css("display", "flex");
// });
// $("#modalLeftBtn").on("click", function(){
//     $("#backgroundNewTask").css("display", "none");
// });
// $("document").ready(function(){
    
// })
$("#colorBtnHeader").on("click", function(){
            $("#main").css({"background-color":"#252525"});
            alert("some text");
})



// document.write($(".oneNote"));
 $(".oneNote").on("mousemove", function(){
     $(this).find($(".btnsOneNote")).css("display", "flex");
 })
 $(".oneNote").on("mouseleave", function(){
     $(this).find($(".btnsOneNote")).css("display", "none");
 })