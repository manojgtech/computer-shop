$(document).ready(function(){
  $(".addbttn").click(function(e){
    e.preventDefault();
     $("#prfields").clone().appendTo(".dyfields");
  });
});