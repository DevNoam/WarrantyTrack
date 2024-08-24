//make a listener for the navbar button
//if device is not mobile disable this file
$(document).ready(function(){
    $("#navbar-button").click(function(){
      console.log("navbar button clicked");
        //if the navbar class is not active, make it active

        if(!$("#nav").hasClass("is-active")){
            //show the navbar
            $("#nav").addClass("is-active");
            $("#navbar-button").addClass("is-active");
        }
        else{
            //hide the navbar
            $("#nav").removeClass("is-active");
            $("#navbar-button").removeClass("is-active");
        }
    });
});

//if navbar is open and the user clicks anywhere else, close the navbar
$(document).click(function(event){
    //if the navbar is open and the user clicks anywhere else, close the navbar
    if($("#nav").hasClass("is-active")){
        if(!$(event.target).closest("#navbar-button").length){
            $("#nav").removeClass("is-active");
            $("#navbar-button").removeClass("is-active");
        }
    }
});